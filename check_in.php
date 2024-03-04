<?php
// Include the database configuration
include 'config.php';

// Check if the required parameters are set
if (isset($_POST['student_username']) && isset($_POST['teacher_username']) && isset($_POST['class_time'])) {
    // Sanitize user input to prevent SQL injection
    $studentUsername = $mysqli->real_escape_string($_POST['student_username']);
    $teacherUsername = $mysqli->real_escape_string($_POST['teacher_username']);
    $classTime = $mysqli->real_escape_string($_POST['class_time']);

    // Get student and teacher IDs from the 'users' table
    $studentIdQuery = "SELECT id FROM users WHERE username = '$studentUsername'";
    $teacherIdQuery = "SELECT id FROM users WHERE username = '$teacherUsername'";
    
    $studentResult = $mysqli->query($studentIdQuery);
    $teacherResult = $mysqli->query($teacherIdQuery);

    if ($studentResult->num_rows > 0 && $teacherResult->num_rows > 0) {
        $studentRow = $studentResult->fetch_assoc();
        $teacherRow = $teacherResult->fetch_assoc();

        $studentId = $studentRow['id'];
        $teacherId = $teacherRow['id'];

        // Check if the student has already checked in for the given class
        $checkExistingQuery = "SELECT * FROM check_ins WHERE student_id = '$studentId' AND teacher_id = '$teacherId' AND class_time = '$classTime'";
        $existingResult = $mysqli->query($checkExistingQuery);

        if ($existingResult->num_rows > 0) {
            echo "Student has already checked in for this class.";
        } else {
            // Insert check-in data into the 'check_ins' table with current timestamp plus 7 hours
            $insertQuery = "INSERT INTO check_ins (student_id, teacher_id, class_time, check_in_time) 
                            VALUES ('$studentId', '$teacherId', '$classTime', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 7 HOUR))";

            if ($mysqli->query($insertQuery)) {
                echo "Check-in successful!";
            } else {
                echo "Error inserting check-in data: " . $mysqli->error;
            }
        }
    } else {
        echo "Student or teacher not found.";
    }
} else {
    echo "Missing parameters";
}

// Close the database connection
$mysqli->close();
?>
