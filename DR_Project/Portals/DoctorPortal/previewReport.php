<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<?php
ob_start();
session_start();
include '../../Classes/User.php';
include '../../Classes/Link.php';
include '../../Classes/Stage.php';
include '../../Classes/Report.php';
include '../../Classes/Image.php';
include '../../Classes/UserType.php';
include "../../DatabaseFile/Database.php";
    
$Report = unserialize($_SESSION['Report']); 
$Patient = new User($Report->patientID);

?>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Medical Report</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />
  	
	
	<!-- Animate.css -->
	<!-- Bootstrap  -->
	<!-- Flexslider  -->
	<!-- Flaticons  -->
	<!-- Theme style  -->
	<link rel="stylesheet" href="../../css/style.css">

	<!-- Modernizr JS -->
	<script src="../../js/modernizr-2.6.2.min.js"></script>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media='print' />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>

	<style>
		@page {margin:0 1cm}
		html {margin:0 0cm}
        #des_textarea {
          resize: vertical;
        }
        .meta-head{
            color: black
        }
        .meta-body{
            color: black
        }
        
	</style>

</head>

<body>

	<form action='' method='post'>
	<div id='page-wrap'>

		<textarea id='header'>Medical Report</textarea>
		
              <img id='image' src='images/logo.jpg' alt='logo' />
              <br><br>
		
		
		<div style='clear:both'></div>
		
		<div id='customer'>

		<table id='vendorMeta'>
                <tr>
                    <td class='meta-head'>Patient Name</td>
                    <td class='meta-body' style='text-align:center;'><?php echo $Patient->fullName; ?></td>
                </tr>
                <tr>
                    <td class='meta-head'>Date</td>
                    <td class='meta-body' style='text-align:center;'><?php echo $Report->date; ?></td>
                    
                </tr>
                <tr>
                    <td class='meta-head'>Date Of Birth</td>
                    <td class='meta-body' style='text-align:center;'><?php echo $Patient->DOB; ?></td>
                </tr>

            </table>

            <table id='meta'>
                <tr>
                    <td class='meta-head'>Doctor Name</td>
                    <td class='meta-body' style='text-align:center;'><?php echo $Report->doctorID->fullName; ?></td>
                </tr>
                <tr>
                    <td class='meta-head'>Department</td>
                    <td class='meta-body' style='text-align:center;'>Ophthalmologist</td>
                </tr>
                <tr>
                    <td class='meta-head'>Status</td>
                    <td class='meta-body' style='text-align:center;'><div class='due'>Issued</div></td>
                </tr>

            </table>
		
		</div>
		<br><br>
		
		<table class='meta-body' id='items' style="">
            <tr>
		      <th>Fundus Images</th>
		      <th>Disease Level</th>
		      <th>Disease Stage</th>
		  </tr>
            
		<?php 
            if($Report->leftImageID->ID != null){
                $Stage = new Stage($Report->leftStageID);
                echo "
                  <tr class='item-row'>
                      <td style='text-align:center;'><img id='outputLeft' src='". Image::$folderPath . $Report->leftImageID->imagePath ."'/></td>
                      <td style='font-size:20px; text-align:center;'>".$Stage->level."</td>
                      <td style='font-size:20px; text-align:center;'>".$Stage->LevelName."</td>
                  </tr>";
            }
            if($Report->rightImageID->ID != null){
                $Stage = new Stage($Report->rightStageID);
                echo "
                  <tr class='item-row'>
                      <td style='text-align:center;'><img id='outputLeft' src='". Image::$folderPath . $Report->rightImageID->imagePath."'/></td>
                      <td style='font-size:20px; text-align:center;'>".$Stage->level."</td>
                      <td style='font-size:20px; text-align:center;'>".$Stage->LevelName."</td>
                  </tr>";
            }  
            
            echo"
                <tr>
                <th style='background-color:grey; font-size:18px;' colspan='3' >Description</th>
                </tr>";
            
            if(unserialize($_SESSION['user'])->userTypeID->name == 'Doctor') {
            echo"
                <tr class='item-row'>
                    <td colspan='3' class='description'><textarea name='Comment' id='des_textarea'>".$Report->doctorComment."</textarea></td>
                </tr>";
            }
            else {
                echo"
                <tr class='item-row'>
                    <td colspan='3' class='description'>".$Report->doctorComment."</td>
                </tr>";
            }
           echo "</table>";
            
            if(isset($_POST['Print']) && unserialize($_SESSION['user'])->userTypeID->name == 'Doctor') {
                    $Report->doctorComment = $_POST['Comment'];
                    Report::update($Report);
//                    echo '<script>javascript:history.go(-1)</script>';
                    echo "<script>window.location = 'http://localhost/DR_Project/Portals/DoctorPortal/viewPatients.php';</script>";
            }
            
                echo "
                        <br><br>
                        <div class='form-group text-center'>
				        <input type='submit' value='Print Report' name='Print' style='margin-left:350px;' onclick='window.print()' class='btn btn-primary'>
                        </div>
		                <br><br>";
            
            ?>
		<textarea id='header'>Medical Report</textarea>
<!--
        <script>
            function Print(){
                window.print();
            }
            </script>
-->
	</div> 
	</form>
</body>
</html>