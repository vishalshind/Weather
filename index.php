<?php
require 'vendor/autoload.php'; // Load Smarty library

$smarty = new Smarty; // Initialize Smarty

$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "weather5";

$conn = new mysqli($servername, $username, $password, $dbname);
$weatherData = null;
$historyData = [];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['city'])) {
        $city = $_POST['city'];
        $apiKey = "ec72fe435dd4131ba900acb4f532d7f3";
        $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=" . $apiKey;
        $apiData = file_get_contents($apiUrl);
        $apiDataArray = json_decode($apiData, true);

        if ($apiDataArray) {
            $temperature = $apiDataArray['main']['temp'];
            $humidity = $apiDataArray['main']['humidity'];
            $windSpeed = $apiDataArray['wind']['speed'];

            $currentDate = date('Y-m-d');
            $currentTime = date('H:i:s');

            $sql = "INSERT INTO weather5 (city, temperature, humidity, wind_speed, date, time) VALUES ('$city', '$temperature', '$humidity', '$windSpeed', '$currentDate', '$currentTime')";

            if ($conn->query($sql) === TRUE) {
                $weatherData = [
                    'city' => $city,
                    'temperature' => $temperature,
                    'humidity' => $humidity,
                    'wind_speed' => $windSpeed,
                    'date' => $currentDate,
                    'time' => $currentTime
                ];
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    if (isset($_POST['historyCity'])) {
        $historyCity = $_POST['historyCity'];

        $sql = "SELECT id, city, temperature, humidity, wind_speed, date, time FROM weather5 WHERE city = '$historyCity'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $historyData[] = $row;
            }
        } else {
            echo "No results found for city: " . $historyCity;
        }
    }
}

$chartLabels = [];
$temperatureData = [];
$humidityData = [];
$windSpeedData = [];

$sql = "SELECT * FROM weather5";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $chartLabels[] = $row['city'];
    $temperatureData[] = $row['temperature'];
    $humidityData[] = $row['humidity'];
    $windSpeedData[] = $row['wind_speed'];
}

$smarty->assign('weatherData', $weatherData);
$smarty->assign('historyData', $historyData);
$smarty->assign('chartLabels', json_encode($chartLabels));
$smarty->assign('temperatureData', json_encode($temperatureData));
$smarty->assign('humidityData', json_encode($humidityData));
$smarty->assign('windSpeedData', json_encode($windSpeedData));

$smarty->display('views/index.tpl');
$conn->close();
?>
