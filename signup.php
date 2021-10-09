<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>YumYum Signup Form</title>
		<link rel="stylesheet" href="signup.css">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
		<script src="https://kit.fontawesome.com/68c0d6e5f7.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<a href="index.php"><i class="fas fa-home"></i></a>
		<div class="center">
			<h1>Welcome, Let's Sign Up to YumYum!</h1>
			<form method="post" action="signup.php">
				<div class="txt_field">
					<input type="text" name="first_name" placeholder="First Name" required>
				</div>
				<div class="txt_field">
					<input type="text" name="last_name" placeholder="Last Name" required>
				</div>
				<div class="txt_field">
					<input type="text" name="email" placeholder="Email" required>
				</div>
				<div class="txt_field">
					<input type="tel" name="phone" placeholder="Phone Number" required>
				</div>
				<div class="txt_field">
					<input type="text" name="address" placeholder="Address" required>
				</div>
				<div class="txt_field">
					<input type="password" name="password" placeholder="Password" required>
				</div>
				<div class="txt_field">
					<input type="password" name="repassword" placeholder="Confirm Password" required>
				</div>
				<input type="submit" name="register" value="Sign Up" onclick="SignUp()">
				<div class="login_link">
					Already have an account? <a href="login.php">Log In</a>
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
if(isset($_POST['register'])){
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$sql = "SELECT * FROM customer WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
echo '<script language="javascript">alert("Your email already exits. Please enter another email"); window.location="signup.php";</script>';
// Dừng chương trình
die();
}
else {
    if($password == $repassword){
$sql = "INSERT INTO customer (first_name, last_name, email, phone, address, password) VALUES ('$first_name', '$last_name', '$email', '$phone', '$address','$password')";
echo '<script language="javascript">alert("You have signed up to YumYum Successfully!");window.location="login.php";</script>';
$result = mysqli_query($conn, $sql);
}
else
{
    echo "<script>alert('Password and Re-password are not the same')</script>";
    die();
}
}
}
?>