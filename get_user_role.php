<?php
include 'config.php';

if (isset($_GET['username'])) {
    $username = $mysqli->real_escape_string($_GET['username']);

    $query = "SELECT role FROM users WHERE username = '$username'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['role'];
    } else {
        echo "User not found";
    }
} else {
    echo "Missing parameters";
}

$mysqli->close();
?>
