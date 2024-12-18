<?php
session_start();
include("../Connection.php");

$response = [];

// Fetch the data sent via POST
$username = isset($_POST['username']) ? $_POST['username'] : null;
$newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : null;
$status = isset($_POST['status']) ? $_POST['status'] : null;

// Update only the fields that were sent
if ($username && $username !== $_SESSION['user']) {
    $stmt = $conn->prepare("UPDATE seller SET username = ? WHERE username = ?");
    $stmt->bind_param("ss", $username, $_SESSION['user']);
    if ($stmt->execute()) {
        $_SESSION['user'] = $username; // Update session value
        $response[] = "Username updated successfully.";
    }
}

if ($newPassword) {
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Hash the new password
    $stmt = $conn->prepare("UPDATE seller SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $hashedPassword, $_SESSION['user']);
    if ($stmt->execute()) {
        $response[] = "Password updated successfully.";
    }
}

if ($status !== null && $status !== "") {
    $stmt = $conn->prepare("UPDATE seller SET status = ? WHERE username = ?");
    $stmt->bind_param("is", $status, $_SESSION['user']);
    if ($stmt->execute()) {
        $response[] = "Status updated successfully.";
    }
}

// Return a response
if (empty($response)) {
    echo "No updates made.";
} else {
    echo implode(" ", $response);
}

