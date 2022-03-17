<?php
include("db.php");

$result = mysqli_query($conn, "SELECT * FROM inventoryitem WHERE itemID='" . $_GET['itemID'] . "'");
$row = mysqli_fetch_array($result);
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
    
    <title>Item Update</title>
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
                                            <td><input type="text" name="itemID" value="<?php echo $row['itemID']; ?>" readonly></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Item Name:<p class="text-muted">(Letters only)</p></th>
                                            <td><input type="text" name="item_name" value="<?php echo $row['item_name']; ?>" pattern="[a-zA-Z]{1,}" required></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Price: </th>
                                            <td><input type="number" name="price" value="<?php echo $row['price']; ?>" min="0" required></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Quantity: </th>
                                            <td><input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="0" required></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Status: </th>
                                            
                                            <td>
                                                <select id="s_status" name="s_status">
                                                    <option value="1" <?php if($row['s_status'] == 1) echo 'selected="selected"'; ?> >Available</option>
                                                    <option value="0" <?php if($row['s_status'] == 0) echo 'selected="selected"'; ?> >Unavailable</option>
                                                    <option value="2" <?php if($row['s_status'] == 2) echo 'selected="selected"'; ?> >On route</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">User ID: </th>
                                            <td><input type="text" name="userID" value="<?php echo $row['userID']; ?>" readonly></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td><input type="submit" name="submit" value="Submit" class="button"></td>
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
    
</body>
</html>

<?php
if (count($_POST) > 0) {
    $update = mysqli_query($conn, "UPDATE inventoryitem  SET item_name='" . $_POST['item_name'] . "',
    price='" . $_POST['price'] . "', quantity='" . $_POST['quantity'] . "', s_status='" . $_POST['s_status'] .
        "' WHERE itemID='" . $_GET['itemID'] . "'");
    if ($update) {
        echo '
        <script>
            Swal.fire(
                "Item Updated Successfully",
                "Return back to Items Page",
                "success"
            ).then(function() {
                 window.location = "iCItemUpdate.php";
            });
        </script>
        ';
    } else {
        echo 'Failed to edit record because ' . mysqli_error($conn);
    }
}
?>