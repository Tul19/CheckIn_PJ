<?php
// Include the database configuration
include 'config.php';

// Check if the required parameters are set
if (isset($_POST['username'])) {
    // Sanitize user input to prevent SQL injection
    $username = $mysqli->real_escape_string($_POST['username']);

    // Retrieve class status from the 'users' table for the teacher
    $selectQuery = "SELECT class_status FROM users WHERE username = '$username' AND role = 'teacher'";
    $result = $mysqli->query($selectQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Return class status
        echo $row['class_status'];
    } else {
        // Handle the case where no record is found
        echo "Teacher not found or class status not available";
    }
} else {
    echo "Missing parameters";
}

// Close the database connection
$mysqli->close();
?>
