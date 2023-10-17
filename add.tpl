<!DOCTYPE html>
<html>
<head>
    <title>Add Weather Data</title>
    <link rel="stylesheet" href="styles/style_add.css">                  
</head>
<body>
    <div class="container">
        <!-- Add Form -->
        <h2 class="section-title">Add Weather Data:</h2>
        <div class="add-form">
            <form method="post" action="Add.php">
                <label for="addCity">City:</label>
                <input type="text" id="addCity" name="addCity" required>
                <label for="addTemperature">Temperature:</label>
                <input type="text" id="addTemperature" name="addTemperature" required>
                <label for="addHumidity">Humidity:</label>
                <input type="text" id="addHumidity" name="addHumidity" required>
                <label for="addWindSpeed">Wind Speed:</label>
                <input type="text" id="addWindSpeed" name="addWindSpeed" required>
                <label for="addDate">Date:</label>
                <input type="date" id="addDate" name="addDate" required>
                <label for="addTime">Time:</label>
                <input type="time" id="addTime" name="addTime" required>

                <button type="submit">Add</button>
            </form>
        </div>
    </div>

    </body>
</html>
