<?php
session_start();
include("connect.php");
error_reporting(0);
//Kiểm tra nếu đã đăng nhập (get user_email == true) sẽ lấy giá trị từ database
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
// Get random 10 book
$stmt = $db->prepare('SELECT * FROM books ORDER BY RAND() LIMIT 10');
$stmt->execute();
$resultSet = $stmt->get_result();
$data = $resultSet->fetch_all(MYSQLI_ASSOC);

// Get random 100 book
$stmt2 = $db->prepare('SELECT * FROM books ORDER BY RAND() LIMIT 100');
$stmt2->execute();
$resultSet2 = $stmt2->get_result();
$data2 = $resultSet2->fetch_all(MYSQLI_ASSOC);

// Internet
$internet = $db->prepare('SELECT * FROM books WHERE category="Internet" ORDER BY RAND() LIMIT 10');
$internet->execute();
$internetResult = $internet->get_result();
$dataInternet = $internetResult->fetch_all(MYSQLI_ASSOC);

// Education
$education = $db->prepare('SELECT * FROM books WHERE category="Education" ORDER BY RAND() LIMIT 10');
$education->execute();
$educationResult = $education->get_result();
$dataEducation = $educationResult->fetch_all(MYSQLI_ASSOC);

// Romance
$romance = $db->prepare('SELECT * FROM books WHERE category="Romance" ORDER BY RAND() LIMIT 10');
$romance->execute();
$romanceResult = $romance->get_result();
$dataRomance = $romanceResult->fetch_all(MYSQLI_ASSOC);

// Travel
$travel = $db->prepare('SELECT * FROM books WHERE category="Travel" ORDER BY RAND() LIMIT 10');
$travel->execute();
$travelResult = $travel->get_result();
$dataTravel = $travelResult->fetch_all(MYSQLI_ASSOC);

require_once "./functions/database_functions.php";
require_once "./functions/cart_functions.php";
$getTotalPrice = total_price($_SESSION['cart']);
?>



<!DOCTYPE html>
	<html lang="en">
	<head>
		<title>Book Store</title>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="format-detection" content="telephone=no">
	    <meta name="apple-mobile-web-app-capable" content="yes">
	    <meta name="author" content="">
	    <meta name="keywords" content="">
	    <meta name="description" content="">

	    <link rel="stylesheet" type="text/css" href="css/normalize.css">
	    <link rel="stylesheet" type="text/css" href="icomoon/icomoon.css">
	    <link rel="stylesheet" type="text/css" href="css/vendor.css">
	    <link rel="stylesheet" type="text/css" href="style.css">

		<!-- script
		================================================== -->
		<script src="js/modernizr.js"></script>

	</head>

<body>

<!-- <div id="entire-wrapper"> -->

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
								<li class="menu-item active"><a href="index.php" data-effect="Home">Home</a></li>
								<li class="menu-item"><a href="about.php" class="nav-link" data-effect="About">About</a></li>
								<li class="menu-item"><a href="index.php#popular-books" class="nav-link" data-effect="Shop">Shop</a></li>
								<li class="menu-item"><a href="index.php#latest-blog" class="nav-link" data-effect="Articles">Articles</a></li>
								<li class="menu-item"><a href="contact.php" class="nav-link" data-effect="Contact">Contact</a></li>
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

<section id="billboard" class="pattern-overlay">
	<button class="prev slick-arrow">
		<i class="icon icon-arrow-left"></i>
	</button>

	<div class="main-slider">
		<div class="slider-item">
			<div class="banner-content" data-aos="fade-up">
				<h2 class="banner-title">LUDU 🗒 STORE</h2>
				<p id="bt-readmore">• Online bookstore brings interesting shopping experience to customers.</p>
				<div class="btn-wrap">
					<a href="#bt-readmore" class="btn-outline-accent btn-accent-arrow">Read More<i class="icon icon-ns-arrow-right"></i></a>
				</div>
			</div><!--banner-content--> 
			<img src="./images/slider/1.png" alt="banner" class="banner-image">
		</div><!--slider-item-->

		<div class="slider-item">
			<div class="banner-content">
				<h2 class="banner-title">LUDU 🗒 STORE</h2>
				<p>• Innovate and create, build content to serve well and bring a "peace of mind when buying books online" experience.</p>
				<div class="btn-wrap">
					<a href="#bt-readmore" class="btn-outline-accent btn-accent-arrow">Read More<i class="icon icon-ns-arrow-right"></i></a>
				</div>
			</div><!--banner-content-->
			<img src="./images/slider/2.png" alt="banner" class="banner-image"> 
		</div><!--slider-item-->
	</div><!--slider-->
		
	<button class="next slick-arrow">
		<i class="icon icon-arrow-right"></i>
	</button>
