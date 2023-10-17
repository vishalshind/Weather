<!DOCTYPE html>
<html>
<head>
    <title>Weather Data Search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Include other CSS files and libraries as needed -->
</head>
<body>
    <div class="container">
        <form method="post">
            <label for="city">Search City Weather Data:</label>
            <input type="text" id="city" name="city" required>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i> Search1
            </button>
        </form>

        {if $weatherData}
        <div class="weather-data">
            <p><strong>City:</strong> {$weatherData.city}</p>
            <p><strong>Temperature:</strong> {$weatherData.temperature} &deg;C</p>
            <p><strong>Humidity:</strong> {$weatherData.humidity} %</p>
            <p><strong>Wind Speed:</strong> {$weatherData.wind_speed} m/s</p>
            <p><strong>Date:</strong> {$weatherData.date}</p>
            <p><strong>Time:</strong> {$weatherData.time}</p>
        </div>
        {else}
        <p class="no-data"></p>
        {/if}

        <form method="post">
            <label for="historyCity">Search City History:</label>
            <input type="text" id="historyCity" name="historyCity" required>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i> Search History
            </button>
        </form>

        <ul class="history-list">
            {foreach $historyData as $data}
            <li class="history-item">
                <strong>City:</strong> {$data.city}<br>
                <strong>Temperature:</strong> {$data.temperature} &deg;C<br>
                <strong>Humidity:</strong> {$data.humidity} %<br>
                <strong>Wind Speed:</strong> {$data.wind_speed} m/s<br>
                <strong>Date:</strong> {$data.date}<br>
                <strong>Time:</strong> {$data.time}
                <div class="action-buttons">
                    <a href="Update.php?action=update&city={$data.city}" class="update-button btn btn-warning">
                        <i class="bi bi-pencil"></i> EDIT
                    </a>
                </div>
            </li>
            {/foreach}
        </ul>
        <div class="imageBox"></div>
        <div class="action-buttons">
            <a href="Add.php?action=add" class="add-button btn btn-success">
                <i class="bi bi-plus"></i> ADD
            </a>
        </div>
    </div>

    <div class="chart-container">
        
        <h1 style="text-align: center;" class="chart-header">Weather Data Chart</h1>
        <canvas id="weatherChart" width="800" height="400"></canvas>
    </div>
    
    <script>
        // JavaScript code for chart initialization (copy from your existing index.php)
        const chartLabels = JSON.parse('{$chartLabels}');
        const temperatureData = JSON.parse('{$temperatureData}');
        const humidityData = JSON.parse('{$humidityData}');
        const windSpeedData = JSON.parse('{$windSpeedData}');

        const ctx = document.getElementById('weatherChart').getContext('2d');
        const weatherChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Temperature (°C)',
                    data: temperatureData,
                    backgroundColor: 'rgba(139, 0, 0, 0.7)', /* Very dark red with transparency */
                    borderColor: 'rgba(139, 0, 0, 1)',
                    borderWidth: 1,
                    categoryPercentage: 0.5,
                    barPercentage: 0.6,
                }, {
                    label: 'Humidity (%)',
                    data: humidityData,
                    backgroundColor: 'rgba(0, 0, 139, 0.7)', /* Very dark blue with transparency */
                    borderColor: 'rgba(0, 0, 139, 1)',
                    borderWidth: 1,
                    categoryPercentage: 0.5,
                    barPercentage: 0.6,
                }, {
                    label: 'Wind Speed (m/s)',
                    data: windSpeedData,
                    backgroundColor: 'rgba(0, 100, 0, 0.7)', /* Very dark green with transparency */
                    borderColor: 'rgba(0, 100, 0, 1)',
                    borderWidth: 1,
                    categoryPercentage: 0.5,
                    barPercentage: 0.6,
                }],
            },
            options: {
                scales: {
                    x: {
                        stacked: true,
                        grid: {
                            display: false,
                        },
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)',
                        },
                    },
                },
            },
        });
    </script>
</body>
</html>
