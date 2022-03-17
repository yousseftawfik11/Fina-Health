<?php
session_start();
include 'db.php';



if(isset($_POST['submit'])){

    
$userMail = strtolower(mysqli_real_escape_string($conn, $_POST['userMail']));
$password = strtolower(mysqli_real_escape_string($conn, $_POST['Loginpass']));


$LoginQuery = "SELECT * FROM user WHERE email = '$userMail'";
$Check = mysqli_query($conn, $LoginQuery);
$row = mysqli_fetch_array($Check);

if(mysqli_num_rows($Check) > 0  && password_verify($password,$row['password_hash'])){

	$_SESSION["username"] = $row['email'];

    if($row['userRole']==1){
        echo '
        <script>
        window.location.href="businessHome.php";
        </script>
      ';
    }elseif($row['userRole']==2){
        echo '
        <script>
        window.location.href="uploadForm.php";
        </script>
      ';
    }elseif($row['userRole']==3){
        echo '
        <script>
        window.location.href="iCHome.php";
        </script>
      ';
    }
    }else{
        echo "error";
    }


}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">

</head>
<body>
    
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

                        <div class="group">
							<div class="tasksInput">
							<label for="userMail" class="label">Email</label>
							<input id="userMail" name="userMail" type="text" class="input">
							</div>
						</div>

						<div class="group">
							<label for="Loginpass" class="label">Password</label>
							<input id="Loginpass" name="Loginpass" type="password" class="input" data-type="password">
						</div>

                        <div class="group">
							<input type="submit" name="submit" class="button" value="Sign In">
						</div>
</form>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<div class="group">
							<label for="email" class="label">Email Address</label>
							<input id="email" name="email" type="email" class="input" required>
						</div>
						<div class="group">
							<label for="pass" class="label">Password</label>
							<input id="pass" name="pass" type="password" class="input" data-type="password" required>
						</div>
						<div class="group">
							<label for="Rpass" class="label">Repeat Password</label>
							<input id="Rpass" name="Rpass" type="password" class="input" data-type="password" required>
						</div>
						<div class="group">
							
							<label for="role" class="label">Role</label>
							<div style=" margin-left: 62px;">
							<input id="role1" name="role" type="radio" value="1">Business Partner<br>
							<input id="role2" name="role" type="radio" value="2">Data Analyst<br>
							<input id="role3" name="role" type="radio" value="3">Inventory Manager<br>
							</div>
						</div>
						<div class="group">
							<input type="submit" name="submit2" class="button" value="Sign Up">
						</div>

</form>
</body>
</html>