# ☁️ Abhiro Weather Forecast

A full-stack, responsive meteorological Single Page Application (SPA) designed to deliver real-time atmospheric telemetry, dynamic air quality indices, 5-day forecasting trends, and regional neighborhood radar triangulation.

The application features a secure **PHP API Reverse Proxy** to keep third-party credentials hidden from client-side inspection, paired with lightweight server-side flat-file search activity logging.

---

## 📸 Preview & Screenshots

![Abhiro Weather Forecast UI](screenshot.png)

> **Note:** To display your screenshot, capture your application window and save the image as `screenshot.png` directly in this root repository folder.

---

## 🌐 Live URL & Demo

* **Live Demo Deployment:** [https://mrtechrohit.github.io/live-weather/](https://mrtechrohit.github.io/live-weather/)
* *(Note: To test the secure PHP proxy and file logging features, deploy on a PHP-supported environment like Apache/XAMPP, Render, or InfinityFree).*

---

## ✨ Key Features

* **Server-Side API Key Shielding:** OpenWeatherMap API credentials stay isolated on the server within `api.php`. No keys are exposed in client-side code, network requests, or source inspect tools.
* **Lightweight Flat-File Logging:** Queries, timestamps, client IPs, weather conditions, and temperatures are logged directly to `searches.txt` without needing external database drivers.
* **Real-Time Meteorological Metrics:** Live temperature, "feels like" index, humidity, wind velocity, atmospheric pressure, and visibility.
* **Air Quality Index (AQI):** Telemetry tracking with health impact classifications (Healthy, Fair, Moderate, Unhealthy, Hazardous).
* **5-Day Extended Forecast:** Midday atmospheric projections and temperature trend graphs.
* **Dynamic Neighboring Radar:** Triangulates radial GPS coordinates around any searched city to query and display 3 neighboring towns.
* **Voice Search:** Hands-free city searching powered by the browser's native Web Speech API.
* **Dual Unit System:** Instant mathematical conversion toggle between Metric (°C, m/s) and Imperial (°F, mph).
* **Smart Lifestyle Recommendations:** Context-aware weather advice (rain alerts, UV warnings, cold-weather apparel prompts).
* **Adaptive Ambient Themes:** Dynamic backgrounds reflecting clear, cloudy, rainy, snowy, or nighttime conditions.

---

## 🛠️ Tech Stack

* **Frontend:** HTML5, CSS3 (Glassmorphism, Flexbox, CSS Grid), Vanilla JavaScript (ES6+, Fetch API, Web Speech API)
* **Backend:** PHP 8+ (cURL HTTP client, JSON payload encoding, secure stream handling)
* **Storage:** Flat text file (`searches.txt` with file-locking `LOCK_EX`)
* **Weather Data Source:** [OpenWeatherMap API](https://openweathermap.org/) (Current Weather, Air Pollution, 5-Day Forecast)

---

## 🚀 Local Installation & Setup

### 1. Prerequisites
* [XAMPP](https://www.apachefriends.org/) (with Apache running)
* Git installed

### 2. Clone the Repository
Clone the repository directly into your local XAMPP web root:
```bash
cd C:/xampp/htdocs
git clone [https://github.com/MrTechRohit/live-weather.git](https://github.com/MrTechRohit/live-weather.git) weather
