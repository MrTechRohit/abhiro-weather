# ☁️ Abhiro Weather Forecast

A full-stack, responsive meteorological Single Page Application (SPA) designed to deliver real-time atmospheric telemetry, dynamic air quality indices (AQI), 5-day forecasting trends, and regional neighborhood radar triangulation.

The application incorporates a secure **PHP API Reverse Proxy** to keep third-party credentials isolated from client-side inspection, paired with server-side flat-file search activity logging.

---

## 📸 Preview & Interface

![Abhiro Weather Forecast UI](screenshot.png)

> **Note:** To render your preview image on GitHub, capture a full-window screenshot of your application and save it directly in your root repository folder as `screenshot.png`.

---

## 🌐 Live URL & Repository

* **Live Deployment:** [https://abhiro-weather.wuaze.com/](https://abhiro-weather.wuaze.com/)
* **GitHub Repository:** [https://github.com/MrTechRohit/abhiro-weather](https://github.com/MrTechRohit/abhiro-weather)

---

## ✨ Key Features

* **Server-Side API Key Shielding:** OpenWeatherMap API credentials stay isolated on the server within `api.php`. No keys are exposed in client-side code, network inspect tabs, or repository files.
* **Lightweight Flat-File Logging:** User queries, timestamps, client IPs, weather conditions, and temperatures are logged directly to `searches.txt` without requiring an external database driver.
* **Real-Time Meteorological Metrics:** Live temperature, "feels like" reading, humidity, wind velocity, atmospheric pressure, and visibility.
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
* **Storage:** Flat text file (`searches.txt` with `LOCK_EX` concurrency control)
* **Weather Data Source:** [OpenWeatherMap API](https://openweathermap.org/) (Current Weather, Air Pollution, 5-Day Forecast)
* **Hosting Platform:** Custom Apache/PHP Web Server ([wuaze.com](https://abhiro-weather.wuaze.com/))

---

## 🚀 Local Installation & Setup

### 1. Prerequisites
* [XAMPP](https://www.apachefriends.org/) (Apache server module enabled)
* Git installed

### 2. Clone the Repository
Clone the repository directly into your local XAMPP web root:
```bash
cd C:/xampp/htdocs
git clone [https://github.com/MrTechRohit/abhiro-weather.git](https://github.com/MrTechRohit/abhiro-weather.git) weather
