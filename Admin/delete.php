<?php
include('../Connection.php');
  
   
$id = $_POST['txtid'];
$tableName = $_POST['tableName'];
$colName = $_POST['colName'];
$sql = "DELETE FROM ".$tableName." WHERE ".$colName."='".$id."'";

$result = $conn->query($sql);
    if($result){
        echo "record has been DELETED.thanks";
    }


