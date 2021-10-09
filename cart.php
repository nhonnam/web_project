<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'yumyumrestaurant') 
or die ('Connection Failed'); mysqli_set_charset($conn, "utf8");

if(isset($_POST['add'])){
  if(isset($_SESSION['cart'])){
    $session_array_id = array_column($_SESSION['cart'], "product_id");
    if(!in_array($_GET['product_id'], $session_array_id)){
      $session_array = array('product_id' => $_GET['product_id'],"eng_name" => $_POST['eng_name'],"vie_name" => $_POST['vie_name'],"price" => $_POST['price'],"image" => $_POST['image']);
      $_SESSION['cart'][] = $session_array;
    }
  }
  else{
    $session_array = array('product_id' => $_GET['product_id'],"eng_name" => $_POST['eng_name'],"vie_name" => $_POST['vie_name'],"price" => $_POST['price'],"image" => $_POST['image']);
    $_SESSION['cart'][] = $session_array;
  }
}
if(isset($_GET['action'])){
	if($_GET['action']=="remove"){
		foreach($_SESSION['cart'] as $key => $value){
			if($value['product_id']==$_GET['product_id']){
				unset($_SESSION['cart'][$key]);
			}
		}
	}
}
// if(isset($_POST['confirm'])){
// 	$email=$_SESSION['email'];
// 	$sql1="INSERT INTO customer_order (customer_email) VALUES ('$email')";
// 	$result1 = mysqli_query($conn, $sql1);
// 	if(mysqli_query($conn, $sql1)){
// 		$last_id = mysqli_insert_id($conn);
// 		foreach($_SESSION['cart'] as $key=> $value){
// 			$productId=$value['product_id'];
// 			$sql3="INSERT INTO order_detail (order_id,product_id) VALUES ('$last_id','$productId')";
// 			if(mysqli_query($conn, $sql3)){
// 				unset($_SESSION['cart'][$key]);
// 			}
// 		}
// 	}
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.6">
	<title>My Cart</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/68c0d6e5f7.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="cart.css">
</head>
<body>
	<header>
		<h1><a href="welcome.php"><i class="fas fa-home"></i></a><span id="center"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</span></h1>
	</header>
	<main>
		<?php
		if(empty($_SESSION['cart'])){
			?>
			<section class="empty-cart">
			<img src="image/empty_cart.png">
			<p>Your cart is empty.</p>
			<p>Looks like you have no items in your shopping cart.</p>
			<p>Click <a href="welcome.php">here</a> to continue shopping.</p>
			</section>
		<?php
		}
		else{
		?>
		<div class="container">
			<form id="cart-form" action="cart.php?action=submit" method="post">
				<table>
					<tr class="header-name">
						<th class="header-image">Image</th>
						<th class="name">Product name</th>
						<th class="price">Price</th>
						<th class="delete">Delete</th>
					</tr>
					<?php
					$total=0;
					if(!empty($_SESSION['cart'])){
          			foreach($_SESSION['cart'] as $key => $value)
          			{  
					?>
					<tr>
						<td class="image"><img src="food/<?=$value['image']?>"></td>
						<td class="name"><?=$value['eng_name']?><br><?=$value['vie_name']?></td>
						<td class="price"><?=$value['price']?> VND</td>
						<td class="delete"><a href="cart.php?action=remove&product_id=<?=$value['product_id']?>"><i class="fas fa-times"></i></a></td>
					</tr>	
					<?php
					$total = $total + $value['price'];
					}
				}
					?>
					<tr class="footer-name">
						<th>&nbsp;</th>
						<th>Total price</th>
						<th class="price"><b><?=$total?></b> VND</th>
						<th>&nbsp;</th>
					</tr>
				</table>
				<input type="submit" name="confirm" value="Confirm payment">
			</form>
		</div>		
	</main>
	<?php
	}
	?>	
</body>