<?php 
include('../Connection.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    a {
      text-decoration: none;
    }
    .invoice-box {
      width: 100%;
      margin: auto;
      padding: 30px;
      border: 1px solid #eee;
      box-shadow: 0 0 10px rgba(0, 0, 0, .15);
      font-size: 16px;
      line-height: 24px;
      font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      color: #555;
    }
    .invoice-box thead {
      width: 100%;
    }
    .invoice-box table {
      width: 100%;
      line-height: inherit;
      text-align: left;
    }
    .invoice-box table td {
      padding: 5px;
      vertical-align: top;
    }
    .invoice-box table tr td:nth-child(n+2) {
      text-align: right;
    }
    .invoice-box table tr.item input {
      padding-left: 5px;
    }
    .fixed-bottom {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 1000;
    }
  </style>
</head>

<body class="bg-black">
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="images/companyLogo.png" alt="Avatar Logo" style="width:40px;" class="rounded-pill"> 
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Categories.php">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Product.php">Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Sale.php">Sale</a>
        </li>  
        <li class="nav-item">
          <a class="nav-link" href="performance.php">Performance</a>
        </li> 
      </ul>
      <a class="navbar-brand me-2" href="#"  data-bs-toggle="modal" data-bs-target="#signOutModal" id="singOut">
        <img src="images/istockphoto-1495088043-612x612.jpg" alt="Avatar Logo" style="width:40px;" class="rounded-pill"> 
      </a>
    </div>
  </div>
</nav>

<div class="modal fade " id="signOutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <button   >ssss</button>  
      </div>
      <div class="modal-body">
        <button  >ssss</button>  
      </div>
      
      <div class="modal-footer d-flex justify-content-center" style="text-align: center;" >
        <a align="center" href="../signOut.php" class="text-danger">Sign Out</a>

      </div>
      
    </div>
  </div>
</div>

<div class="container my-5">
