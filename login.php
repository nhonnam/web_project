<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>YumYum Login Form</title>
		<link rel="stylesheet" href="login.css">
		<script type="text/javascript" src="login.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=0.65">
		<script src="https://kit.fontawesome.com/68c0d6e5f7.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<a href="index.php"><i class="fas fa-home"></i></a>
		<div class="center">
			<h1>Login to YumYum</h1>
			<form method="post">
				<div class="txt_field">
					<input type="text" name="email" placeholder="Email" required>
				</div>
				<div class="txt_field">
					<input type="password" name="password" placeholder="Password" required>
				</div>
				<input type="submit" value="Log In" name="login" onclick="LogIn()">
				<div class="signup_link">
					Don't have an account yet? <a href="signup.php">Sign Up</a>
				</div>
			</form>
		</div>
	</body>
</html>
<?php
	$conn = mysqli_connect("localhost", "root","", "yumyumrestaurant"); 
	if($conn){
    	mysqli_query($conn,"SET NAMES 'utf8'");
	}
	else{
    	echo "Connection failed!".mysqli_connect_error();
	}
	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		$query1 = "SELECT * FROM customer WHERE email = '$email' AND password = '$password'";
		$findEmail = mysqli_query($conn, $query1);
		if (mysqli_num_rows($findEmail) < 1){
			echo '<script language="javascript">alert("Incorrect email or password!"); window.location="login.php";</script>';
			die();
		}
		else
			$row = mysqli_fetch_assoc($findEmail);
        	$_SESSION['email'] = $row['email'];
			echo '<script language="javascript">alert("Login successfully!"); window.location="welcome.php";</script>';
		}
?>