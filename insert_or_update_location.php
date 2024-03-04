<?php
// Include the database configuration
include 'config.php';

// Check if the required parameters are set
if (isset($_POST['username']) && isset($_POST['latitude']) && isset($_POST['longitude'])) {
    // Sanitize user input to prevent SQL injection
    $username = $mysqli->real_escape_string($_POST['username']);
    $latitude = $mysqli->real_escape_string($_POST['latitude']);
    $longitude = $mysqli->real_escape_string($_POST['longitude']);

    // Get user ID from the 'users' table using prepared statement
    $userIdQuery = "SELECT id FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($userIdQuery);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['id'];

        // Check if location data already exists for the user
        $existingLocationQuery = "SELECT * FROM user_location WHERE user_id = ?";
        $stmt = $mysqli->prepare($existingLocationQuery);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $existingLocationResult = $stmt->get_result();

        if ($existingLocationResult->num_rows > 0) {
            // Update the existing location data
            $updateQuery = "UPDATE user_location SET latitude=?, longitude=? WHERE user_id=?";
            $stmt = $mysqli->prepare($updateQuery);
            $stmt->bind_param('dds', $latitude, $longitude, $userId);
            if ($stmt->execute()) {
                echo "Location data updated successfully!";
            } else {
                echo "Error updating location data: " . $stmt->error;
            }
        } else {
            // Insert location data into the 'user_location' table
            $insertQuery = "INSERT INTO user_location (user_id, latitude, longitude) VALUES (?, ?, ?)";
            $stmt = $mysqli->prepare($insertQuery);
            $stmt->bind_param('dds', $userId, $latitude, $longitude);
            if ($stmt->execute()) {
                echo "Location data inserted successfully!";
            } else {
                echo "Error inserting location data: " . $stmt->error;
            }
        }
    } else {
        echo "User not found";
    }

    $stmt->close();
} else {
    echo "Missing parameters";
}

// Close the database connection
$mysqli->close();
?>
