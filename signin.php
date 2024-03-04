<?php
// Include the database configuration
include 'config.php';

// Check if the required parameters are set
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Sanitize user input to prevent SQL injection
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);

    // Retrieve hashed password from the 'users' table
    $selectQuery = "SELECT password FROM users WHERE username = '$username'";
    $result = $mysqli->query($selectQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            echo "Login successful!";
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
} else {
    echo "Missing parameters";
}

// Close the database connection
$mysqli->close();
?>
