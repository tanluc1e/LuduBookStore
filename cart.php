<?php 
session_start();
include("connect.php");
require_once "./functions/database_functions.php";
require_once "./functions/cart_functions.php";
error_reporting(0);
if(session_id() == '') session_start();
if (isset($_SESSION['user_email']) == true) {
    //GET CURRENT VALUES FROM DATABASE (User_name)
    $user_email = $_SESSION['user_email'];
    $sql = "SELECT * FROM Users WHERE user_email='$user_email'";
    $query = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($query)) { 
	$current_username = $row['user_name'];
    }
} 
// bookid got from form post method, change this place later.
if(isset($_POST['bookisbn']))
{
    $bookid = $_POST['bookisbn'];
}
if(isset($bookid))
{
    // new iem selected
    if(!isset($_SESSION['cart']))
    {
        // $_SESSION['cart'] is associative array that bookisbn => qty
        $_SESSION['cart'] = array();
           $_SESSION['total_items'] = 0;
        $_SESSION['total_price'] = '0.00';
    }
    if(!isset($_SESSION['cart'][$bookid]))
    {
           $_SESSION['cart'][$bookid] = 1;
    } 

    elseif(isset($_POST['cart']))
    {
        $_SESSION['cart'][$bookid]++;
        unset($_POST);
    }
}
// if save change button is clicked , change the qty of each bookisbn
if(isset($_POST['save_change']))
{
    foreach($_SESSION['cart'] as $isbn =>$qty)
    {
        if($_POST[$isbn] == '0')
        {
            unset($_SESSION['cart']["$isbn"]);
        } 
        else 
        {
            $_SESSION['cart']["$isbn"] = $_POST["$isbn"];
        }
    }
}
$getTotalPrice = total_price($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Shopping cart-js</title>
  <link rel="stylesheet" href="./css/cart.css">
  <link rel="stylesheet" type="text/css" href="style2.css">

</head>
<body>

<div id="header-wrap" data-aos="fade">
	<div class="top-content">
		<div class="container">
			<div class="inner-content">
				<div class="grid">					
					<div class="social-links">
						<ul>
							<li>
								<a href="#"><i class="icon icon-facebook"></i></a>
							</li>
							<li>
								<a href="#"><i class="icon icon-twitter"></i></a>
							</li>
							<li>
								<a href="#"><i class="icon icon-youtube-play"></i></a>
							</li>
							<li>
								<a href="#"><i class="icon icon-behance-square"></i></a>
							</li>
						</ul>
					</div><!--social-links-->

					<div class="right-element">
						<div class="grid">
                        <div class="user-account for-buy">
								<?php 
									if (!empty($_SESSION['user_email'])){
										echo
										"<a href='#'>
										<i class='icon icon-user'></i>
										<span>$current_username</span>
										</a>";
									} else {
										echo
										"<a href='logandreg.php'>
										<i class='icon icon-user'></i>
										<span>Account</span>
										</a>";
									}
								?>
							</div>

							<div class="cart for-buy">
								<a href="cart.php">
								<i class="icon icon-clipboard"></i>
								<span>Cart:(<?php echo $getTotalPrice; ?>.000vnđ)</span>
								</a>
							</div>

							<div class="search-bar">
								<a href="#" class="search-button search-toggle" data-selector="#header-wrap">
									<i class="icon icon-search"></i>
									<span>Search</span>
								</a>
								<form role="search" method="get" class="search-box">
									<input class="search-field text search-input" placeholder="Search" type="search">
								</form>
							</div>
						</div><!--grid-->
					</div><!--top-right-->
				</div><!--grid-->
			</div>
		</div>
	</div><!--top-content-->

	<header id="header">
		<div class="container">
			<div class="inner-content">
				<div class="grid">
					<div class="main-logo">
						<a href="index.html"><img src="images/logo.png" alt="logo"></a>
					</div>

					<nav id="navbar">
						<div class="main-menu">
							<ul class="menu-list">
								<li class="menu-item active"><a href="#home" data-effect="Home">Home</a></li>
								<li class="menu-item"><a href="#about" class="nav-link" data-effect="About">About</a></li>
								<li class="menu-item"><a href="#pages" class="nav-link" data-effect="Pages">Pages</a></li>
								<li class="menu-item"><a href="index.php#popular-books" class="nav-link" data-effect="Shop">Shop</a></li>
								<li class="menu-item"><a href="#articles" class="nav-link" data-effect="Articles">Articles</a></li>
								<li class="menu-item"><a href="#contact" class="nav-link" data-effect="Contact">Contact</a></li>
							</ul>

							<div class="hamburger">
				                <span class="bar"></span>
				                <span class="bar"></span>
				                <span class="bar"></span>
				            </div>

						</div>
					</nav>

				</div>
			</div>
		</div>
	</header>
		
</div><!--header-wrap-->
<!-- partial:index.partial.html -->
<div class="content">
    <div class="cartTop">
        <div class="countBalance">
            <span style="color:#FF6347">Total Products:</span>
            <span><?php echo $getTotalPrice; ?></span>
        </div>
        <div class="addressDIV">
            <span><a href="index.php#popular-books">Back</a></span>
        </div>
    </div>
 <div style="clear:both;"></div>
		
		<div class="cartMain">
        <form action="cart.php" method="post">
			<table id="cartTable">
				<thead>
					<tr>
						<th>
							<label for="fl select-all">
					<input type="checkbox" class="check-all check"/>
					<span><a href="javascript:void(0)" class="selallSPAN">&nbsp;Select</a></span>
							</label>
						</th>
						<th>Item</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>SubTotal</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
                    <?php

	    	            // print out header here
	    	            $title = "Your shopping cart";

	    	            if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart'])))
			            {
		    	            $_SESSION['total_price'] = total_price($_SESSION['cart']);
		                    $_SESSION['total_items'] = total_items($_SESSION['cart']);
                        ?>
                        <?php
                            foreach($_SESSION['cart'] as $isbn => $qty){
                                $conn = db_connect();
                                $book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
                        ?>
                        <tr>
                            <td class="checkbox">
                                <input type="checkbox" class="check-one check"/>
                            </td>
                            <td class="goods">
                                <img src="<?=$book['image']?>" alt=""/>
                                <span><a href="##" class="goodsTitle"><?=$book['name']?></a></span><br/>
                                <span><a href="##" class="sellerTitle"><?=$book['author']?></a></span>
                            </td>
                            <td class="price"><?=$book['price']?></td>
                            <td class="count">
                                <span class="reduce"></span>
                                <input type="text" class="count-input" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>"/>
                                <span class="add">+</span>
                            </td>
                            <td class="subtotal"><?=$book['price']?></td>
                            <td class="opration">
                                <span class="deleteOne">Delete</span>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php
	                    } else 
		                {
		                    echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	                    }
	                    if(isset($conn)){ mysqli_close($conn); }
                    ?>
				</tbody>
			</table>
            <input type="submit" class="btSave" value="Save" name="save_change">
            <input type="button" class="btSave" value="Delete" id="multiDelete">
        </form>
		</div>
		<div class="cartFooter" id="cartFooter">
			<div class="selall fl">
				<label for="fl select-all">
					<input type="checkbox" class="check-all check"/>
					<span><a href="javascript:void(0)" class="selallSPAN">&nbsp;Select</a></span>
				</label>
			</div>
            <!--
			<a href="#" id="multiDelete" class="fl delete">多 选 删 除</a>
			<a href="#" id="allDelete" class="fl delete" onclick="return saveChange()">清 空 购 物 车</a>
                    -->
			<div class="fr closing">Checkout</div>
			<div class="fr total" style="color: red; font-weight: bold">Total: <span id="priceTotal">0.00</span>0vnđ</div>
			<div class="fr selected" id="selected">
                Selected product:
				<span id="selectedTotal">0</span>
				<span class="arrow up">⇧View Selected⇧</span>
				<span class="arrow down">⇩Cancel⇩</span>
			</div>
			<div class="selected-view">
		        <div id="selectedViewList" class="clearfix">
		            <!-- <div><img src="images/1.jpg"/>
		            	<span class="selCount">1</span>
		            	<span class="del">取消选择</span>
		            </div> -->
		        </div>
		        <span class="arrow">◆<span>◆</span></span>
    		</div>
		</div>
	</div>
<!-- partial -->
  <script  src="./js/cart.js"></script>

</body>
</html>
