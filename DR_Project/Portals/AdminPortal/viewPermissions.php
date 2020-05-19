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
					<br><br>
			<?php
					echo "
    					<form method='post' action=''>
				<table id = 'tbl' class = 'table table-striped table-light'>
				<thead>
					<tr>
						<th>Page Name</th>
						<th>UserType</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead><tbody>";
				$permissions = Permission::view(1);
				if($permissions){
					for($i=0;$i<sizeof($permissions);$i++)
					{
						$pageName = Link::view("ID=".$permissions[$i]->linkID);
						$userType = UserType::view("ID=".$permissions[$i]->userTypeID);
						echo "<tr>
							<td>".$pageName[0]->friendlyName."</td>
							<td>".$userType[0]->name."</td>
							<td><button type='submit' name='edit' value='".$permissions[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
							<td>
							<button id='delBtn' type='button' data-toggle='modal' data-target='#Modal' data-id='".$permissions[$i]->ID."'><i class = 'fa fa-trash' aria-hidden = 'true'></i></button>
							</td>
						</tr>";
					}
				}
				echo "</tbody>
				</table>
				</form><br>
				
				<div class='row form-group'>
					<div class='col-md-12'>
						<div class='form-group text-center'>
							<a href='http://localhost/DR_Project/Portals/AdminPortal/addPermission.php'><input type='submit' value='Add Permission' class='btn btn-primary'></a>
						</div>
					</div>
				</div>";

				if(isset($_POST['edit']))
				{
					$permission = new Permission($_POST['edit']);
					$_SESSION['edit'] = serialize($permission);
					echo "<script>window.location = 'http://localhost/DR_Project/Portals/AdminPortal/editPermission.php';</script>";
				}

			?>
				</div>
			</div>	
		</div>

		<script>
            $('#tbl').DataTable();
        </script>
	
	</div>



	<div class="portfolio-modal modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">
          <i class="fa fa-times" aria-hidden="true"></i>
          </span>
        </button>
      </div>
        <div class="modal-body text-center">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <!-- Portfolio Modal - Title -->
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" style="margin-left:-660px;">Are you sure?</h2>
                <br><br>
                <div class="row">
                  <div class="col-md-6 form-group">
                      <button class="btn btn-primary" onclick='func();' data-dismiss="modal" style="margin-left:-420px;">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        Yes
                      </button>
                  </div>
                  <div class="col-md-6 form-group">
                      <button class="btn btn-primary" data-dismiss="modal" style="margin-left:-920px;">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        No
                      </button>
                  </div>
                 </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
          $('#Modal').on('show.bs.modal', function (e) {
              window.rowid = $(e.relatedTarget).data('id');
          });
      });
        
    function func()
    {
      insertParam("id",rowid);  
      <?php
        if(!empty($_GET['id'])){
		  Permission::delete($_GET['id']);
          header('Location: ' . $_SERVER["HTTP_REFERER"] );
          exit;
        }
      ?>
    }
        
    function insertParam(key, value)
    {
      key = encodeURI(key); value = encodeURI(value);
      var kvp = document.location.search.substr(1).split('&');
      var i=kvp.length; var x; while(i--) 
      {
          x = kvp[i].split('=');
          if (x[0]==key)
          {
              x[1] = value;
              kvp[i] = x.join('=');
              break;
          }
      }
      if(i<0) {kvp[kvp.length] = [key,value].join('=');}
      document.location.search = kvp.join('&'); 
    }
  </script>

	<?php
		include '../footer.php';
	?>

	</body>
</html>
