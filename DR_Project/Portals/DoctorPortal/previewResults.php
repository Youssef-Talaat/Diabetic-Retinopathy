<?php
//ob_start();
session_start();
include '../../Classes/User.php';
include '../../Classes/Link.php';
include '../../Classes/UserType.php';
include '../../Classes/Image.php';
include '../../Classes/Report.php';
include '../../Classes/Stage.php';
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

	<!------Tables Scripts-->
	<link rel = "StyleSheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity = "sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin = "Anonymous">
	<script src = "https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity = "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin = "Anonymous"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/> 
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
	<!------Tables Scripts-->
  	
	
	<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700|Muli:300,400" rel="stylesheet">
  <link rel = "StyleSheet" href = "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../fonts/icomoon/style.css">
	
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

	<style>
		.table {
			width: 50%;
			margin-bottom: 20px;
			margin-left: 30%;
		}
	</style>

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
                    if(!empty($_SESSION['LImage'])){
                        $LeftResult = unserialize($_SESSION['LImage']);
                        $LeftArraySize = sizeof($LeftResult);
                        if($LeftArraySize == 3){
                            $No = (float)$LeftResult[1] * 100.0;
                            $Yes = (float)$LeftResult[2] * 100.0;
                            $Max = array_search(max($No/100.0, $Yes/100.0), $LeftResult);
                            $Session = unserialize($_SESSION["Report"]);
                            $Session->leftStageID = ($Max); 
                            $_SESSION["Report"] = serialize($Session);
                echo "
					<hr width='1' size=300'/>
					<h2>System Results</h2>
                    <br>
                    <h3><b>Left</b> Eye Results</h3>
					<form method='post' action=''>

					<br><br><br><br><br><br>
                    
					<div id='colorlib-counter' class='colorlib-counters'>
					<div class='overlay'></div>
					<div class='container'>
						<div class='row'>
							<div class='col-md-8 col-md-offset-2 col-md-push-0 counter-wrap'>
								<div class='row'>
									<div class='col-md-3 col-sm-6 animate-box'>
										<div class='desc'>
											<p class='wrap'>
												<span class='icon'><i>%</i></span>
												<span class='colorlib-counter js-counter' data-from='0' data-to='".$No."' data-speed='1000' data-refresh-interval='50'></span>
											</p>
											<span class='colorlib-counter-label'>--- Stage 0 ---</span>
										</div>
									</div>
									<div class='col-md-2 col-sm-6 animate-box'>
										<div class='desc'>
											<p class='wrap'>
												<span class='icon'><i>%</i></span>
												<span class='colorlib-counter js-counter' data-from='0' data-to='".$Yes."' data-speed='1000' data-refresh-interval='50'></span>
											</p>
											<span class='colorlib-counter-label'>--- Stage 1 ---</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
						<br>
						<!--<h3 align='center'>Suggest the correct stage</h3>
						<div class='row form-group'>
							<div class='col-md-4' style='margin-left: 33%;'>
								<label for='username' style='margin-left: 35%;'>Suggested Stage</label>
								<select id='username' name='username' class='form-control' style='padding: 0px 20px;'>
									<option value='stage0'>No DR</option>	
									<option value='stage1'>Stage 1</option>	
									<option value='stage2'>Stage 2</option>	
									<option value='stage3'>Stage 3</option>	
									<option value='stage4'>Stage 4</option>	
								</select>
							</div>
						</div>
						<div class='row form-group' style='margin-left: 43%;'>
							<div class='form-group text-center'>
								<input type='submit' value='Suggest Stage' name='suggestStage' class='btn btn-primary'>
							</div>
						</div>-->
						<hr style='height:1px;border:none;color:#333;background-color:#333;' >";
                        }
                        else if($LeftArraySize == 5){
                            $S1 = (float)$LeftResult[1] * 100.0;
                            $S2 = (float)$LeftResult[2] * 100.0;
                            $S3 = (float)$LeftResult[3] * 100.0;
                            $S4 = (float)$LeftResult[4] * 100.0;
                            $Max = array_search(max($S1/100.0,$S2/100.0,$S3/100.0,$S4/100.0), $LeftResult);
                            $Session = unserialize($_SESSION["Report"]);
                            $Session->leftStageID = ($Max + 1); 
                            $_SESSION["Report"] = serialize($Session);
            echo "
                 <br>  
                <h3><b>Left</b> Eye Results</h3>   
					<form method='post' action=''> 
					<br><br><br><br><br><br>
					<div id='colorlib-counter' class='colorlib-counters'>
					<div class='overlay'></div>
					<div class='container'>
						<div class='row'>
							<div class='col-md-8 col-md-offset-2 col-md-push-0 counter-wrap'>
								<div class='row'>
									<div class='col-md-2 col-sm-6 animate-box'>
										<div class='desc'>
											<p class='wrap'>
												<span class='icon'><i>%</i></span>
												<span class='colorlib-counter js-counter' data-from='0' data-to='".$S1."' data-speed='1000' data-refresh-interval='50'></span>
											</p>
											<span class='colorlib-counter-label'>--- Stage 1 ---</span>
										</div>
									</div>
									<div class='col-md-2 col-sm-6 animate-box'>
										<div class='desc'>
											<p class='wrap'>
												<span class='icon'><i>%</i></span>
												<span class='colorlib-counter js-counter' data-from='0' data-to='".$S2."' data-speed='1000' data-refresh-interval='50'></span>
											</p>
											<span class='colorlib-counter-label'>--- Stage 2 ---</span>
										</div>
									</div>
									<div class='col-md-2 col-sm-6 animate-box'>
										<div class='desc'>
											<p class='wrap'>
												<span class='icon'><i>%</i></span>
												<span class='colorlib-counter js-counter' data-from='0' data-to='".$S3."' data-speed='1000' data-refresh-interval='50'></span>
											</p>
											<span class='colorlib-counter-label'>--- Stage 3 ---</span>
										</div>
									</div>
									<div class='col-md-2 col-sm-6 animate-box'>
										<div class='desc'>
											<p class='wrap'>
												<span class='icon'><i>%</i></span>
												<span class='colorlib-counter js-counter' data-from='0' data-to='".$S4."' data-speed='1000' data-refresh-interval='50'></span>
											</p>
											<span class='colorlib-counter-label'>--- Stage 4 ---</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
						<br>
						<!--<h3 align='center'>Suggest the correct stage</h3>
						<div class='row form-group'>
							<div class='col-md-4' style='margin-left: 33%;'>
								<label for='username' style='margin-left: 35%;'>Suggested Stage</label>
								<select id='username' name='username' class='form-control' style='padding: 0px 20px;'>
									<option value='stage0'>No DR</option>	
									<option value='stage1'>Stage 1</option>	
									<option value='stage2'>Stage 2</option>	
									<option value='stage3'>Stage 3</option>	
									<option value='stage4'>Stage 4</option>	
								</select>
							</div>
						</div>
						<div class='row form-group' style='margin-left: 43%;'>
							<div class='form-group text-center'>
								<input type='submit' value='Suggest Stage' name='suggestStage' class='btn btn-primary'>
							</div>
						</div>-->";
                        }
                        unset($_SESSION['LImage']);
                    }
                    
                    if(!empty($_SESSION['RImage'])){
                        $RightResult = unserialize($_SESSION['RImage']);
                        $RightArraySize = sizeof($RightResult);
                        if($RightArraySize == 3){
                            $No = (float)$RightResult[1] * 100.0;
                            $Yes = (float)$RightResult[2] * 100.0;
                            $Max = array_search(max($No/100.0, $Yes/100.0), $RightResult);
                            $Session = unserialize($_SESSION["Report"]);
                            $Session->rightStageID = ($Max); 
                            $_SESSION["Report"] = serialize($Session); 
                echo "
					<hr width='1' size=300'/>
                    <h3><b>Right</b> Eye Results</h3>
					<form method='post' action=''>

					<br><br><br><br><br><br>
                    
					<div id='colorlib-counter' class='colorlib-counters'>
					<div class='overlay'></div>
					<div class='container'>
						<div class='row'>
							<div class='col-md-8 col-md-offset-2 col-md-push-0 counter-wrap'>
								<div class='row'>
									<div class='col-md-3 col-sm-6 animate-box'>
										<div class='desc'>
											<p class='wrap'>
												<span class='icon'><i>%</i></span>
												<span class='colorlib-counter js-counter' data-from='0' data-to='".$No."' data-speed='1000' data-refresh-interval='50'></span>
											</p>
											<span class='colorlib-counter-label'>--- Stage 0 ---</span>
										</div>
									</div>
									<div class='col-md-2 col-sm-6 animate-box'>
										<div class='desc'>
											<p class='wrap'>
												<span class='icon'><i>%</i></span>
												<span class='colorlib-counter js-counter' data-from='0' data-to='".$Yes."' data-speed='1000' data-refresh-interval='50'></span>
											</p>
											<span class='colorlib-counter-label'>--- Stage 1 ---</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
						<br>
						<!--<h3 align='center'>Suggest the correct stage</h3>
						<div class='row form-group'>
							<div class='col-md-4' style='margin-left: 33%;'>
								<label for='username' style='margin-left: 35%;'>Suggested Stage</label>
								<select id='username' name='username' class='form-control' style='padding: 0px 20px;'>
									<option value='stage0'>No DR</option>	
									<option value='stage1'>Stage 1</option>	
									<option value='stage2'>Stage 2</option>	
									<option value='stage3'>Stage 3</option>	
									<option value='stage4'>Stage 4</option>	
								</select>
							</div>
						</div>
						<div class='row form-group' style='margin-left: 43%;'>
							<div class='form-group text-center'>
								<input type='submit' value='Suggest Stage' name='suggestStage' class='btn btn-primary'>
							</div>
						</div>-->
						<hr style='height:1px;border:none;color:#333;background-color:#333;' >";
                        }
                        else if($RightArraySize == 5){
                            $RS1 = (float)$RightResult[1] * 100.0;
                            $RS2 = (float)$RightResult[2] * 100.0;
                            $RS3 = (float)$RightResult[3] * 100.0;
                            $RS4 = (float)$RightResult[4] * 100.0;
                            $Max = array_search(max($RS1/100.0,$RS2/100.0,$RS3/100.0,$RS4/100.0), $RightResult);
                            $Session = unserialize($_SESSION["Report"]);
                            $Session->rightStageID = ($Max + 1); 
                            $_SESSION["Report"] = serialize($Session); 
                echo "
                 <br>  
                <h3><b>Right</b> Eye Results</h3>   
					<form method='post' action=''> 
					<br><br><br><br><br><br>
					<div id='colorlib-counter' class='colorlib-counters'>
					<div class='overlay'></div>
					<div class='container'>
						<div class='row'>
							<div class='col-md-8 col-md-offset-2 col-md-push-0 counter-wrap'>
								<div class='row'>
									<div class='col-md-2 col-sm-6 animate-box'>
										<div class='desc'>
											<p class='wrap'>
												<span class='icon'><i>%</i></span>
												<span class='colorlib-counter js-counter' data-from='0' data-to='".$RS1."' data-speed='1000' data-refresh-interval='50'></span>
											</p>
											<span class='colorlib-counter-label'>--- Stage 1 ---</span>
										</div>
									</div>
									<div class='col-md-2 col-sm-6 animate-box'>
										<div class='desc'>
											<p class='wrap'>
												<span class='icon'><i>%</i></span>
												<span class='colorlib-counter js-counter' data-from='0' data-to='".$RS2."' data-speed='1000' data-refresh-interval='50'></span>
											</p>
											<span class='colorlib-counter-label'>--- Stage 2 ---</span>
										</div>
									</div>
									<div class='col-md-2 col-sm-6 animate-box'>
										<div class='desc'>
											<p class='wrap'>
												<span class='icon'><i>%</i></span>
												<span class='colorlib-counter js-counter' data-from='0' data-to='".$RS3."' data-speed='1000' data-refresh-interval='50'></span>
											</p>
											<span class='colorlib-counter-label'>--- Stage 3 ---</span>
										</div>
									</div>
									<div class='col-md-2 col-sm-6 animate-box'>
										<div class='desc'>
											<p class='wrap'>
												<span class='icon'><i>%</i></span>
												<span class='colorlib-counter js-counter' data-from='0' data-to='".$RS4."' data-speed='1000' data-refresh-interval='50'></span>
											</p>
											<span class='colorlib-counter-label'>--- Stage 4 ---</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
						<br>
						<!--<h3 align='center'>Suggest the correct stage</h3>
						<div class='row form-group'>
							<div class='col-md-4' style='margin-left: 33%;'>
								<label for='username' style='margin-left: 35%;'>Suggested Stage</label>
								<select id='username' name='username' class='form-control' style='padding: 0px 20px;'>
									<option value='stage0'>No DR</option>	
									<option value='stage1'>Stage 1</option>	
									<option value='stage2'>Stage 2</option>	
									<option value='stage3'>Stage 3</option>	
									<option value='stage4'>Stage 4</option>	
								</select>
							</div>
						</div>
						<div class='row form-group' style='margin-left: 43%;'>
							<div class='form-group text-center'>
								<input type='submit' value='Suggest Stage' name='suggestStage' class='btn btn-primary'>
							</div>
						</div>-->";
                        }
                         unset($_SESSION['RImage']);
                    }
                                        
                    echo "
						<div class='form-group text-center' align='right'>
							<input type='submit' value='Save Results' name='SaveResults' class='btn btn-primary'>
						</div>
					</form><br>";

				if(isset($_POST['SaveResults'])) {
                    $Report = unserialize($_SESSION["Report"]);
                    $Report->ID = Report::add(unserialize($_SESSION["Report"]));
                    $_SESSION["Report"] = serialize($Report);
					echo "<script>window.location = 'http://localhost/DR_Project/Portals/DoctorPortal/previewReport.php';</script>";
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

