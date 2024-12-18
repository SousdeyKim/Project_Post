<?php
include("../Connection.php"); 

$user = $_POST['txtuser'];
$pass = $_POST['txtpass'];

$sql = "INSERT INTO seller (username, `password`, `status`) VALUES(?, ?, 1)";
$stmt = $conn->prepare($sql); //it makes the SQL query (in the variable $sql)  ready for execution.
$stmt->bind_param("ss", $user, $pass);  //bind parameters
$stmt->execute();
// $result = $stmt->get_result();  // Fetch the result



echo 1;