</section>

<section id="featured-books" class="bookshelf">
	<div class="container">
		<div class="row">
			<div class="inner-content">

			<div class="section-header align-center">
				<div class="title">
					<span>Some quality items</span>
				</div>
				<h2 class="section-title">Featured Books</h2>
			</div>

			<div class="product-list" data-aos="fade-up">
				<div class="product-grid">					
                    <?php foreach ($data as $book): ?>
                        <figure class="product-style">
                            <img src="<?=$book['image']?>" alt="<?=$book['name']?>" class="product-item">
                                <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
                            <figcaption>
                                <h3><?=$book['name']?></h3>
                                <p><?=$book['author']?></p>
                                <div class="item-price"><?=$book['price']?>.000vnđ</div>
                            </figcaption>
					    </figure>
                    <?php endforeach; ?>
			    </div><!--ft-books-slider-->				
			</div><!--grid-->

			<div class="btn-wrap align-right">
				<a href="product.php" class="btn-accent-arrow">View all products <i class="icon icon-ns-arrow-right"></i></a>
			</div>

			</div><!--inner-content-->
		</div>
	</div>
</section>

<section id="best-selling" class="leaf-pattern-overlay">
	<div class="corner-pattern-overlay"></div>
	<div class="container">
		<div class="row">
			<div class="inner-content">
			<div class="product-element">
				<div class="grid">
					<figure class="products-thumb">
						<img src="<?=$book['image']?>" alt="<?=$book['name']?>" class="single-image">
					</figure>
					<div class="product-entry">
						<h2 class="section-title divider">Recommend Books</h2> <!-- BEST SELLING BOOK -->

						<div class="products-content">
							<div class="author-name">by <?=$book['author']?></div>
							<h3 class="item-title"><?=$book['name']?></h3>
							<p><?=$book['description']?></p>
							<div class="item-price"><?=$book['price']?>.000vnđ</div>
							<div class="btn-wrap">
								<a href="product.php" class="btn-accent-arrow">Shop it now <i class="icon icon-ns-arrow-right"></i></a>
							</div>
						</div><!--description-->

					</div>
				</div><!--grid-->
			</div>
			</div><!--inner-content-->
		</div>
	</div>
</section>

<section id="popular-books" class="bookshelf">
	<div class="container">
	<div class="row">
		<div class="inner-content">

			<div class="section-header align-center">
				<div class="title">
					<span>Some quality items</span>
				</div>
				<h2 class="section-title">Popular Books</h2>
			</div>
   
			<ul class="tabs">
			  <li data-tab-target="#all-genre" class="active tab">All Genre</li>
			  <li data-tab-target="#internet" class="tab">Internet</li>
			  <li data-tab-target="#education" class="tab">Technology</li>
			  <li data-tab-target="#romance" class="tab">Romantic</li>
			  <li data-tab-target="#travel" class="tab">Adventure</li>
			</ul>

			<div class="tab-content">
			  <div id="all-genre" data-tab-content class="active" data-aos="fade-up">
			  	<div class="grid">

                    <?php foreach ($data2 as $book): ?>
						<figure class="product-style">
							<img src="<?=$book['image']?>" alt="<?=$book['name']?>" class="product-item">
							<form method="post" action="cart.php">
								<input type="hidden" name="bookisbn" value="<?=$book['bookid']?>">
								<button type="submit" name="cart" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
							</form>
							<figcaption>
								<h3><?=$book['name']?></h3>
								<p><?=$book['author']?></p>
								<div class="item-price"><?=$book['price']?>.000vnđ</div>
							</figcaption>
						</figure>
                    <?php endforeach; ?>
		    	 </div>

			  </div>
			  <div id="internet" data-tab-content>
			  	<div class="grid">
				  <?php foreach ($dataInternet as $book): ?>
						<figure class="product-style">
							<img src="<?=$book['image']?>" alt="<?=$book['name']?>" class="product-item">
							<form method="post" action="cart.php">
								<input type="hidden" name="bookisbn" value="<?=$book['bookid']?>">
								<button type="submit" name="cart" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
							</form>
							<figcaption>
								<h3><?=$book['name']?></h3>
								<p><?=$book['author']?></p>
								<div class="item-price"><?=$book['price']?>.000vnđ</div>
							</figcaption>
						</figure>
                    <?php endforeach; ?>
		    	 </div>
			  </div>

			  <div id="education" data-tab-content>
			  	<div class="grid">
				  <?php foreach ($dataEducation as $book): ?>
						<figure class="product-style">
							<img src="<?=$book['image']?>" alt="<?=$book['name']?>" class="product-item">
							<form method="post" action="cart.php">
								<input type="hidden" name="bookisbn" value="<?=$book['bookid']?>">
								<button type="submit" name="cart" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
							</form>
							<figcaption>
								<h3><?=$book['name']?></h3>
								<p><?=$book['author']?></p>
								<div class="item-price"><?=$book['price']?>.000vnđ</div>
							</figcaption>
						</figure>
                    <?php endforeach; ?>
		    	 </div>
			  </div>

			  <div id="romance" data-tab-content>
			  	<div class="grid">
				  <?php foreach ($dataRomance as $book): ?>
						<figure class="product-style">
							<img src="<?=$book['image']?>" alt="<?=$book['name']?>" class="product-item">
							<form method="post" action="cart.php">
								<input type="hidden" name="bookisbn" value="<?=$book['bookid']?>">
								<button type="submit" name="cart" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
							</form>
							<figcaption>
								<h3><?=$book['name']?></h3>
								<p><?=$book['author']?></p>
								<div class="item-price"><?=$book['price']?>.000vnđ</div>
							</figcaption>
						</figure>
                    <?php endforeach; ?>
		    	 </div>
			  </div>

			  <div id="travel" data-tab-content>
			  	<div class="grid">
				  <?php foreach ($dataTravel as $book): ?>
						<figure class="product-style">
							<img src="<?=$book['image']?>" alt="<?=$book['name']?>" class="product-item">
							<form method="post" action="cart.php">
								<input type="hidden" name="bookisbn" value="<?=$book['bookid']?>">
								<button type="submit" name="cart" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
							</form>
							<figcaption>
								<h3><?=$book['name']?></h3>
								<p><?=$book['author']?></p>
								<div class="item-price"><?=$book['price']?>.000vnđ</div>
							</figcaption>
						</figure>
                    <?php endforeach; ?>
		    	 </div>
			  </div>

			</div>

		</div><!--inner-tabs-->
			
		</div>
	</div>
