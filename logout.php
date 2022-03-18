<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Alert Message-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <title>Logout</title>
</head>

<body>

</body>

</html>
<?php
session_destroy();
echo '
    <script>
        Swal.fire(
            "Successfully Logged out",
            "Return to Homepage",
            "success"
        ).then(function() {
            window.location = "index.php";
        });
    </script>';
?>