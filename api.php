<?php
// api.php - Secure Weather Proxy & Text File Logger
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

// ==========================================
// 1. CONFIGURATION: PRIVATE API KEY
// ==========================================
$API_KEY = "YOUR_API_KEY_HERE"; // Put your 32-char key here (Never exposed to client)
$LOG_FILE = __DIR__ . "/searches.txt";

$action = isset($_GET['action']) ? trim($_GET['action']) : '';
$unit   = isset($_GET['unit']) && $_GET['unit'] === 'imperial' ? 'imperial' : 'metric';

if (empty($action)) {
    http_response_code(400);
    echo json_encode(["error" => "Missing action parameter."]);
    exit();
}

// Function to safely execute cURL requests
function fetchRemoteData($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [$httpCode, $response];
}

// ==========================================
// 2. ROUTE ACTIONS
// ==========================================

// Route A: Current Weather & Text Logging
if ($action === 'weather') {
    $url = "";
    $searchedCity = "";

    if (!empty($_GET['city'])) {
        $searchedCity = trim($_GET['city']);
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($searchedCity) . "&units={$unit}&appid={$API_KEY}";
    } elseif (isset($_GET['lat']) && isset($_GET['lon'])) {
        $lat = floatval($_GET['lat']);
        $lon = floatval($_GET['lon']);
        $url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&units={$unit}&appid={$API_KEY}";
    } else {
        http_response_code(400);
        echo json_encode(["error" => "City name or coordinates required."]);
        exit();
    }

    list($code, $response) = fetchRemoteData($url);

    if ($code === 200) {
        $data = json_decode($response, true);
        
        $loggedCity = $data['name'] ?? $searchedCity;
        $temp = isset($data['main']['temp']) ? round($data['main']['temp']) : 'N/A';
        $condition = $data['weather'][0]['description'] ?? 'N/A';
        $userIp = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $timestamp = date("Y-m-d H:i:s");

        // Format: [2026-10-24 15:30:20] | IP: 127.0.0.1 | City: Delhi | Temp: 31°C | Condition: haze
        $logLine = "[{$timestamp}] | IP: {$userIp} | City: {$loggedCity} | Temp: {$temp}° | Condition: {$condition}" . PHP_EOL;

        // Append line directly to searches.txt
        file_put_contents($LOG_FILE, $logLine, FILE_APPEND | LOCK_EX);
    }

    http_response_code($code);
    echo $response;
    exit();
}

// Route B: Air Pollution (AQI)
if ($action === 'aqi') {
    if (!isset($_GET['lat']) || !isset($_GET['lon'])) {
        http_response_code(400);
        echo json_encode(["error" => "Coordinates required for AQI."]);
        exit();
    }
    $lat = floatval($_GET['lat']);
    $lon = floatval($_GET['lon']);
    $url = "https://api.openweathermap.org/data/2.5/air_pollution?lat={$lat}&lon={$lon}&appid={$API_KEY}";
    
    list($code, $response) = fetchRemoteData($url);
    http_response_code($code);
    echo $response;
    exit();
}

// Route C: 5-Day Extended Forecast
if ($action === 'forecast') {
    if (!isset($_GET['lat']) || !isset($_GET['lon'])) {
        http_response_code(400);
        echo json_encode(["error" => "Coordinates required for forecast."]);
        exit();
    }
    $lat = floatval($_GET['lat']);
    $lon = floatval($_GET['lon']);
    $url = "https://api.openweathermap.org/data/2.5/forecast?lat={$lat}&lon={$lon}&units={$unit}&appid={$API_KEY}";

    list($code, $response) = fetchRemoteData($url);
    http_response_code($code);
    echo $response;
    exit();
}

http_response_code(404);
echo json_encode(["error" => "Invalid endpoint action."]);
exit();
?>
