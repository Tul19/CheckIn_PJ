<?php
// Include the database configuration
include 'config.php';

// Check if the required parameters are set
if (isset($_POST['teacher_username'])) {
    // Sanitize user input to prevent SQL injection
    $teacherUsername = $mysqli->real_escape_string($_POST['teacher_username']);

    // Start a transaction for atomicity
    $mysqli->begin_transaction();

    try {
        // Get teacher ID from the 'users' table
        $teacherIdQuery = "SELECT id FROM users WHERE username = '$teacherUsername'";
        $teacherResult = $mysqli->query($teacherIdQuery);

        if ($teacherResult->num_rows > 0) {
            $teacherRow = $teacherResult->fetch_assoc();
            $teacherId = $teacherRow['id'];

            // Update class status in the 'users' table for the teacher
            $updateUserQuery = "UPDATE users SET class_status = 'OPEN' WHERE id = '$teacherId' AND role = 'teacher'";

            if ($mysqli->query($updateUserQuery)) {
                // Insert class information into the 'classes' table
                $insertClassQuery = "INSERT INTO classes (teacher_id, class_time, class_status) VALUES ('$teacherId', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 7 HOUR), 'OPEN')";

                if ($mysqli->query($insertClassQuery)) {
                    // Commit the transaction if both operations are successful
                    $mysqli->commit();
                    echo "Class opened successfully!";
                } else {
                    // Roll back the transaction if there's an error in inserting class information
                    $mysqli->rollback();
                    echo "Error inserting class information: " . $mysqli->error;
                }
            } else {
                // Roll back the transaction if there's an error in updating class status in the users table
                $mysqli->rollback();
                echo "Error updating class status in users table: " . $mysqli->error;
            }
        } else {
            echo "Teacher not found.";
        }
    } catch (Exception $e) {
        // Roll back the transaction in case of any exception
        $mysqli->rollback();
        echo "Transaction failed: " . $e->getMessage();
    }
} else {
    echo "Missing parameters";
}

// Close the database connection
$mysqli->close();
?>
