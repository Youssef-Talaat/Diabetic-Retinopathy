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
				<h2>Create a new UserType</h2>
					<form method = 'Post'>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="userTypeName">UserType Name</label>
								<input type="text" id="userTypeName" name="userTypeName" class="form-control mb" required>
							</div>
						</div>

						<div class="form-group text-center">
							<input type="submit" value="Create UserType" name="createUserType" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>	
		</div>

		<?php
			if(isset($_POST['createUserType'])) {
				$userType = new UserType(0);
				$userType->name = $_POST['userTypeName'];
				Admin::addUserType($userType);
				echo '<script>javascript:history.go(-2)</script>';
			}
		?>

	
	</div>

	<?php
		include '../footer.php';
	?>

	</body>
</html>

