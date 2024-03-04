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
            $updateUserQuery = "UPDATE users SET class_status = 'CLOSE' WHERE id = '$teacherId' AND role = 'teacher'";

            if ($mysqli->query($updateUserQuery)) {
                // Update class status in the 'classes' table
                $updateClassQuery = "UPDATE classes SET class_status = 'CLOSE' WHERE teacher_id = '$teacherId' AND class_status = 'OPEN'";

                if ($mysqli->query($updateClassQuery)) {
                    // Commit the transaction if closing the class is successful
                    $mysqli->commit();
                    echo "Class closed successfully!";
                } else {
                    // Roll back the transaction if there's an error in updating class status in the classes table
                    $mysqli->rollback();
                    echo "Error updating class status in classes table: " . $mysqli->error;
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
