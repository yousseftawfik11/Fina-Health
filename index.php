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

	$_SESSION["user_id"] = $row['userID'];

    if($row['userRole']==1){
        echo '
        <script>
        window.location.href="bPartner.php";
        </script>
      ';
    }elseif($row['userRole']==2){
        echo '
        <script>
        window.location.href="fetchEmail.php";
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


//register
if(isset($_POST["submit2"])){

	$name = strtolower(mysqli_real_escape_string($conn, $_POST['name']));
	$email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
	$pass=strtolower( mysqli_real_escape_string($conn,$_POST['pass']));
	$passHash= password_hash($pass, PASSWORD_DEFAULT);
	$role= mysqli_real_escape_string($conn,$_POST["role"]);
	$role=1;

	$EmailQuery="SELECT email from user WHERE email='$email'";
	if($result= mysqli_query($conn,$EmailQuery)){
	  if(mysqli_num_rows($result)>0){
		echo"<script>
		Swal.fire({
			icon: 'error',
			title: 'Try Again',
			text: 'This Email already exists...',
			confirmButtonColor:'#f27474',
			confirmButtonText: 'OK'})
		</script>";
	  }elseif($pass != $_POST['Rpass']){
		echo"<script>
		Swal.fire({
			icon: 'error',
			title: 'Try Again',
			text: 'Password and confrim password does not match...',
			confirmButtonColor:'#f27474',
			confirmButtonText: 'OK'})
		</script>";
	  }
	  else{
		$query="INSERT INTO user(u_name,email,password_hash,userRole) 
        VALUES('$name','$email','$passHash','$role')";
        mysqli_query($conn,$query);

	  }

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

	    <!-- alert box libraries -->
		<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css"> -->

</head>
<body style="background-color: #EFFFFD;">

<div class="LoginContainer">
    
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

                        <div class="group">
							<div class="tasksInput">
							<label for="userMail" class="label">Email</label></br>
							<input id="userMail" name="userMail" type="text" class="input">
							</div>
						</div>

						<div class="group">
							<label for="Loginpass" class="label">Password</label></br>
							<input id="Loginpass" name="Loginpass" type="password" class="input" data-type="password">
						</div>

                        <div class="group">
							<input type="submit" name="submit" class="submit_btn" value="Sign In">
						</div>
</form>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="group">
							<label for="name" class="label">Name</label></br>
							<input id="name" name="name" type="text" class="input" required>
						</div>
<div class="group">
							<label for="email" class="label">Email Address</label></br>
							<input id="email" name="email" type="email" class="input" required>
						</div>
						<div class="group">
							<label for="pass" class="label">Password</label></br>
							<input id="pass" name="pass" type="password" class="input" data-type="password" required>
						</div>
						<div class="group">
							<label for="Rpass" class="label">Repeat Password</label></br>
							<input id="Rpass" name="Rpass" type="password" class="input" data-type="password" required>
						</div>
						<div class="group">
							
							<!-- <label for="role" class="label">Role</label></br>
							<div style=" margin-left: 62px;">
							<input id="role1" name="role" type="radio" value="1">Business Partner<br>
							<input id="role2" name="role" type="radio" value="2">Data Analyst<br>
							<input id="role3" name="role" type="radio" value="3">Inventory Manager<br>
							</div> -->
						</div>
						<div class="group">
							<input type="submit" name="submit2" class="submit_btn" value="Sign Up">
						</div>

</form>

</div>





</body>
</html>