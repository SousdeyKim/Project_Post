<?php 
session_start();
if ($_SESSION['user'] == ""){
  header('Location:../logIn.php');

 }
 else {
  include("header.php");
  echo "</div>";
  include("footer.php");

 }

// echo $_SESSION['user'];

 
  




