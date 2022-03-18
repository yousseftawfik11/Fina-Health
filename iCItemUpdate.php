<?php
include("db.php");

//To add a new item to database

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Stylesheet-->
    <link rel="stylesheet" href="css/iCStyles.css">

    <!--Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!--Font Awesome 4 CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Alert Message-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <title>Updates</title>
</head>

<body>
    <div class="navWrapper">
        <div class="sideNav">
            <!--Side Navbar-->
            <ul>
                <a class="navbar-brand" href="iCHome.php">FINA Health Care</a>
                <br><br><br>
                <li><a href="iCHome.php"><i class="fa fa-pie-chart"> Dashboard</i></a></li>
                <li class="active"><a href="iCItemUpdate.php"><i class="fa fa-book"> Items</i></a></li>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <li><a href="logout.php"><i class="fa fa-sign-out"> Logout</i></a></li>
            </ul>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <br>
                    <h2><u>Items Update</u></h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Stock
                        </div>
                        <div class="card-body">
                            <?php
                            $itemID = mysqli_query($conn, "SELECT itemID, item_name, price, quantity, s_status, userID FROM inventoryitem");
                            ?>
                            <table id="editableTable" class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>User ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($exists = mysqli_fetch_assoc($itemID)) { ?>
                                        <tr class="text-center">
                                            <td><?php echo $exists['itemID']; ?></td>
                                            <td><?php echo $exists['item_name']; ?></td>
                                            <td><?php echo $exists['price']; ?></td>
                                            <td><?php echo $exists['quantity']; ?></td>

                                            <?php
                                            if ($exists['s_status'] == 1) { ?>
                                                <td><img src="images/check.svg"></td>
                                            <?php
                                            } else if ($exists['s_status'] == 2) {
                                            ?>
                                                <td><i class="fa fa-truck" style="color: orange;"></i></td>
                                            <?php
                                            } else { ?>
                                                <td><img src="images/false.svg"></td>
                                            <?php
                                            }
                                            ?>
                                            <td><?php echo $exists['userID']; ?></td>
                                            <td>
                                                <a href="iCUpdate.php?itemID=<?php echo $exists["itemID"]; ?>">
                                                    <i class="fa fa-pencil" style="color: green;"></i>
                                                </a> <br>
                                                <a href="iCDelete.php?itemID=<?php echo $exists["itemID"]; ?>">
                                                    <i class="fa fa-trash" style="color: red;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" style="text-align: right;">
                            <form action="pdf_gen.php" method="POST">
                                <button type="submit" name="btn_pdf" class="btn btn-success">Generate PDF Report</button>
                            </form>
                            &emsp;
                            <form action="pdf_genUnavailable.php" method="POST">
                                <button type="submit" name="btn_pdf2" class="btn btn-success">Generate unavailable Items PDF Report</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Add Item
                        </div>

                        <div class="card-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                            <table id="editableTable" class="table">
                                
                                    <tbody class="text-center">
                                        <tr>
                                            <th scope="row">Item Name: </th>
                                            <td><input type="text" name="item_name" pattern="[a-zA-Z]{1,}" required></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Price: </th>
                                            <td><input type="number" name="price" min="0" required></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Quantity: </th>
                                            <td><input type="number" name="quantity" min="0" required></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Status: </th>

                                            <td>
                                                <select id="s_status" name="s_status">
                                                    <option value="1">Available</option>
                                                    <option value="0">Unavailable</option>
                                                    <option value="2">On route</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="submit" name="addToDB" class="submit_btn">Add to Database</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                
                            </table>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            <br><br>
        </div>
    </div>
    <?php
        if(isset($_POST['addToDB'])){
            $item_name=strtolower( mysqli_real_escape_string($conn,$_POST['item_name']));
            $price=strtolower( mysqli_real_escape_string($conn,$_POST['price']));
            $quantity=strtolower( mysqli_real_escape_string($conn,$_POST['quantity']));
            $s_status=strtolower( mysqli_real_escape_string($conn,$_POST['s_status']));

            $sqlQuery = "INSERT INTO inventoryitem(item_name, price, quantity, s_status, userID ) 
                VALUES('$item_name','$price','$quantity', '$s_status', 100)";
            if (mysqli_query($conn, $sqlQuery)){
                echo '
                    <script>
                        Swal.fire(
                            "Item Added Successfully",
                            "Return back to Items Page",
                            "success"
                        ).then(function() {
                            window.location = "iCItemUpdate.php";
                        });
                    </script>';
            }
            else {
                echo mysqli_error($conn);
            }
        }
    ?>
</body>

</html>