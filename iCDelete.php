<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <title>Delete Item</title>
</head>

<body>

</body>

</html>
<?php
include("db.php");

if (isset($_GET['itemID'])) {
    $id = $_GET['itemID'];
    $delete = mysqli_query($conn, "DELETE FROM inventoryitem WHERE itemID=$id");

    if ($delete) {
        echo '
        <script>
            Swal.fire(
                "Item Deleted Successfully",
                "Return back to Items Page",
                "success"
            ).then(function() {
                window.location = "iCItemUpdate.php";
            });
        </script>';
    }
}
?>
