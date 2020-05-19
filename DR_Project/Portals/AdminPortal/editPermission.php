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

		<div class="container">
			<div class="row">
				<div class="col-md-12">
				<h2>Update a Permission</h2>
					<form method = 'Post'>
						<div class="row form-group">
							<div class="col-md-6">
								<label for="userTypeID">UserType</label>
								<select id="userTypeID" name="userTypeID" class="form-control mb" required>
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
							<label for="linkID">Page Name</label>
								<select id="linkID" name="linkID" class="form-control mb" required>
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

						<div class="form-group text-center">
							<input type="submit" value="Update Permission" name="editPermission" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>	
		</div>

		<?php
			if(isset($_POST['editPermission'])) {
				$permission = new Permission(0);
                $permission->ID = unserialize($_SESSION['edit'])->ID;
				$permission->linkID = $_POST['linkID'];
				$permission->userTypeID = $_POST['userTypeID'];
				Permission::update($permission);
				echo '<script>javascript:history.go(-2)</script>';
			}
		?>

	<script>  
      document.getElementById('linkID').value = '<?php echo unserialize($_SESSION['edit'])->linkID; ?>';
      document.getElementById('userTypeID').value = '<?php echo unserialize($_SESSION['edit'])->userTypeID; ?>';
    </script>
	
	</div>

	<?php
		include '../footer.php';
	?>

	</body>
</html>

