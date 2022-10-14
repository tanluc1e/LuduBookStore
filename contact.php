<?php
session_start();
include("connect.php");

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
	    <link rel="stylesheet" type="text/css" href="style2.css">
		<link rel="stylesheet" href="style.css">

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
								<a href="#">
								<i class="icon icon-clipboard"></i>
								<span>Cart:(0 $)</span>
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
								<li class="menu-item"><a href="#shop" class="nav-link" data-effect="Shop">Shop</a></li>
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

  <!-- Start slider -->
  <div class="main_slider"  style="background-image:url(https://i.pinimg.com/564x/d3/73/f5/d373f5abec381e4a6b3cde1cf3bed4e9.jpg); height: 400px">
        <div class="container fill_height">
            <div class="row align-items-center fill_height">
                <div class="col">
                    <div class="main_slider_content">
                        <h6>New Collection Arriving August 2022</h6>
                        <h1>Up to 30% off all new arrivals</h1>
                        <div class="red_button shop_now_button"><a href="#">shop now</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
    <!-- End slider -->

     <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="container ">
      <div class="heading_container justify-content-center">
        <h2 class=""   style="text-align: center;" >
          Contact Us
        </h2>
      </div>

    </div>
    <div class="container" >
      <div class="row" style="justify-content: center;">
        <div class="col-md-6 mx-auto " >
          <form action="">
            <div>
              <input type="text" placeholder="Name" />
            </div>
            <div>
              <input type="email" placeholder="Email" />
            </div>
            <div>
              <input type="text" placeholder="Phone Number" />
            </div>
            <div>
              <input type="text" class="message-box" placeholder="Message" />
            </div>
            <div class="d-flex  mt-4 ">
              <button>
                SEND
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->
  <!-- ##### Newsletter Area Start ##### -->
  <section class="newsletter-area section-padding-100-0 mt-5" style="background-color:#E0E0E0;">
    <div class="container">
        <div class="row align-items-center" >
            <!-- Newsletter Text -->
            <div class="col-12 col-lg-6 col-xl-7" style="margin: 40px 0 50px 0;">
                <div class="newsletter-text mb-100">
                    <h2>Subscribe for a <span>25% Discount</span></h2>
                    <p>
                    Subscribe to our newsletter and get 25% off your first purchase</p>
                </div>
            </div>
            <!-- Newsletter Form -->
            <div class="col-12 col-lg-6 col-xl-5" style="margin: 40px 0 50px 0;">
                <div class="newsletter-form mb-100">
                    <form action="#" >
                        <input type="email" name="email" class="nl-email" placeholder="Your E-mail" >
                        <input type="submit" value="Subscribe">
                    </form>
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
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sed ptibus liberolectus nonet psryroin. Amet sed lorem posuere sit iaculis amet, ac urna. Adipiscing fames semper erat ac in suspendisse iaculis.</p>
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
