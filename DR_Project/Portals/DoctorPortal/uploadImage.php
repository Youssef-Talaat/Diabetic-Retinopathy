<?php
//ob_start();
session_start();
include '../../Classes/User.php';
include '../../Classes/Link.php';
include '../../Classes/UserType.php';
include '../../Classes/Image.php';
include '../../Classes/Report.php';
include '../../Classes/Doctor.php';
include '../../Classes/Stage.php';
include '../../Classes/Preprocess.php';
include '../../DatabaseFile/Database.php';
include '../../Classes/Classify.php';
include 'header.php';
?>
<!DOCTYPE HTML>
<html>
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
                    
                    $Path = "C:/xampp/htdocs/DR_Project/Retinal_Images";

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
                            
                            $Classify = Doctor::classify($LeftClassifierPath);
                            $_SESSION['LImage'] = serialize($Classify);
                        
                            $LeftObject->ID = Doctor::uploadImage($LeftObject);
                        
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
                        
                            $Classify = Doctor::classify($LeftClassifierPath);
                            $_SESSION['RImage'] = serialize($Classify); 
                        
                            $RightObject->ID = Doctor::uploadImage($RightObject);
                        
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
                            $LeftObject->ID = Doctor::uploadImage($LeftObject);
                                                
                            $RightClassifierPath = $Path ."/". (time() + 1) . ".jpg";
                            $RightImagePath = (time() + 1) . ".jpg";
                            $RightObject->imagePath = $RightImagePath;
                            $RightObject->ID = Doctor::uploadImage($RightObject);
                        
                            Preprocess::normalize($LeftClassifierPath);
                            Preprocess::normalize($RightClassifierPath);
                        
                            $Classify = Doctor::classify($LeftClassifierPath);
                            $Classify2 = Doctor::classify($LeftClassifierPath);
                            
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


	<?php
		include '../footer.php';
	?>

	</body>
</html>