</section>

<section id="quotation" class="align-center">
	<div class="inner-content">
		<h2 class="section-title divider">Quote of the day</h2>
		<blockquote data-aos="fade-up">
			<q>“The more that you read, the more things you will know. The more that you learn, the more places you’ll go.”</q>
			<div class="author-name">Dr. Seuss</div>			
		</blockquote>
	</div>		
</section>

<section id="subscribe">
	<div class="container">
		<div class="row">
			<div class="inner-content">
				<div class="grid">
					<div class="title-element">
						<h2 class="section-title divider">Subscribe to our newsletter</h2>
					</div>
					<div class="subscribe-content" data-aos="fade-up">
						<p>Sed eu feugiat amet, libero ipsum enim pharetra hac dolor sit amet, consectetur. Elit adipiscing enim pharetra hac.</p>
						<form id="form">
							<input type="text" name="email" placeholder="Enter your email addresss here">
							<button class="btn-subscribe">
								<span>send</span> 
								<i class="icon icon-send"></i>
							</button>
						</form>
					</div>
				</div><!--grid-->
			</div>
		</div>
	</div>
</section>

<section id="latest-blog">
	<div class="container">
		<div class="row">
			<div class="inner-content">

			<div class="section-header align-center">
				<div class="title">
					<span>Read our articles</span>
				</div>
				<h2 class="section-title">Latest Articles</h2>
			</div>

				<div class="grid">

					<article class="column" data-aos="fade-up">

						<figure>
							<a href="#" class="image-hvr-effect">
								<img src="images/post-img1.jpg" alt="post" class="post-image">			
							</a>
						</figure>

						<div class="post-item">	
							<div class="meta-date">Oct 14, 2022</div>			
						    <h3><a href="#">Reading books always makes the moments happy</a></h3>

						    <div class="links-element">
							    <div class="categories">inspiration</div>
							    <div class="social-links">
									<ul>
										<li>
											<a href="#"><i class="icon icon-facebook"></i></a>
										</li>
										<li>
											<a href="#"><i class="icon icon-twitter"></i></a>
										</li>
										<li>
											<a href="#"><i class="icon icon-behance-square"></i></a>
										</li>
									</ul>
								</div>
							</div><!--links-element-->

						</div>
					</article>

					<article class="column" data-aos="fade-down">
						<figure>
							<a href="#" class="image-hvr-effect">
								<img src="images/post-img2.jpg" alt="post" class="post-image">
							</a>
						</figure>
						<div class="post-item">	
							<div class="meta-date">Sep 29, 2022</div>			
						    <h3><a href="#">Reading books always makes the moments happy</a></h3>

						    <div class="links-element">
							    <div class="categories">inspiration</div>
							    <div class="social-links">
									<ul>
										<li>
											<a href="#"><i class="icon icon-facebook"></i></a>
										</li>
										<li>
											<a href="#"><i class="icon icon-twitter"></i></a>
										</li>
										<li>
											<a href="#"><i class="icon icon-behance-square"></i></a>
										</li>
									</ul>
								</div>
							</div><!--links-element-->

						</div>
					</article>

					<article class="column" data-aos="fade-up">
						<figure>
							<a href="#" class="image-hvr-effect">
								<img src="images/post-img3.jpg" alt="post" class="post-image">
							</a>
						</figure>
						<div class="post-item">		
							<div class="meta-date">Sep 27, 2022</div>			
						    <h3><a href="#">Reading books always makes the moments happy</a></h3>

						    <div class="links-element">
							    <div class="categories">inspiration</div>
							    <div class="social-links">
									<ul>
										<li>
											<a href="#"><i class="icon icon-facebook"></i></a>
										</li>
										<li>
											<a href="#"><i class="icon icon-twitter"></i></a>
										</li>
										<li>
											<a href="#"><i class="icon icon-behance-square"></i></a>
										</li>
									</ul>
								</div>
							</div><!--links-element-->

						</div>
					</article>
				</div><!--grid-->

				<div class="btn-wrap align-center">
					<a href="#" class="btn-outline-accent btn-accent-arrow" tabindex="0">Read All Articles<i class="icon icon-ns-arrow-right"></i></a>
				</div>

			</div>	
		</div>
	</div>
