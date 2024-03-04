<?php
// Include the database configuration
include 'config.php';

// Check if the required parameters are set
if (isset($_POST['username'])) {
    // Sanitize user input to prevent SQL injection
    $username = $mysqli->real_escape_string($_POST['username']);

    // Get user location data from the 'user_location' table
    $locationQuery = "SELECT latitude, longitude FROM user_location WHERE user_id = (SELECT id FROM users WHERE username = '$username')";
    $result = $mysqli->query($locationQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Return latitude and longitude separated by a space
        echo $row['latitude'] . " " . $row['longitude'];
    } else {
        // Handle the case where no location data is found
        echo "No location data available";
    }
} else {
    // Handle the case of missing parameters
    echo "Missing parameters";
}

// Close the database connection
$mysqli->close();
?>
