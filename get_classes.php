<?php
// Include the database configuration
include 'config.php';

// Check if the required parameter is set
if (isset($_GET['teacher_username'])) {
    // Sanitize user input to prevent SQL injection
    $teacherUsername = $mysqli->real_escape_string($_GET['teacher_username']);

    // Fetch all class times from the 'classes' table for the specified teacher
    $selectQuery = "SELECT DISTINCT class_time FROM classes WHERE teacher_id IN (SELECT id FROM users WHERE username = '$teacherUsername')";
    $result = $mysqli->query($selectQuery);

    $classList = array();
    while ($row = $result->fetch_assoc()) {
        $classList[] = $row['class_time'];
    }

    // Return the list as a JSON-encoded string
    echo json_encode($classList);
} else {
    echo "Missing parameters";
}

// Close the database connection
$mysqli->close();
?>
