<?php
include("db.php");
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

    <title>Updates</title>
</head>
<body>
    <div class="navWrapper">
        <div class="sideNav"><!--Side Navbar-->
            <ul>
                <a class="navbar-brand" href="iCHome.php">FINA Health Care</a>
                <br><br><br>
                <li><a href="iCHome.php"><i class="fa fa-pie-chart"> Dashboard</i></a></li>
                <li class="active"><a href="iCItemUpdate.php"><i class="fa fa-book"> Items</i></a></li>
                <li><a href="#"><i class="fa fa-envelope"> Stock Report</i></a></li>
            </ul>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2><u>Items Update</u></h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Stock <br><br>
                            <form action="pdf_gen.php" method="POST">
                                <button type="submit" name="btn_pdf" class="btn btn-success">Generate PDF Report</button>
                            </form>
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
                                    <?php while( $exists = mysqli_fetch_assoc($itemID) ) { ?>
                                    <tr class="text-center">
                                    <td><?php echo $exists ['itemID']; ?></td>
                                    <td><?php echo $exists ['item_name']; ?></td>
                                    <td><?php echo $exists ['price']; ?></td>
                                    <td><?php echo $exists ['quantity']; ?></td>

                                    <?php
                                    if ($exists ['s_status'] == 1){?>
                                        <td><i class="fa fa-check" style="color: greenyellow;"></i></td>
                                    <?php
                                    }
                                    else if ($exists ['s_status'] == 2){
                                        ?>
                                        <td><i class="fa fa-truck" style="color: orange;"></i></td>
                                        <?php
                                    }
                                    else {?>
                                        <td><i class="fa fa-times" style="color: red;"></i></td>
                                    <?php
                                    }
                                    ?>
                                    <td><?php echo $exists ['userID']; ?></td>
                                    <td><a href="iCUpdate.php?itemID=<?php echo $exists["itemID"];?>">Update</a></td>
                                    </tr>                            
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>