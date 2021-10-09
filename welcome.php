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
	<meta name="viewport" content="width=device-width, initial-scale=0.6">
	<title>Yumyum Restaurant - Home</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  	<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css2?family=Allison&display=swap" rel="stylesheet">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="index.css">
</head>
<body>
	<header>
		<div class="nav-bar">
			<?php
			if(isset($_SESSION['email'])){
				$sql="SELECT first_name FROM customer WHERE email = '{$_SESSION['email']}'";
				$findName = mysqli_query($conn, $sql);
				$row = $findName->fetch_assoc();
			?>
			<p>Welcome <?php echo $row['first_name'];?>!</p>
			<?php
			}
			?>
			<div><a class="nav" href="cart.php">Cart</a></div>
			<?php
			if(!isset($_SESSION['email']))
    		{
      		?> 
			<div><a class="nav" id="login" href="login.php">Log In</a></div>
			<div><a class="nav" id="signup" href="signup.php">Sign Up</a></div>      
			<?php
    		}
    		else
    		{				
      		?>
			<div><a class="nav" id="profile" href="profile.php">Profile</a></div>
			<div><a class="nav" id="signout" href="index.php">Sign Out</a></div>
			<?php
    		}
    		?>
		</div>
	</header>
	<main>
		<div class="logo_search-bar_menu">
			<div><img class="logo" src="image/logo.png" alt="logo"><span>Restaurant<span></div>
			<p>What would you like to eat today?</p>
			<div class="menu" style="float:right;">
  				<button class="menu-btn"><b>Menu</b></button>
  				<div class="dropdown-content">
    				<a href="#north">Northern Cuisine</a>
    				<a href="#cent">Central Cuisine</a>
    				<a href="#south">Southern Cuisine</a>
  				</div>
			</div>
		</div>
		<div class="container"> 
  			<div id="Carousel" class="carousel slide" data-ride="carousel">
    			<ol class="carousel-indicators">
      				<li data-slide-to="0" class="active"></li>
      				<li data-slide-to="1"></li>
      				<li data-slide-to="2"></li>
    			</ol>
    			<div class="carousel-inner">
      				<div class="item active">
        				<img class="slide" src="image/pic1.png" alt="Cover Page" style="width:100%;">
      				</div>
      				<div class="item">
        				<img class="slide" src="image/pic2.png" alt="Chicago" style="width:100%;">
      				</div>    
      				<div class="item">
        				<img class="slide" src="image/pic3.png" alt="New york" style="width:100%;">
      				</div>
    			</div>
    			<a class="left carousel-control" id="left-control" href="#Carousel" data-slide="prev">
      				<span class="glyphicon glyphicon-chevron-left"></span>
   		 		</a>
    			<a class="right carousel-control" id="right-control" href="#Carousel" data-slide="next">
      				<span class="glyphicon glyphicon-chevron-right"></span>
    			</a>
  			</div>
		</div>
		<h1 id="north">NORTHERN CUISINE</h1>
		<div class="container" id="food">
			<?php
			$query = "SELECT * FROM product WHERE category_id = 1";
			$result = $conn->query($query);
			foreach($result as $item):
			?>
			<form method="post" action="cart.php?product_id=<?php echo $item['product_id']?>">
				<div>
					<img name="image" src="food/<?=$item['image']?>" alt="food photo">
					<p name="eng_name" class="product-name"><?=$item['eng_name']?></p>
					<p name="vie_name" class="product-name"><?=$item['vie_name']?></p>
					<p name="price" class="price"><b><?=$item['price']?></b> VND</p>
					<input type="hidden" name="image" value="<?=$item['image']?>">
					<input type="hidden" name="eng_name" value="<?=$item['eng_name']?>">
					<input type="hidden" name="vie_name" value="<?=$item['vie_name']?>">
					<input type="hidden" name="price" value="<?=$item['price']?>">
					<input type="submit" value="Add to Cart" name="add" class="add-to-cart">
				</div>
			</form>
			<?php
				endforeach;
			?>
		</div>
		<h1 class="nomargin" id="cent">CENTRAL CUISINE</h1>
		<div class="container" id="food">
			<?php
			$query = "SELECT * FROM product WHERE category_id = 2";
			$result = $conn->query($query);
			foreach($result as $item):
			?>
			<form method="post" action="cart.php?product_id=<?php echo $item['product_id']?>">
				<div>
					<img name="image" src="food/<?=$item['image']?>" alt="food photo">
					<p name="eng_name" class="product-name"><?=$item['eng_name']?></p>
					<p name="vie_name" class="product-name"><?=$item['vie_name']?></p>
					<p name="price" class="price"><b><?=$item['price']?></b> VND</p>
					<input type="hidden" name="image" value="<?=$item['image']?>">
					<input type="hidden" name="eng_name" value="<?=$item['eng_name']?>">
					<input type="hidden" name="vie_name" value="<?=$item['vie_name']?>">
					<input type="hidden" name="price" value="<?=$item['price']?>">
					<input type="submit" value="Add to Cart" name="add" class="add-to-cart">
				</div>
			</form>
			<?php
				endforeach;
			?>
		</div>
		<h1 class="nomargin" id="south">SOUTHERN CUISINE</h1>
		<div class="container" id="food">
			<?php
			$query = "SELECT * FROM product WHERE category_id = 3";
			$result = $conn->query($query);
			foreach($result as $item):
			?>
			<form method="post" action="cart.php?product_id=<?php echo $item['product_id']?>">
				<div>
					<img name="image" src="food/<?=$item['image']?>" alt="food photo">
					<p name="eng_name" class="product-name"><?=$item['eng_name']?></p>
					<p name="vie_name" class="product-name"><?=$item['vie_name']?></p>
					<p name="price" class="price"><b><?=$item['price']?></b> VND</p>
					<input type="hidden" name="image" value="<?=$item['image']?>">
					<input type="hidden" name="eng_name" value="<?=$item['eng_name']?>">
					<input type="hidden" name="vie_name" value="<?=$item['vie_name']?>">
					<input type="hidden" name="price" value="<?=$item['price']?>">
					<input type="submit" value="Add to Cart" name="add" class="add-to-cart">
				</div>
			</form>
			<?php
				endforeach;
			?>
		</div>
	</main>
	<footer>
		<p>Contact me on:</p>
		<ul>
			<li><img src="image/phone.png"></span> 0395453691</li>
			<li><img src="image/facebook.png"><a id="link-fb" href="https://www.facebook.com/taotengivaybay" target="_blank"> Cậu Bé Vuôi Vẻ</a></li>
			<li><span><img src="image/gmail.png"> nobeltia@gmail.com</span></li>
		</ul>
		<p>Copyright &copy 2021 YumYum Restaurant. All rights reserved.<p>
	</footer>
</body>