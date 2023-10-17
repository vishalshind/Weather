<?php
require 'vendor/autoload.php'; // Load Smarty library

// Define your database connection credentials
$host = "localhost:3306";
$username = "root";
$password = "";
$database = "weather5";

// Create a new MySQLi instance
$mysqli = new mysqli($host, $username, $password, $database);

// Check the database connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Store the database connection in Zend Registry
Zend_Registry::set('database_connection', $mysqli);

// Define the Update class for handling updates and deletes
class Update
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function updateData($id, $city, $temperature, $humidity, $wind_speed, $date, $time)
    {
        // Prepare and execute the SQL update statement
        $stmt = $this->mysqli->prepare("UPDATE weather5 SET city=?, temperature=?, humidity=?, wind_speed=?, date=?, time=? WHERE id=?");
        $stmt->bind_param("ssddssi", $city, $temperature, $humidity, $wind_speed, $date, $time, $id);

        if ($stmt->execute()) {
            return true; // Record updated successfully
        } else {
            return false; // Update failed
        }
    }

    public function deleteData($id)
    {
        // Prepare and execute the SQL delete statement
        $stmt = $this->mysqli->prepare("DELETE FROM weather5 WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true; // Record deleted successfully
        } else {
            return false; // Delete failed
        }
    }

    public function fetchDataById($id)
    {
        // Prepare and execute the SQL select statement
        $stmt = $this->mysqli->prepare("SELECT * FROM weather5 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // Fetch the data for the ID
            return $result->fetch_assoc();
        } else {
            return null; // No record found for the specified ID
        }
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update = new Update($mysqli);

    $id = $_POST['id'];
    $city = $_POST['city'];
    $temperature = $_POST['temperature'];
    $humidity = $_POST['humidity'];
    $wind_speed = $_POST['wind'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    if (isset($_POST['update'])) {
        // Update the record
        if ($update->updateData($id, $city, $temperature, $humidity, $wind_speed, $date, $time)) {
            // Record updated successfully, redirect to the index.php page
            header("Location: index.php");
        } else {
            // Handle the error
            echo "Error updating record.";
        }
    }

    if (isset($_POST['delete'])) {
        // Delete the record
        if ($update->deleteData($id)) {
            // Record deleted successfully, redirect to the index.php page
            header("Location: index.php");
        } else {
            // Handle the error
            echo "Error deleting record.";
        }
    }
}

// Fetch the existing data for the specified ID
if (isset($_GET['id'])) {
    $update = new Update($mysqli);
    $id = $_GET['id'];
    $data = $update->fetchDataById($id);

    if (!$data) {
        // No record found for the specified ID, handle the error
        echo "No record found for ID: $id";
        exit();
    }

    $city = $data['city'];
    $temperature = $data['temperature'];
    $humidity = $data['humidity'];
    $wind_speed = $data['wind_speed'];
    $date = $data['date'];
    $time = $data['time'];
}

// Close the database connection (You may choose to remove this as Zend Registry will manage the connection)
$mysqli->close();
?>
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
        <input type="submit" name="update" value="Update">
        <input type="submit" name="delete" value="Delete">
    </form>
</body>
</html>
