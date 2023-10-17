<!DOCTYPE html>
<html>
<head>
    <title>Update Weather Data</title>
 <link rel="stylesheet" href="styles/style_update.css">                  
</head>
<body>
    <h1>Update Weather Data</h1>
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="<?php echo $city; ?>" required><br>
        <label for="temperature">Temperature (°C):</label>
        <input type="number" id="temperature" name="temperature" step="0.01" value="<?php echo $temperature; ?>" required><br>
        <label for="humidity">Humidity (%):</label>
        <input type="number" id="humidity" name="humidity" step="0.01" value="<?php echo $humidity; ?>" required><br>
        <label for="wind">Wind Speed (m/s):</label>
        <input type="number" id="wind" name="wind" step="0.01" value="<?php echo $wind_speed; ?>" required><br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $date; ?>" required><br>
        <label for="time">Time:</label>
        <input type="time" id="time" name="time" value="<?php echo $time; ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
