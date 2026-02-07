<?php 
session_start();
// if ($_SESSION['user'] == ""){
//   header('Location:../logIn.php');

//  }
//  else {
//   include("header.php");
//   echo "</div>";
//   include("footer.php");

//  }

// echo $_SESSION['user'];

if (!isset($_SESSION['user']) || $_SESSION['user'] === "") {
    header("Location: logIn.php");
    exit;
}

include("Admin/header.php");
// page content here
include("Admin/footer.php");
 




