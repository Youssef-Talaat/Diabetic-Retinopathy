<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<?php
ob_start();
session_start();
include '../../Classes/User.php';
include '../../Classes/Link.php';
include '../../Classes/UserType.php';
include "../../DatabaseFile/Database.php";
?>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Editable Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media='print' />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>

	<style>
		@page {margin:0 1cm}
		html {margin:0 0cm}

		.button {
			background-color: #F05908; /* Green */
			border: none;
			color: white;
			padding: 10px 45px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
		}


	</style>

</head>

<body>

	<form action='' method='post'>
	<div id='page-wrap'>

		<textarea id='header'>Medical Report</textarea>
		
		<div id='identity'>

            <div id='logo'>

              <div id='logoctr'>
                <a href='javascript:;' id='change-logo' title='Change logo'>Change Logo</a>
                <a href='javascript:;' id='save-logo' title='Save changes'>Save</a>
                |
                <a href='javascript:;' id='delete-logo' title='Delete logo'>Delete Logo</a>
                <a href='javascript:;' id='cancel-logo' title='Cancel changes'>Cancel</a>
              </div>

              <div id='logohelp'>
                <input id='imageloc' type='text' size='50' value='' /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id='image' src='images/logo.jpg' alt='logo' />
            </div>
		
		</div>
		
		<div style='clear:both'></div>
		
		<div id='customer'>

		<table id='vendorMeta'>
                <tr>
                    <td class='meta-head'>Patient Name</td>
                    <td><textarea>Ahmed Hossam</textarea></td>
                </tr>
                <tr>

                    <td class='meta-head'>Department</td>
                    <td><textarea id='department'>Ophthalmologist</textarea></td>
                </tr>
                <tr>
                    <td class='meta-head'>Job Name</td>
                    <td><textarea class='jobName'>CCTV</textarea></td>
                </tr>

            </table>

            <table id='meta'>
                <tr>
                    <td class='meta-head'>Doctor Name</td>
                    <td><textarea>Ahmed Khaled</textarea></td>
                </tr>
                <tr>

                    <td class='meta-head'>Date</td>
                    <td><textarea id='date'>December 15, 2019</textarea></td>
                </tr>
                <tr>
                    <td class='meta-head'>States</td>
                    <td><div class='due'>Issued</div></td>
                </tr>

            </table>
		
		</div>
		<br><br>
		
		<table id='items'>
		
		  <tr>
			  <th>#</th>
		      <th>Fundus Images</th>
		      <th>Description</th>
		      <th>Disease Level</th>
		      <th>Disease Stage</th>
		  </tr>
		  
		  <tr class='item-row'>
		  	  <td>1</td>
		      <td><img id='outputLeft' src='images/6_left.jpeg'/></td>
		      <td class='description'>Diabetic retinopathy can progress to this more severe type, known as 
				  proliferative diabetic retinopathy.</td>
		      <td><textarea>2</textarea></td>
		      <td><textarea>Moderate</textarea></td>
		  </tr>
		  
		  <tr class='item-row'>
		  	  <td>2</td>
		      <td><img id='outputLeft' src='images/6_right.jpeg'/></td>
		      <td class='description'>In this type, damaged blood vessels close off, causing the growth of new, abnormal 
				  blood vessels in the retina, and can leak into the clear, jelly-like substance that fills the center of your eye (vitreous).</td>
		      <td>2</td>
		      <td>Moderate</td>
		  </tr>
		
		</table>
		<br><br>
		
		<div id='terms'>
		  <h5>Notes</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
		<br>
	</div> 
	</form>

	
</body>
</html>