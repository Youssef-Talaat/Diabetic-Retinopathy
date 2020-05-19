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
include 'header.php';

?>
<!DOCTYPE HTML>
<html>
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


	<?php
		include '../footer.php';
	?>

	</body>
</html>

