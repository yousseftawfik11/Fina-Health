<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="jquery.tabledit.min.js"></script> 
    <style> .left {margin-left:43%;text-align:left;margin-top:2%;margin-bottom:2%} </style>

    <!--Font Awesome 4 CDN-->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
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
<h3 align="center">Item Table</h3>
   <br />

<?php

session_start();

$fileData = $_SESSION['arrayManualEditData'];

for($i=0;$i<count($fileData);$i++){

    showEditTable($fileData[$i][0], $fileData[$i][1], $fileData[$i][2], $fileData[$i][3], $fileData[$i][4], $fileData[$i][5], $fileData[$i][6]);

}

//scrub DATA
// echo "<br>";
// echo $batchID;
// $boolBID = scrubBatchID($batchID) . "</b>";
// echo "&ensp;<b>" .$boolBID;


// echo "</br>";
// echo $deliveyDate;
// echo "&ensp;<b>" .$boolDd = scrubDeliveryDate($deliveyDate). "</b>";

// for($i = 0; $i < count($itemNo); $i++)
// {
//     echo "</br>";
//     echo $itemNo[$i];

//     $result = scrubNumericData($itemNo[$i]);

//     if($result == 1){
//         $verify = 1;
//     }else if($result == 0){

//     }else $itemNo[$i] =$result;

//     echo "<br>";
//     echo $itemName[$i];

//     $result =  scrubStringData($itemName[$i]);

//     if($result == 1){
//         $verify = 1;
//     }else if($result == 0){

//     }else $itemName[$i] =$result;

//     echo "<br>";
//     echo $quantity[$i];

//     $result = scrubNumericData($quantity[$i]);

//     if($result == 1){
//         $verify = 1;
//     }else if($result == 0){

//     }else $quantity[$i] =$result;

//     echo "<br>";
//     echo $price[$i];

//     $result =  scrubNumericData($price[$i]);

//     if($result == 1){
//         $verify = 1;
//     }else if($result == 0){

//     }else $price[$i] =$result;

// }


// echo "<br>";
// echo $totalPrice;
// echo "&ensp;<b>" . $boolTp = scrubNumericData($totalPrice). "</b>";
// echo "<br>";



function showEditTable($batchID, $deliveyDate, $itemNo, $itemName, $quantity, $price, $totalPrice)
{
    ?>
     <div class="table-responsive">
    <table id="editable_table" class="table table-bordered table-striped">
  
    
    
     <tr>
     <th>Item Id</th>
 <th>Item Name</th>
      <th>Quantity</th>
      <th>Price</th>

</tr>
     
     <tbody>
         <?php
    echo "Batch Id: ".$batchID  . "&ensp;";
    echo "<br>";

    echo "Delivery Date: ".$deliveyDate . "&ensp;";
    echo "<br>";

    echo "<br>";
    echo "Total Price: RM" .$totalPrice;
    echo "<br>";

    for($i = 0; $i < count($itemNo); $i++){
        ?>
        <tr>
            <td><?php
            echo $itemNo[$i];

            ?></td>

            <td><?php
             echo$itemName[$i];

             
            
             ?></td>
             
            <td><?php
            echo $quantity[$i];
            
           
            ?></td>
            <td><?php
            echo$price[$i];
               
           
      }

     ?></td>
</tr>

<!-- all i added -->
<tbody>
    </table>
    <br>
    <div class="col-md-9">
 <button onclick="clickMe()">Upload DB</button>
       </div>
     <?php
}

function dBupload()
{
    echo " uploaddd" ; 
}

?>

<script>
$(document).ready(function(){  
     $('#editable_table').Tabledit({
      url:'GR_action.php',
      columns:{
       identifier:[0, "GR_id"],
       editable:[[1, 'DN_code'], [2, 'OR_code'],[3,'GR_rates'],
    [4,'GR_airline'], [5,'GR_Wbreak'],[6,'GR_type'],[7,'FSC_rate'],[8,'SSC_rate'],[9,'GR_promotion']]
      },
      restoreButton:false,
      onSuccess:function(data, textStatus, jqXHR)
      {
       if(data.action == 'delete')
       {
        $('#'+data.itemNo).remove();
       }
      }
     });
});  

function clickMe(){
var result ="<?php php_func(); ?>"
document.write(result);
}

 </script>