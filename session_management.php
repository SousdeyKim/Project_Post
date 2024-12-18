<?php
session_start();
include("Connection.php"); 

// Check if the user is already logged in
if (!isset($_SESSION['User']) && isset($_COOKIE['remember_me'])) {
    // Get the token from the cookie
    $token = $_COOKIE['remember_me'];

    // Find the user in the database by the token
    $sql = "SELECT * FROM users WHERE remember_token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $userData = $result->fetch_assoc();
        // Log the user in by setting the session variable
        $_SESSION['User'] = $userData['username'];
    }
    $stmt->close();
}

