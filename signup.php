<?php
// Include the database configuration
include 'config.php';

// Check if the required parameters are set
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Sanitize user input to prevent SQL injection
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);

    // Check if the username already exists
    $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
    $result = $mysqli->query($checkUsernameQuery);

    if ($result->num_rows > 0) {
        // Username already exists, provide a response
        echo "Username already in use. Please choose a different username.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert new user into the 'users' table
        $insertQuery = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";

        // Execute the query
        if ($mysqli->query($insertQuery)) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $mysqli->error;
        }
    }
} else {
    echo "Missing parameters";
}

// Close the database connection
$mysqli->close();
?>
