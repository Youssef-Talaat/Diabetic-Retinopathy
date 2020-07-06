<?php
//ob_start();
session_start();
include '../../Classes/User.php';
include '../../Classes/Link.php';
include '../../Classes/Admin.php';
include '../../Classes/UserType.php';
include '../../DatabaseFile/Database.php';
include 'header.php';


?>
<!DOCTYPE HTML>
<html>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
				<h2>Edit UserType</h2>
					<form method = 'Post'>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="userTypeName">UserType Name</label>
								<input type="text" id="userTypeName" name="userTypeName" class="form-control mb" required>
							</div>
						</div>

						<div class="form-group text-center">
							<input type="submit" value="Update UserType" name="EditUserType" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>	
		</div>

		<?php
			if(isset($_POST['EditUserType'])) {
				$usertype = new UserType(0);
                $usertype->ID = unserialize($_SESSION['edit'])->ID;
				$usertype->name = $_POST['userTypeName'];
				Admin::editUserTypes($usertype);
				echo '<script>javascript:history.go(-2)</script>';
			}
		?>

	
	</div>
        
    <script>  
      document.getElementById('userTypeName').value = '<?php echo unserialize($_SESSION['edit'])->name; ?>';
    </script>
	
	<?php
		include '../footer.php';
	?>

	</body>
</html>

