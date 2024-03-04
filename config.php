<?php
// Database configuration
define('servername', 'localhost');  // Replace with your database host (e.g., localhost)
define('username', 'id21922441_userinfo');  // Replace with your database username
define('password', 'Q464z!YWP!r>VWG8');  // Replace with your database password
define('dbname', 'id21922441_userdb');  // Replace with your database name

// Create connection
$mysqli = new mysqli(servername, username, password, dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
