<?php
// session_start();
// include('../Connection.php');




// $user = $_POST['txtuser'];
// $pass = $_POST['txtpass'];
// // echo $user;

// $sql = "SELECT * FROM seller WHERE username = '$user' AND password = '$pass'";
// $result = $conn->query($sql);
// if($result->num_rows >0){
//   $_SESSION['user'] =$user;
//   echo 1;
// }
// else {
//   echo 0;
// }


session_start();
include("../Connection.php"); 

$user = $_POST['txtuser'];
$pass = $_POST['txtpass'];

$remember = isset($_POST['remember']) ? $_POST['remember'] : false;

$sql = "SELECT * FROM seller WHERE username = ? AND `password` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // User is authenticated
    $userData = $result->fetch_assoc();
    $_SESSION['user'] = $userData['username'];
    
    if ($remember) {
        // Generate a unique token for the user
        $token = bin2hex(random_bytes(16));
        
        // Store the token in a database column, `remember_token`, for this user
        $updateTokenSql = "UPDATE seller SET remember_token = ? WHERE username = ?";
        $updateStmt = $conn->prepare($updateTokenSql);
        $updateStmt->bind_param("ss", $token, $user);
        $updateStmt->execute();
        
        // Set a cookie with the token (expires in 30 days)
        setcookie("remember_me", $token, time() + (86400 * 30), "/"); // 86400 = 1 day
    }
    echo 1; // Login successful
} else {
    // Login failed
    echo 0;
}

$stmt->close();
$conn->close();

// echo 1;

 


