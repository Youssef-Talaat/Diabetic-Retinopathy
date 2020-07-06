<?php
//ob_start();
session_start();
include '../../Classes/User.php';
include '../../Classes/Link.php';
include '../../Classes/UserType.php';
include '../../Classes/Doctor.php';
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
						<th>FullName</th>
						<th>DOB</th>
						<th>Type</th>
						<th></th>
						<th></th>
					</tr>
				</thead><tbody>";
        $patients = Doctor::viewPatients("UserTypeID = 2");
				if($patients){
					for($i=0;$i<sizeof($patients);$i++)
					{
						echo "<tr>
							<td>".$patients[$i]->fullName."</td>
							<td>".$patients[$i]->DOB."</td>
							<td>".$patients[$i]->userTypeID->name."</td>
							<td align='center'><button type='submit' name='uploadImage' value='".$patients[$i]->ID."' class='btn btn-primary'>Upload Image</button></td>
							<td align='center'><button type='submit' name='viewReports' value='".$patients[$i]->ID."' class='btn btn-primary'>View all Reports</button></td>
						</tr>";
					}
				}
				echo "</tbody>
				</table>
				</form><br>";
				

				if(isset($_POST['uploadImage']))
				{
					$patient = new User($_POST['uploadImage']);
					$_SESSION['patientID'] = serialize($patient);
					echo "<script>window.location = 'http://localhost/DR_Project/Portals/DoctorPortal/uploadImage.php';</script>";
				}

				if(isset($_POST['viewReports']))
				{
					$patient = new User($_POST['viewReports']);
					$_SESSION['patientID'] = serialize($patient);
					echo "<script>window.location = 'http://localhost/DR_Project/Portals/DoctorPortal/viewPatientReports.php';</script>";
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
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Are you sure?</h2>
                <br><br>
                <div class="row">
                  <div class="col-md-6 form-group">
                      <button class="btn btn-primary" onclick='func();' data-dismiss="modal">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        Yes
                      </button>
                  </div>
                  <div class="col-md-6 form-group">
                      <button class="btn btn-primary" data-dismiss="modal">
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
          User::delete($_GET['id']);
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

