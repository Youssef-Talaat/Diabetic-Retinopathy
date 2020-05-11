<?php
//ob_start();
session_start();
include '../../Classes/User.php';
include '../../Classes/Link.php';
include '../../Classes/UserType.php';
include '../../DatabaseFile/Database.php';

?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Healthcare Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="../../css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../../css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="../../css/bootstrap.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="../../css/magnific-popup.css">
	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="../../css/owl.carousel.min.css">
	<link rel="stylesheet" href="../../css/owl.theme.default.min.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="../../css/flexslider.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="../../fonts/flaticon/font/flaticon.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="../../css/style.css">

	<!-- Modernizr JS -->
	<script src="../../js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="colorlib-loader"></div>
	
	<div id="page">
	<nav class="colorlib-nav" role="navigation">
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="top">
							<div class="row">
								<div class="col-md-6">
									<div id="colorlib-logo"><a href="../../index.html">Health<span>care</span></a></div>
								</div>
								<div class="col-md-3">
									<div class="num">
										<span class="icon"><i class="icon-phone"></i></span>
										<p><a href="#">111-222-333</a><br><a href="#">99-222-333</a></p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="loc">
										<span class="icon"><i class="icon-location"></i></span>
										<p><a href="#">88 Route West 21th Street, Suite 721 New York NY 10016</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--<div class="menu-wrap">
				<div class="container">
					<div class="row">
						<div class="col-xs-8">
							<div class="menu-1">
								<ul>
								<?php
									for($i = 0 ; $i < count(unserialize($_SESSION['user'])->links) ; $i++)
									{
										echo "
										<li>
											<a href='".unserialize($_SESSION['user'])->links[$i]->physicalAddress."'>
											<span>".unserialize($_SESSION['user'])->links[$i]->friendlyName."</span>
											</a>
										</li>";
									}
								?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>-->
		</div>
	</nav>
	
	<aside id="colorlib-hero" class="breadcrumbs">
		<div class="flexslider">
			<ul class="slides">
		   	<li style="background-image: url(../../images/img_bg_6.jpg);">
		   		<div class="overlay"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
			   				<div class="slider-text-inner">
			   					<h1><strong>Admins</strong> Portal</h1>
									<h2>Helping to improve quality</h2>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
				<h2>Create a new User</h2>
					<form method = 'Post'>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="fullName">Full Name</label>
								<input type="text" id="fullName" name="fullName" class="form-control mb" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label for="userType">UserType</label>
								<select id="userType" name="userType" class="form-control mb" required>
									<?php
										$userTypes = UserType::view(1);
										for($i=0;$i<sizeof($userTypes);$i++)
										{
											echo "
												<option value='".$userTypes[$i]->ID."'>".$userTypes[$i]->name."</option>
											";
										}
									?>
								</select>
							</div>
							<div class="col-md-6">
								<label for="DOB">DOB</label>
								<input type="date" id="DOB" name="DOB" class="form-control" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label for="email">Email</label>
								<input type="email" id="email" name="email" class="form-control mb" required>
							</div>
							<div class="col-md-6">
								<label for="telephone">Telephone</label>
								<input type="text" id="telephone" name="telephone" class="form-control" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label for="username">Username</label>
								<input type="text" id="username" name="username" class="form-control mb" required>
							</div>
							<div class="col-md-6">
								<label for="password">Password</label>
								<input type="password" id="password" name="password" class="form-control" required>
							</div>
						</div>

						<div class="form-group text-center">
							<input type="submit" value="Create User" name="createDoctor" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>	
		</div>

		<?php
			if(isset($_POST['createDoctor'])) {
				$doctor = new User(0);
				$doctor->fullName = $_POST['fullName'];
				$doctor->DOB = $_POST['DOB'];
				$doctor->email = $_POST['email'];
				$doctor->telephone = $_POST['telephone'];
				$doctor->username = $_POST['username'];
				$doctor->password = sha1($_POST['password']);
				$doctor->userTypeID = $_POST['userType'];
				User::add($doctor);
				echo '<script>javascript:history.go(-2)</script>';
			}
		?>

	
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="../../js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../../js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../../js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="../../js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="../../js/jquery.stellar.min.js"></script>
	<!-- Carousel -->
	<script src="../../js/owl.carousel.min.js"></script>
	<!-- Flexslider -->
	<script src="../../js/jquery.flexslider-min.js"></script>
	<!-- countTo -->
	<script src="../../js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="../../js/jquery.magnific-popup.min.js"></script>
	<script src="../../js/magnific-popup-options.js"></script>
	<!-- Sticky Kit -->
	<script src="../../js/sticky-kit.min.js"></script>
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="../../js/google_map.js"></script>
	<!-- Main -->
	<script src="../../js/main.js"></script>

	</body>
</html>

