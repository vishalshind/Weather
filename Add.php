<?php
require 'vendor/autoload.php';                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      require 'vendor/registry.php';

class Add {
    private static $smarty;

    public static function init() {
        self::$smarty = new Smarty;self::addAction();
    }

    private static function addAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle the form submission here
            $city = $_POST['addCity'];
            $temperature = $_POST['addTemperature'];
            $humidity = $_POST['addHumidity'];
            $windSpeed = $_POST['addWindSpeed'];
            $date = $_POST['addDate'];
            $time = $_POST['addTime'];

            // Retrieve the database connection from Zend Registry
            $conn = Zend_Registry::get('database_connection');

            // Implement the SQL INSERT query here using $conn
            $sql = "INSERT INTO weather4 (city, temperature, humidity, wind_speed, date, time)
                    VALUES ('$city', '$temperature', '$humidity', '$windSpeed', '$date', '$time')";

            if ($conn->query($sql)) {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               r('index.php');
                // Use Zend Framework's Redirector for redirection
                $zfRedirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
                $zfRedirector->gotoUrl('index.php'); // Redirect to the 'index.php' page
                
                 } else {
                // Handle the error here if the query fails
                // For example, you can display an error message in the template
                self::$smarty->assign('errorMessage', 'Error inserting data.');
            }
        }

        // Display the template even if no data is inserted
self::$smarty->display('views/add.tpl');}}                                                                                                                                                                                                                                                                                                                                                                                                                                              Add::init();
?>
