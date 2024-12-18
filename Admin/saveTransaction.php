<?php
    
include("../Connection.php");
session_start();

$user = $_SESSION['user'];

$pid = $_POST['pid'];
$qty = $_POST['qty'];
$price = $_POST['price'];

$paid = isset($_POST['paid']) ? $_POST['paid'] : 0;
// $payment_date = isset($_POST['payment_date']) ? $_POST['payment_date'] : null;
$order_date = isset($_POST['order_date']) ? $_POST['order_date'] : date("Y-m-d");
$subtotal = isset($_POST['subtotal']) ? $_POST['subtotal'] : 0;
$grand_total = isset($_POST['grand_total']) ? $_POST['grand_total'] : 0;
$discount = isset($_POST['discount']) ? $_POST['discount'] : 0;
$return_amount = isset($_POST['return_amount']) ? $_POST['return_amount'] : 0;

$sql = "SELECT id FROM seller WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($seller_id);
$stmt->fetch();
// echo $order_date;


// $str = "$pid;$qty;$price;$seller_id;$paid";	
// echo $order_date;


if (!$seller_id) {
    $stmt->close();
    $conn->close();
    exit();
}
$stmt->close();

$sql = "INSERT INTO `order` (order_date, Subtotal, grand_total, `discount(%)`, paid, `return`, sellerID) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);


$stmt->bind_param("sdddddi", $order_date, $subtotal, $grand_total, $discount, $paid, $return_amount, $seller_id);

if ($stmt->execute()) {
    $order_id = $stmt->insert_id; // Get the last inserted ID for order
} else {
    echo "Error: " . $stmt->error;
    $stmt->close();
    $conn->close();
    exit();
}

$stmt->close();

$sql = "INSERT INTO order_detail (product_id, quantity, price, order_id) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

$arrPid = explode(";", $pid);
$arrQty = explode(";", $qty);
$arrPrice = explode(";", $price);
$length = count($arrPid) - 1;

for ($i = 0; $i < $length; $i++) {
    $product_id = $arrPid[$i];
    $quantity = $arrQty[$i];
    $price = $arrPrice[$i];

    $stmt->bind_param("iidi", $product_id, $quantity, $price, $order_id);
    $stmt->execute();
}

 
echo 1;
$stmt->close();
$conn->close();




