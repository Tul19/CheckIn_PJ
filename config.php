<?php
// Database configuration
define('servername', 'localhost');  // Replace with your database host (e.g., localhost)
define('username', 'id21952530_male');  // Replace with your database username
define('password', 'Checkin12345.');  // Replace with your database password
define('dbname', 'id21952530_checkin');  // Replace with your database name

// Create connection
$mysqli = new mysqli(servername, username, password, dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
