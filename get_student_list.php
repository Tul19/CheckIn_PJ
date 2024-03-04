<?php
// Include the database configuration
include 'config.php';

// Check if the required parameters are set
if (isset($_GET['teacher_username']) && isset($_GET['class_time'])) {
    // Sanitize user input to prevent SQL injection
    $teacherUsername = $mysqli->real_escape_string($_GET['teacher_username']);
    $classTime = $mysqli->real_escape_string($_GET['class_time']);

    // Fetch student usernames who checked in for the specified class_time and teacher
    $selectQuery = "SELECT u.username, TIME(c.check_in_time) AS check_in_time
                    FROM users u
                    JOIN check_ins c ON u.id = c.student_id
                    WHERE c.teacher_id IN (SELECT id FROM users WHERE username = '$teacherUsername')
                    AND c.class_time = '$classTime'";
    
    $result = $mysqli->query($selectQuery);

    $studentList = array();
    while ($row = $result->fetch_assoc()) {
        $studentList[] = $row['username'] . " " . $row['check_in_time'];
    }

    // Get the number of students
    $numStudents = count($studentList);

    // Add the "Student Count" text to the beginning of the list
    array_unshift($studentList, "Student Count : $numStudents");

    // Return the list and the number of students as a JSON-encoded string
    echo json_encode($studentList);
} else {
    echo "Missing parameters";
}

// Close the database connection
$mysqli->close();
?>
