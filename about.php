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

<header class="showcase">
    <div class="content">
      <img src="./images/logo.png" class="logo" alt="LuduLogo">
      <div class="title">
        About Us
      </div>
      <div class="text">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, vel.
      </div>
    </div>
  </header>
  <!-- Services -->
  <section class="services">
    <div class="container grid-3 center">
      <div>
        <h3>YouTube</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, reiciendis!</p>
      </div>
      <div>
        <h3>Courses</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, reiciendis!</p>
      </div>
      <div>
        <h3>Freelancing Projects</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, reiciendis!</p>
      </div>
    </div>
  </section>

  <!-- About -->
  <section class="about bg-light">
    <div class="container">
      <div class="grid-2">
        <div class="center">
          <img src="./images/about1.jpg" alt="">
        </div>
        <div style="padding: 35px">
          <h3>About Us</h3>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non eos aperiam labore consectetur maiores ea magni exercitationem
            similique laborum sed, unde, autem vel iure doloribus aliquid. Aspernatur explicabo consectetur consequatur non
            nesciunt debitis quos alias soluta, ratione, ipsa officia reiciendis.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->

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

<style>
body {
  background-color: #F3F2EC;
  margin: 0;
  color: #fff;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.showcase::after {
  content: '';
  height: 100vh;
  width: 100%;
  background-image: url(https://image.ibb.co/gzOBup/showcase.jpg);
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  display: block;
  filter: blur(10px);
  -webkit-filter: blur(10px);
  transition: all 1000ms;
}
.showcase:hover::after {
  filter: blur(0px);
  -webkit-filter: blur(0px);
}

.showcase:hover .content {
  filter: blur(2px);
  -webkit-filter: blur(2px);
}

.content {
  position: absolute;
  z-index: 1;
  top: 10%;
  left: 50%;
  margin-top: 105px;
  margin-left: -145px;
  width: 300px;
  height: 350px;
  text-align: center;
  transition: all 1000ms;
}

.content .logo {
  margin-top: 50%;
}

.content .title {
  font-size: 2.2rem;
  margin-top: 1rem;
  color: #171717;
}

.content .text {
  line-height: 1.7;
  margin-top: 1rem;
  color: #171717;
}

.grid-3 {
  display: grid;
  grid-gap: 20px;
  grid-template-columns: repeat(3, 1fr);
}

.grid-2 {
  display: grid;
  grid-gap: 20px;
  grid-template-columns: repeat(2, 1fr);
}

.center {
  text-align: center;
  border-bottom: 1px solid #E0E0E0;
  margin-top: 40px;
  margin-bottom: 50px;
}

.bg-light {
  background: #f4f4f4;
  color: #333;
}

.bg-dark {
  background: #333;
  color: #f4f4f4;
}
.services p{
	margin: 0 0 20px 0;
	color: black;
}
/* Small Screens */
@media (max-width: 560px) {
  .showcase::after {
    height: 50vh;
  }

  .content {
    top: 5%;
    margin-top: 5px;
  }


  .content .text {
    display: none;
  }

  .grid-3,
  .grid-2 {
    grid-template-columns: 1fr;
  }

  .services div {
    border-bottom: #333 dashed 1px;
    padding: 1.2rem 1rem;
  }
}

/* Landscape */
@media (max-height: 500px) {
  .content .title,
  .content .text {
    display: none;
  }

  .content {
    top: 0;
  }
}

</style>