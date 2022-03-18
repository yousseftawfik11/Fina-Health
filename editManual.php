<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="jquery.tabledit.min.js"></script> 
    <style> .left {margin-left:43%;text-align:left;margin-top:2%;margin-bottom:2%} </style>

    <!--Font Awesome 4 CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<body>
<div class="container">
        <div class="row">
            <div class="col">
                <a href="logout.php"><i class="fa fa-sign-out"> Logout</i></a>
            </div>
        </div>
    </div>
<h3 align="center">Item Table</h3>
   <br />

<?php

session_start();
include 'scrubData.php';

$fileData = $_SESSION['arrayManualEditData'];

for($i=0;$i<count($fileData);$i++){

    showEditTable($fileData[$i][0], $fileData[$i][1], $fileData[$i][2], $fileData[$i][3], $fileData[$i][4], $fileData[$i][5], $fileData[$i][6]);

}


function showEditTable($batchID, $deliveyDate, $itemNo, $itemName, $quantity, $price, $totalPrice)
{
    
    $_SESSION['batchID'] = $batchID;
    $_SESSION['delivery_date'] = $deliveyDate;
    $_SESSION['totalPrice'] = $totalPrice;
  
    $_SESSION['itemNo'] = $itemNo;
    $_SESSION['itemName'] = $itemName;
    $_SESSION['quantity'] = $quantity;
    $_SESSION['price'] = $price;

    ?>
     <div class="table-responsive">
    <table id="editable_table" class="table table-bordered table-striped">
  
    <?php
    echo "<tr><th>Batch Id: ".$batchID;
    $result = scrubBatchID($batchID);
    if($result == 1){
        $verify = 1;
        echo "&ensp;<i class='fa fa-times' style='color: red;'></i></th>";
    };

    echo "<th>Delivery Date: ".$deliveyDate;
    $result = scrubDeliveryDate($deliveyDate);
            if($result == 1){
                $verify = 1;
                echo "&ensp;<i class='fa fa-times' style='color: red;'></i></th>";
            };

    
    echo "<th>Total Price: RM" .$totalPrice;
    $result = scrubNumericData($totalPrice);
            if($result == 1){
                $verify = 1;
                echo "&ensp;<i class='fa fa-times' style='color: red;'></i></th>";
            };
?>

    <th>
</th>
</tr>
  
    
     <tr>
     <th>Item Id</th>
     <th>Item Name</th>
     <th>Quantity</th>
     <th>Price</th>
     

</tr>
     
     <tbody>
         <?php
    
    for($i = 0; $i < count($itemNo); $i++){
        ?>
        <tr>
            <td><?php
            echo $itemNo[$i];

            $result = scrubNumericData($itemNo[$i]);
            if($result == 1){
                $verify = 1;
                echo "&ensp;<i class='fa fa-times' style='color: red;'></i>";
            }


            ?></td>

            <td><?php
             echo$itemName[$i];

             $result = scrubStringData($itemName[$i]);
            if($result == 1){
                $verify = 1;
                echo "&ensp;<i class='fa fa-times' style='color: red;'></i>";
            }

             ?></td>
             
            <td><?php
            echo $quantity[$i];
            
            $result = scrubNumericData($quantity[$i]);
            if($result == 1){
                $verify = 1;
                echo "&ensp;<i class='fa fa-times' style='color: red;'></i>";
            }

            ?>
            </td>
            <td><?php
            echo$price[$i];

            $result = scrubNumericData($price[$i]);
            if($result == 1){
                $verify = 1;
                echo "&ensp;<i class='fa fa-times' style='color: red;'></i>";
            }

            ?>
               
    
    
    <?php
               
              
      }
    

     ?></td>

</tr>
  

<tbody>

    </table>
    <form action="formUpdate.php" method="post">
                   <div class="col-md-9">
                <input type="submit" name="editBatch" value="EDIT" class="btn" />
                 </div>

                 </form>



    <br>
   
     <?php
}



?>



