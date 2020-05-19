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
				<h2>Create a new User</h2>
					<form method = 'Post'>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="fullName">Full Name</label>
								<input type="text" id="fullName" name="fullName" class="form-control mb" required>
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
								<input type="date" id="DOB" name="DOB" class="form-control" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label for="email">Email</label>
								<input type="email" id="email" name="email" class="form-control mb" required>
							</div>
							<div class="col-md-6">
								<label for="telephone">Telephone</label>
								<input type="text" id="telephone" name="telephone" class="form-control" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6">
								<label for="username">Username</label>
								<input type="text" id="username" name="username" class="form-control mb" required>
							</div>
							<div class="col-md-6">
								<label for="password">Password</label>
								<input type="password" id="password" name="password" class="form-control" required>
							</div>
						</div>

						<div class="form-group text-center">
							<input type="submit" value="Create User" name="createDoctor" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>	
		</div>

		<?php
			if(isset($_POST['createDoctor'])) {
				$doctor = new User(0);
				$doctor->fullName = $_POST['fullName'];
				$doctor->DOB = $_POST['DOB'];
				$doctor->email = $_POST['email'];
				$doctor->telephone = $_POST['telephone'];
				$doctor->username = $_POST['username'];
				$doctor->password = sha1($_POST['password']);
				$doctor->userTypeID = $_POST['userType'];
				User::add($doctor);
				echo '<script>javascript:history.go(-2)</script>';
			}
		?>

	
	</div>

	<?php
		include '../footer.php';
	?>

	</body>
</html>

