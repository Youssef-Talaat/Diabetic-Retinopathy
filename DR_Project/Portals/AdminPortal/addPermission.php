<?php
//ob_start();
session_start();
include '../../Classes/User.php';
include '../../Classes/Link.php';
include '../../Classes/UserType.php';
include '../../Classes/Permission.php';
include '../../DatabaseFile/Database.php';
include 'header.php';

?>
<!DOCTYPE HTML>
<html>

		<div class='container'>
			<div class='row'>
				<div class='col-md-12'>
				<h2>Create a new Permission</h2>
					<form method = 'Post'>
						<div class='row form-group'>
							<div class='col-md-6'>
								<label for='userTypeID'>UserType</label>
								<select id='userTypeID' name='userTypeID' class='form-control mb' required>
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
							<div class='col-md-6'>
							<label for='linkID'>Page Name</label>
								<select id='linkID' name='linkID' class='form-control mb' required>
									<?php
										$links = Link::view(1);
										for($i=0;$i<sizeof($links);$i++)
										{
											echo "
												<option value='".$links[$i]->ID."'>".$links[$i]->friendlyName."</option>
											";
										}
									?>
								</select>
							</div>
						</div>

						<div class='form-group text-center'>
							<input type='submit' value='Create Permission' name='createPermission' class='btn btn-primary'>
						</div>
					</form>
				</div>
			</div>	
		</div>

		<?php
			if(isset($_POST['createPermission'])) {
				$permission = new Permission(0);
				$permission->linkID = $_POST['linkID'];
				$permission->userTypeID = $_POST['userTypeID'];
				Permission::add($permission);
				echo "<script>javascript:history.go(-2)</script>";
			}
		?>

	
	</div>

	<?php
		include '../footer.php';
	?>
	
	</body>
</html>