</section>

<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="inner-content">				
				<div class="footer-menu-list">
					<div class="grid">

						<div class="footer-item">
						<div class="company-brand">
							<img src="images/logo.png" alt="logo" class="footer-logo">
							<p>• Online bookstore brings interesting shopping experience to customers.</p>
						</div>
						</div>

						<div class="footer-menu">
							<h5>About Us</h5>
							<ul class="menu-list">
								<li class="menu-item">
									<a href="#">vision</a>
								</li>
								<li class="menu-item">
									<a href="#">articles </a>
								</li>
								<li class="menu-item">
									<a href="#">careers</a>
								</li>
								<li class="menu-item">
									<a href="#">service terms</a>
								</li>
								<li class="menu-item">
									<a href="#">donate</a>
								</li>
							</ul>
						</div>

						<div class="footer-menu">
							<h5>Discover</h5>
							<ul class="menu-list">
								<li class="menu-item">
									<a href="#">Home</a>
								</li>
								<li class="menu-item">
									<a href="#">Books</a>
								</li>
								<li class="menu-item">
									<a href="#">Authors</a>
								</li>
								<li class="menu-item">
									<a href="#">Subjects</a>
								</li>
								<li class="menu-item">
									<a href="#">Advanced Search</a>
								</li>
							</ul>
						</div>

						<div class="footer-menu">
							<h5>My account</h5>
							<ul class="menu-list">
								<li class="menu-item">
									<a href="#">Sign In</a>
								</li>
								<li class="menu-item">
									<a href="#">View Cart</a>
								</li>
								<li class="menu-item">
									<a href="#">My Wishtlist</a>
								</li>
								<li class="menu-item">
									<a href="#">Track My Order</a>
								</li>
							</ul>
						</div>

						<div class="footer-menu">
							<h5>Help</h5>
							<ul class="menu-list">
								<li class="menu-item">
									<a href="#">Help center</a>
								</li>
								<li class="menu-item">
									<a href="#">Report a problem</a>
								</li>
								<li class="menu-item">
									<a href="#">Suggesting edits</a>
								</li>
								<li class="menu-item">
									<a href="#">Contact us</a>
								</li>
							</ul>
						</div>

					</div>
				</div>
			</div><!--inner-content-->
		</div>
	</div>
</footer>

<div id="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="inner-content">
				<div class="copyright">
					<div class="grid">
						<p>© 2021 All rights reserved. A free Template by <a href="https://www.templatesjungle.com/" target="_blank">Templates Jungle</a></p>
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
						</div>
					</div>
				</div><!--grid-->
			</div><!--footer-bottom-content-->			
		</div>
	</div>
</div>

<!-- </div>   -->

	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/slideNav.min.js"></script>
	<script src="js/slideNav.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/script.js"></script>	

</body>
</html>	
