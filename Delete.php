<?php
require 'vendor/autoload.php'; // Load Smarty library
$smarty = new Smarty; // Initialize Smarty

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "weather5";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the record with the given 'id' from the database
    $deleteSql = "DELETE FROM weather5 WHERE id = '$id'";

    if ($conn->query($deleteSql) === TRUE) {
        // Redirect back to the index page after deleting
        header("Location: index.php");
        exit();
    } else {
        // Handle the case where deletion failed (you can display an error message)
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // 'id' not provided in the URL, redirect to index or display an error
    header("Location: index.php");
    exit();
}

$conn->close();
?>
