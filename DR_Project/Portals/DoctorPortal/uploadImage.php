<?php
//ob_start();
session_start();
include '../../Classes/User.php';
include '../../Classes/Link.php';
include '../../Classes/UserType.php';
include '../../Classes/Image.php';
include '../../Classes/Report.php';
include '../../Classes/Stage.php';
include '../../Classes/Preprocess.php';
include '../../DatabaseFile/Database.php';
include '../../Classes/Classify.php';
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

	<!------Tables Scripts-->
	<link rel = "StyleSheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity = "sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin = "Anonymous">
	<script src = "https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity = "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin = "Anonymous"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/> 
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
	<!------Tables Scripts-->
  	
	
	<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700|Muli:300,400" rel="stylesheet">
  <link rel = "StyleSheet" href = "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../fonts/icomoon/style.css">
	
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
			   					<h1><strong>Doctors</strong> Portal</h1>
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
					<br><br>
			<?php
					echo "
					<h2>Upload fundus Images</h2>
					<form method = 'Post' enctype='multipart/form-data'>
						<div class='row form-group'>
							<div class='col-md-6'>
								<label for='imageLeft'>Upload Left Image</label>
								<input type='file' id='imageLeft' name='imageLeft' accept='image/x-png,image/gif,image/jpeg' onchange='loadFileLeft(event)' class='form-control mb'>
							</div>
							<div class='col-md-6'>
								<label for='imageRight'>Upload Right Image</label>
								<input type='file' id='imageRight' name='imageRight' accept='image/x-png,image/gif,image/jpeg' onchange='loadFileRight(event)' class='form-control mb'>
							</div>
						</div>
						<div class='row form-group'>
							<div class='col-md-6' align='center'>
								<img style='width:224px; height:224px;' id='outputLeft'/>
							</div>
							<div class='col-md-6' align='center'>
								<img style='width:224px; height:224px;' id='outputRight'/>
							</div>
						</div>

						<div class='form-group text-center'>
							<input type='submit' value='Classify Image' name='classifyImage' class='btn btn-primary'>
						</div>
					</form><br>";

					echo "
					<div id='abc' class='container'>
						<h2>Classification In Progress</h2>
						<p>Classifying the input images and generating the result's report</p> 
						<div class='progress'>
							<div class='progress-bar progress-bar-success progress-bar-striped' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'>
							100% Complete (success)
							</div>
						</div>
					</div>";

				if(isset($_POST['classifyImage']))
				{
                    $LeftObject = new Image(0);
                    $LeftObject->width = 224;
                    $LeftObject->height = 224;
                    
                    $RightObject = new Image(0);
                    $RightObject->width = 224;
                    $RightObject->height = 224;
                    
                    $Report = new Report(0);
                    $Report->doctorID = unserialize($_SESSION['user']);
                    $Report->patientID = unserialize($_SESSION['patientID'])->ID;
                    $Report->date = date("Y-m-d");
                    
                    $Path = "C:/wamp64/www/DR_Project/Retinal_Images";

                    $LeftImage = $_FILES['imageLeft']["tmp_name"];
                    $RightImage = $_FILES['imageRight']["tmp_name"];
                    
                    if(empty($LeftImage) && empty($RightImage)){
                        echo "<script type='text/javascript'>alert('Please Choose at least One Image');</script>";
                    }
                    else if(!empty($LeftImage)&& empty($RightImage)){
                            copy($LeftImage, $Path ."/". time() . ".jpg");
                        
                            $LeftClassifierPath = $Path ."/". time() . ".jpg";
                            $LeftImagePath = time() . ".jpg";
                            $LeftObject->imagePath = $LeftImagePath;
                        
                            Preprocess::normalize($LeftClassifierPath);
                            
                            $Classify = Classify::classifyWithCNN($LeftClassifierPath);
                            $_SESSION['LImage'] = serialize($Classify);
                        
                            $LeftObject->ID = Image::add($LeftObject);
                        
                            $Report->leftImageID = $LeftObject;
                            $Report->rightImageID = new Image(0);
					   echo "<script>window.location = 'http://localhost/DR_Project/Portals/DoctorPortal/previewResults.php';</script>";
                    }
                    else if(empty($LeftImage) && !empty($RightImage)){
                            copy($RightImage, $Path ."/". time() . ".jpg");
                        
                            $RightClassifierPath = $Path ."/". time() . ".jpg";
                            $RightImagePath = time() . ".jpg";
                            $RightObject->imagePath = $RightImagePath;
                        
                            Preprocess::normalize($RightClassifierPath);
                        
                            $Classify = Classify::classifyWithCNN($RightClassifierPath);
                            $_SESSION['RImage'] = serialize($Classify); 
                        
                            $RightObject->ID = Image::add($RightObject);
                        
                            $Report->rightImageID = $RightObject;
                            
                            $Report->leftImageID = new Image(0);
					   echo "<script>window.location = 'http://localhost/DR_Project/Portals/DoctorPortal/previewResults.php';</script>";
                    }
                    else { // If Both are not empty
                            copy($LeftImage, $Path ."/". time() . ".jpg");
                            copy($RightImage, $Path ."/". (time() + 1). ".jpg");
                        
                            $LeftClassifierPath = $Path ."/". time() . ".jpg";
                            $LeftImagePath = time() . ".jpg";
                            $LeftObject->imagePath = $LeftImagePath;
                            $LeftObject->ID = Image::add($LeftObject);
                                                
                            $RightClassifierPath = $Path ."/". (time() + 1) . ".jpg";
                            $RightImagePath = (time() + 1) . ".jpg";
                            $RightObject->imagePath = $RightImagePath;
                            $RightObject->ID = Image::add($RightObject);
                        
                            Preprocess::normalize($LeftClassifierPath);
                            Preprocess::normalize($RightClassifierPath);
                        
                            $Classify = Classify::classifyWithCNN($LeftClassifierPath);
                            $Classify2 = Classify::classifyWithCNN($RightClassifierPath);
                            
                            $_SESSION['LImage'] = serialize($Classify);
                            $_SESSION['RImage'] = serialize($Classify2);  
                        
                            $Report->rightImageID = $RightObject;
                            $Report->leftImageID = $LeftObject;
                        
					   echo "<script>window.location = 'http://localhost/DR_Project/Portals/DoctorPortal/previewResults.php';</script>";
                    }
                    
                        $_SESSION["Report"] = serialize($Report);
				}

			?>
				</div>
			</div>	
		</div>

		
		<script>
		var loadFileLeft = function(event) {
			var output = document.getElementById('outputLeft');
			output.src = URL.createObjectURL(event.target.files[0]);
		};
		</script>

		<script>
		var loadFileRight = function(event) {
			var output = document.getElementById('outputRight');
			output.src = URL.createObjectURL(event.target.files[0]);
		};
		</script>

		<script>
            $('#tbl').DataTable();
        </script>
	
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

