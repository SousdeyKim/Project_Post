<?php 	
	// include("../Connection.php");
  

	// $fdate = $_POST['fdate'];
	// $tdate = $_POST['tdate'];
	// $sluser = $_POST['user'];
  // // echo $sluser;

	// $sql ="";
	// if($sluser==0){
	// 	$sql = "SELECT * FROM `order` WHERE order_date>=$fdate AND order_date<='".$tdate."'";
	// }else{
	// 	$sql = "SELECT * FROM `order` WHERE order_date>=$fdate AND order_date<='".$tdate."' AND sellerID='".$sluser."'";
	// }

	// $result = $conn->query($sql);
	// if($result->num_rows > 0){
	// 	while ($row = $result->fetch_object()) {
	// 		$orderid = $row->order_id;
	// 		$ordered_date = $row->order_date;
	// 		$orderby = $row->sellerID;
	// 		$total	 = $row->Subtotal;
	// 		$discount = $row->{'discount(%)'};
	// 		$grand_total	 = $row->grand_total;
	// 		echo "<tr>
  //               <td>".$orderid."</td>
  //               <td>".$ordered_date."</td>
  //               <td>".$orderby."</td>
  //               <td>".$total."</td>
  //                <td>".$discount."</td>
  //               <td>".$grand_total."</td>
  //             </tr>";
	// 	}
	// }

  // $sql ="";
  // $sql = "SELECT * FROM `order_detail`
  // INNER JOIN products ON order_detail.product_id = products.proid
  // WHERE order_detail.order_id = $orderid;";



	// $result = $conn->query($sql);
	// if($result->num_rows > 0){
	// 	while ($row = $result->fetch_object()) {
  //     $receipt_item_id = $row->receipt_item_id;
  //     $orderid = $row->order_id;
	// 		$proid	 = $row->product_id;
	// 		$quantity	 = $row->quantity;
  //     $price	 = $row->price;
  //     $proName = $row->proname;

	// 		echo ";<tr>
  //               <td>".$receipt_item_id."</td>
  //               <td>".$orderid."</td>
  //               <td>".$proid."</td>
  //               <td>".$proName."</td>
  //               <td>".$quantity."</td>
  //                <td>".$price."</td>
  //             </tr>";
	// 	}
	// }


include("../Connection.php");

$fdate = $_POST['fdate'];
$tdate = $_POST['tdate'];
$sluser = $_POST['user'];

if ($sluser == 0) {
    $sql = "SELECT * FROM `order` WHERE order_date >= '$fdate' AND order_date <= '$tdate'";
} else {
    $sql = "SELECT * FROM `order` WHERE order_date >= '$fdate' AND order_date <= '$tdate' AND sellerID = '$sluser'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        $orderid = $row->order_id;
        $ordered_date = $row->order_date;
        $orderby = $row->sellerID;
        $total = $row->Subtotal;
        $discount = $row->{'discount(%)'};
        $grand_total = $row->grand_total;

        $str1.= "<tr>
                <td>".$orderid."</td>
                <td>".$ordered_date."</td>
                <td>".$orderby."</td>
                <td>".$total."</td>
                <td>".$discount."</td>
                <td class='sumGrandTotal'>".$grand_total."</td>
              </tr>";

        $detail_sql = "SELECT order_detail.*, products.proname 
                       FROM order_detail 
                       INNER JOIN products ON order_detail.product_id = products.proid 
                       WHERE order_detail.order_id = '$orderid'";

        $detail_result = $conn->query($detail_sql);

        if ($detail_result->num_rows > 0) {
            while ($detail_row = $detail_result->fetch_object()) {
                $receipt_item_id = $detail_row->receipt_item_id;
                $proid = $detail_row->product_id;
                $quantity = $detail_row->quantity;
                $price = $detail_row->price;
                $proName = $detail_row->proname;

               $str2.= "<tr>
                        <td>".$receipt_item_id."</td>
                        <td>".$orderid."</td>
                        <td>".$proid."</td>
                        <td>".$proName."</td>
                        <td>".$quantity."</td>
                        <td>".$price."</td>
                      </tr>";
            }
        }
    }
}

echo $str1 . ";" . $str2;
	

