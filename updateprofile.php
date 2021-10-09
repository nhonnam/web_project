<?php
session_start();
$conn = mysqli_connect("localhost", "root","", "yumyumrestaurant"); 
// mysqli_set_charset($conn, "utf8");
if($conn){
    mysqli_query($conn,"SET NAMES 'utf8'");
}
else{
    echo "Ket noi that bai".mysqli_connect_error();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User's Profile</title>
  	<meta name="viewport" content="width=device-width, initial-scale=0.7">
	<link rel="stylesheet" href="profile.css">
	<script src="https://kit.fontawesome.com/68c0d6e5f7.js" crossorigin="anonymous"></script>
</head>
<body>
	<a href="welcome.php"><i class="fas fa-home"></i></a>
	<header>
		<h1>My Profile</h1>
		<p>You can edit some information!</p>
	</header>
	<main>
		<img src="image/icon.png" alt="Avatar">
    	<form action="" method="POST">
			<?php
				$currentUser=$_SESSION['email'];
				$sql = "SELECT * FROM customer WHERE email ='$currentUser'";
				$getInfo = mysqli_query($conn,$sql);
				if($getInfo){
				if(mysqli_num_rows($getInfo)>0){
					while($row = mysqli_fetch_array($getInfo)){
						//print_r($row['email']);
						?>
						    <label for="fname">First name:</label><br>
    						<input type="text" name="first_name" id="fname" class="info" value="<?php echo $row['first_name']?>" required><br>
    						<label for="lname">Last name:</label><br>
    						<input type="text" name="last_name" id="lname" class="info" value="<?php echo $row['last_name']?>" required><br>
    						<label for="phone">Phone number:</label><br>
    						<input type="tel" name="phone" id="phone" class="info" value="<?php echo $row['phone']?>" required><br>
    						<label for="addr">Address:</label><br>
    						<input type="text" name="address" id="addr" class="info" value="<?php echo $row['address']?>" required><br>
    						<label for="email">Email:</label><br>
    						<input type="text" id="email" class="info" value="<?php echo $row['email']?>" disabled><br>
    						<label for="pass">Password:</label><br>
    						<input type="password" id="pass" class="info" value="<?php echo $row['password']?>" disabled><br>
    						<input type="submit" name="update" value="Save changes">
						<?php
					}
				}
			}
			?>
    	</form>
	</main>
</body>
</html>
<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'yumyumrestaurant') 
or die ('Connection Failed'); mysqli_set_charset($conn, "utf8");

if(isset($_POST['update']))
{
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);   
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);   
    $address = mysqli_real_escape_string($conn, $_POST['address']); 
    $sql = "UPDATE customer SET first_name = '$first_name', last_name = '$last_name', phone = '$phone', address = '$address' WHERE email = '{$_SESSION['email']}'";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        echo '<script language="javascript">alert("You have updated your profile successfully!");window.location="updateprofile.php";</script>';       
    }
    else
    {
        echo "<script>alert('Update Failed')</script>";
    }
}

?>