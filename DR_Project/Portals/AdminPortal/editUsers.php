<?php
//ob_start();
session_start();
include '../../Classes/User.php';
include '../../Classes/Link.php';
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
							<input type="submit" value="Edit User" name="EditDoctor" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>	
		</div>

		<?php
			if(isset($_POST['EditDoctor'])) {
				$doctor = new User(0);
                $doctor->ID = unserialize($_SESSION['edit'])->ID;
				$doctor->fullName = $_POST['fullName'];
				$doctor->DOB = $_POST['DOB'];
				$doctor->email = $_POST['email'];
				$doctor->telephone = $_POST['telephone'];
				$doctor->username = $_POST['username'];
                if(empty($_POST["password"])){
                    $doctor->password = unserialize($_SESSION['edit'])->password;
                }
                else{
                    $doctor->password = sha1($_POST['password']);
                }
				$doctor->userTypeID = $_POST['userType'];
				User::update($doctor);
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

