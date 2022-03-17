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

if (isset($_POST["editHeader"])) {
    $batchID = $_SESSION['batchID'];
    $deliveyDate = $_SESSION['delivery_date'];
    $totalPrice = $_SESSION['totalPrice'];
  
    echo $batchID ;
  
}
else if(isset($_POST["editItem"])) {
    $itemNo = $_SESSION['itemNo'];
    $itemName = $_SESSION['itemName'];
    $quantity = $_SESSION['quantity'];
    $price = $_SESSION['price'];

    ?>
    <body>
    <div class="navWrapper" style="background-color: #EFFFFD;">
        <div class="container" style="margin-left: 20px;">
            <div class="row">
                <div class="col">
                    <br><br>
                    <form name="itemForm" method="post" action="">
                        <div class="card">
                            <div class="card-header">
                                Edit Item
                            </div>
                            <div class="card-body">
                                <table id="editableTable" class="table">                                
                                    <tbody class="text-center">
                                        <tr>
                                            <th scope="row">Item ID: </th>
                                            <td><input type="text" name="itemID" value="<?php echo $itemNo; ?>" ></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Item Name: </th>
                                            <td><input type="text" name="item_name" value="<?php echo $itemName; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Price: </th>
                                            <td><input type="text" name="price" value="<?php echo $quantity; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Quantity: </th>
                                            <td><input type="text" name="quantity" value="<?php echo $price; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td><input type="submit" name="saveItem" value="Submit" class="button"></td>
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
else {    
    echo "N0, mail is not set";
}

?>



</html>