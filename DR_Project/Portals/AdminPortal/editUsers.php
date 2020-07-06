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
				<h2>Edit User Information</h2>
					<form method = 'Post'>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="fullName">Full Name</label>
								<input type="text" id="fullName" name="fullName" class="form-control mb" value="" required>
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
								<input type="date" id="DOB" name="DOB" class="form-control" value="" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label for="email">Email</label>
								<input type="email" id="email" name="email" class="form-control mb" value="" required>
							</div>
							<div class="col-md-6">
								<label for="telephone">Telephone</label>
								<input type="text" id="telephone" name="telephone" class="form-control" value="" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label for="username">Username</label>
								<input type="text" id="username" name="username" class="form-control mb" value="" required>
							</div>
							<div class="col-md-6">
								<label for="password">Password</label>
								<input type="password" id="password" name="password" class="form-control" value="">
							</div>
						</div>

						<div class="form-group text-center">
							<input type="submit" value="Edit User" name="EditUser" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>	
		</div>

		<?php
			if(isset($_POST['EditUser'])) {
				$user = new User(0);
                $user->ID = unserialize($_SESSION['edit'])->ID;
				$user->fullName = $_POST['fullName'];
				$user->DOB = $_POST['DOB'];
				$user->email = $_POST['email'];
				$user->telephone = $_POST['telephone'];
				$user->username = $_POST['username'];
                if(empty($_POST["password"])){
                    $user->password = unserialize($_SESSION['edit'])->password;
                }
                else{
                    $user->password = sha1($_POST['password']);
                }
				$user->userTypeID = $_POST['userType'];
				Admin::editUser($user);
				echo '<script>javascript:history.go(-2)</script>';
			}
		?>

	
	</div>
        
    <script>  
      document.getElementById('fullName').value = '<?php echo unserialize($_SESSION['edit'])->fullName; ?>';
      document.getElementById('DOB').value = '<?php echo unserialize($_SESSION['edit'])->DOB; ?>';
      document.getElementById('telephone').value = '<?php echo unserialize($_SESSION['edit'])->telephone; ?>';
      document.getElementById('email').value = '<?php echo unserialize($_SESSION['edit'])->email; ?>';
      document.getElementById('username').value = '<?php echo unserialize($_SESSION['edit'])->username; ?>';
      document.getElementById('userType').value = '<?php echo unserialize($_SESSION['edit'])->userTypeID->ID; ?>';
    </script>
	
	<?php
		include '../footer.php';
	?>

	</body>
</html>

