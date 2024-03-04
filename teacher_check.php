<?php
// Include the database configuration
include 'config.php';

// Check if the required parameter is set
if (isset($_POST['username'])) {
    // Sanitize user input to prevent SQL injection
    $username = $mysqli->real_escape_string($_POST['username']);

    // Check if the user is a teacher
    $checkTeacherQuery = "SELECT * FROM users WHERE username = '$username' AND role = 'teacher'";
    $result = $mysqli->query($checkTeacherQuery);

    if ($result->num_rows > 0) {
        // User is a teacher
        echo "User is a teacher";
    } else {
        // User is not a teacher
        echo "User is not a teacher";
    }
} else {
    echo "Missing parameters";
}

// Close the database connection
$mysqli->close();
?>
