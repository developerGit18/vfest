<?php
	define("ROW_PER_PAGE",2);
	session_start();
	require "../dao/UserDAO.php";
	$login = new UserDAO;

	if(!$login->log_test()){
		header('Location: ../index.php');
	} else {
		$name = $_SESSION['name'];
	}
	$_SESSION['page'] = "staffs";
?>

<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" href="../bootstrap/css/main.css">
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="../bootstrap/css/font-awesome.min.css">
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.js"></script>
    </head>
    <body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3">
					<div style="margin-left: -15px">
						<?php require ('home_sidebar.php');?>
					</div>
				</div>
				<div class="col-sm-9">
					<div class="main-body">
						<div class="page-header clearfix">
	                        <h2 class="pull-left">School Staffs</h2>
	                        <div class="pull-right">
	                             <a  class="btn btn-success" href="addstaff.php">Add New Staff</a>
	                        </div>
                   		</div>
	                    <div>
	                        <form name='frmSearch' action='' method='post'>
	                            <input type="text" name="search_text" id="search_text" placeholder="Enter Staff's Last name or First name" class="form-control" />
	                            <br/>
	                            <div id="result"></div>
	                        </form>
	                    </div>
					</div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function(){
         load_data();

         function load_data(query)
         {
              $.ajax({
                   url:"fetch_staffs.php",
                   method:"POST",
                   data:{query:query},
                   success:function(data)
                   {
                    $('#result').html(data);
                   }
              });
        }
        $('#search_text').keyup(function(){
              var search = $(this).val();
              if(search != '')
              {
                load_data(search);
              }
              else
              {
                load_data();
              }
        });
    });
</script>