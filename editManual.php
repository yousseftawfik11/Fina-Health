<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--StyleSheet-->
    <link rel="stylesheet" href="css/styles.css">

    <!--Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!--Font Awesome 4 CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Update Batch</title>
</head>

<?php
session_start();
include 'scrubData.php';

$fileData = $_SESSION['arrayManualEditData'];

for($i=0;$i<count($fileData);$i++){

    showEditTable($fileData[$i][0], $fileData[$i][1], $fileData[$i][2], $fileData[$i][3], $fileData[$i][4], $fileData[$i][5], $fileData[$i][6]);

}

function showEditTable($batchID, $deliveyDate, $itemNo, $itemName, $quantity, $price, $totalPrice)
{

    ?>
    <body>
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="logout.php"><i class="fa fa-sign-out"> Logout</i></a>
            </div>
        </div>
    </div>
    <div class="navWrapper" style="background-color: #EFFFFD;">
        <div class="container" style="margin-left: 20px;">
            <div class="row">
                <div class="col">
                    <br><br>
                    <form name="editManual" method="post" action="">
                        <div class="card">
                            <div class="card-header">
                                Edit Batch Table
                            </div>
                            <div class="card-body">
                                <table id="editableTable" class="table">                                
                                    <tbody class="text-center">
                                        <tr>
                                            <th scope="row">Batch ID: </th>
                                            <td><input type="text" name="batch_id" value="<?php echo $batchID; ?>" >

                                            
                                            <?php

                                            $result = scrubBatchID($batchID);
                                            if($result == 1){
                                                $verify = 1;
                                                echo "&ensp;<i class='fa fa-times' style='color: red;'></i></td>";
                                            };

                                            ?>

                                        </tr>
                                        <tr>
                                            <th scope="row">Delivery Date: </th>
                                            <td><input type="text" name="delivery_date" value="<?php echo $deliveyDate; ?>">

                                            <?php

                                            $result = scrubDeliveryDate($deliveyDate);
                                            if($result == 1){
                                                $verify = 1;
                                                echo "&ensp;<i class='fa fa-times' style='color: red;'></i></td>";
                                            };

                                            ?>

                                        </tr>
                                        <tr>
                                            <th scope="row">Total Price: </th>
                                            <td><input type="text" name="price" value="<?php echo $totalPrice; ?>">

                                            <?php

                                            $result = scrubNumericData($totalPrice);
                                            if($result == 1){
                                                $verify = 1;
                                                echo "&ensp;<i class='fa fa-times' style='color: red;'></i></td>";
                                            };

                                            ?>

                                        </tr>
                                        <?php


   for($i =0; $i < count($itemNo); $i++)
   {
       ?>
        <tr>
                                        <th > </th>
                                            <td></td>
                                        </tr>
        <tr>
                                            <th scope="row">Item <?php echo $i+1; ?> ID: </th>
                                            <td><input type="text" name="itemID" value="<?php echo $itemNo[$i]; ?>" >

                                            <?php

                                               $result = scrubNumericData($itemNo[$i]);
                                               if($result == 1){
                                                $verify = 1;
                                                echo "&ensp;<i class='fa fa-times' style='color: red;'></i></td>";
                                            };
                                            ?>



                                        </tr>
                                        <tr>
                                            <th scope="row">Item <?php echo $i+1; ?> Name: </th>
                                            <td><input type="text" name="item_name" value="<?php echo $itemName[$i]; ?>">
                                        

                                        <?php
                                            $result = scrubStringData($itemName[$i]);
                                            if($result == 1){
                                             $verify = 1;
                                             echo "&ensp;<i class='fa fa-times' style='color: red;'></i></td>";
                                            };
                                            
                                            
                                            ?>
                                            </tr>
                                        <tr>
                                            <th scope="row">Item <?php echo $i+1; ?> Price: </th>
                                            <td><input type="text" name="price" value="<?php echo $price[$i]; ?>">

                                            <?php
                                            $result = scrubNumericData($price[$i]);
                                            if($result == 1){
                                             $verify = 1;
                                             echo "&ensp;<i class='fa fa-times' style='color: red;'></i></td>";
                                            };
                                            
                                            
                                            ?>



                                        </tr>
                                        <tr>
                                            <th scope="row">Item <?php echo $i+1; ?> Quantity: </th>
                                            <td><input type="text" name="quantity" value="<?php echo $quantity[$i]; ?>">

                                            <?php
                                            $result = scrubNumericData($quantity[$i]);
                                            if($result == 1){
                                             $verify = 1;
                                             echo "&ensp;<i class='fa fa-times' style='color: red;'></i></td>";
                                            };
                                            
                                            
                                            ?>



                                        </tr>
                                        <tr>
                                        <th > </th>
                                            <td></td>
                                        </tr>

     <?php
   }

   $_SESSION['batchID'] = $batchID;
   $_SESSION['delivery_date'] = $deliveyDate;
   $_SESSION['totalPrice'] = $totalPrice;

   $_SESSION['itemNo'] = $itemNo;
   $_SESSION['itemName'] = $itemName;
   $_SESSION['quantity'] = $quantity;
   $_SESSION['price'] = $price;


  ?>
                                        <tr>
                                            <th scope="row"></th>
                                            <td><input type="submit" name="editBatch" value="Submit" class="button"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>


<?php

}

?>



</html>