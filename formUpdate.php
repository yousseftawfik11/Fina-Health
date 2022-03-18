<?php

session_start();

if (isset($_POST["editBatch"])) {
    $batchID = $_SESSION['batchID'];
    $deliveyDate = $_SESSION['delivery_date'];
    $totalPrice = $_SESSION['totalPrice'];
    $itemNo = $_SESSION['itemNo'];
    $itemName = $_SESSION['itemName'];
    $quantity = $_SESSION['quantity'];
    $price = $_SESSION['price'];

    include 'db.php' ;
 
  
    $query = "SELECT * FROM batch WHERE batchID = '$batchID'";
    $result = $conn->query($query);
    if($result->num_rows == 0){
 
      $itemList=implode(",",$itemNo);
      $quantityList=implode(",",$quantity);
      $tp = floatval($totalPrice);
  
      
      $mainQuery = "INSERT INTO batch SET batchID='$batchID',itemList='$itemList',quantityList='$quantityList',delivery_Date='$deliveyDate',total_price='$tp'";
      $result1 = $conn->query($mainQuery) or die("Error in main Query".$conn->error);
      echo "File Uploaded Successfully". $arrayFile.  "<br>";
 
      for($i = 0; $i < count($itemNo); $i++){
 
      $query = "SELECT quantity FROM inventoryitem WHERE itemID = '$itemNo[$i]'";
      $result1 = $conn->query($query) or die("Error in main Query".$conn->error);
      $row = mysqli_fetch_array($result1);
 
      $q =  $row['quantity'] + $quantity[$i];
 
 
      $sql = "UPDATE inventoryitem SET quantity='$q' WHERE itemID='$itemNo[$i]'";
      $result1 = $conn->query($sql) or die("Error in main Query".$conn->error);
 
 
     }
    }else{
      echo "Duplicate Batch ID<br>";
    }

}

?>