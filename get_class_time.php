<?php
// Include the database configuration
include 'config.php';

// Check if the required parameter is set
if (isset($_POST['teacher_username'])) {
    // Sanitize user input to prevent SQL injection
    $teacherUsername = $mysqli->real_escape_string($_POST['teacher_username']);

    // Get class_time from the 'classes' table for the open class of the specified teacher
    $classQuery = "SELECT class_time FROM classes WHERE teacher_id = (SELECT id FROM users WHERE username = '$teacherUsername') AND class_status = 'OPEN'";
    $result = $mysqli->query($classQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Return the class_time
        echo $row['class_time'];
    } else {
        // Handle the case where no open class is found
        echo "No open class found for the specified teacher.";
    }
} else {
    // Handle the case of missing parameters
    echo "Missing parameters";
}

// Close the database connection
$mysqli->close();
?>
