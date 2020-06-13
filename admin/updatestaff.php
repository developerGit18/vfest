<?php
	define("ROW_PER_PAGE",2);
	session_start();
	require "../dao/UserDAO.php";
	$login = new UserDAO;
	$cat = "StudID";
	$view = new UserDAO;

  $info = $view->getstaffsInfo($_SESSION['id']);
  $data = $view->geteducbgInfo($_SESSION['id']);
  $for = $view->getSRInfo($_SESSION['id']);

	if(!$login->log_test()){
		header('Location: ../index.php');
	} else {
		$name = $_SESSION['name'];
	}
	$_SESSION['page'] = "home";
	$day = date("d");
	$month = date("m");
	$year = date("Y");
	$siblingCtr = 0;
?>
<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" href="../bootstrap/css/main.css">
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="../bootstrap/css/font-awesome.min.css">
		<link rel="stylesheet" href="../bootstrap/css/datepicker3.css">
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.js"></script>
		<script src="../bootstrap/js/bootstrap-datepicker.js"></script>
</head>
<body>
<form>
<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<form name="staff" method="post" action="staffget_info?func=editstaff">
						<div class="modal-header">
							<header align="center">
								<td><h3>TEACHERS AND STAFF PROFILE</h3></td>
								<h4>ELEMENTARY SCHOOL PERSONNEL</h4>
							</header>
						</div>
						<div>
							<table border='0' width='100%'>
								<tr height='10px'><td></td></tr>
								<tr>
									<th>Last Name:</th>
									<th width='10px'></th>
									<th>First Name:</th>
									<th width='10px'></th>
									<th>Middle Name:</th>
								</tr>
								<tr>
	                              	<td><input class="form-control" type='text' name='l_name' style="width: 80%;" value="<?php echo $info[0]; ?>"></td>
									<th width='5px'></th>
	                              	<td><input class="form-control" type='text' name='fname' style="width: 80%;" value="<?php echo $info[1]; ?>"></td>
									<th width='5px'></th>
	                              	<td><input class="form-control" size='10px' type='text' name='m_name' value="<?php echo $info[2]; ?>"></td>
								</tr>
								<tr>
									<th>Birthdate:</th>
									<th width='10px'></th>
									<th>Phone Number:</th>
									<th width='10px'></th>
								</tr>
								<tr>
		                            <td>
										<div class="input-group date" data-provide="datepicker" data-date-format='yyyy-mm-dd' data-date-todayHighlight=true data-date-autoclose=true >
										    <input type="text" class="form-control date-picker" id="date" name="sdob" value="<?php echo $year."-".$month."-".$day ?>" required>
										    <div class="input-group-addon">
										        <span class="glyphicon glyphicon-th"></span>
										    </div>
										</div>
		                            </td>
		                            <th width='10px'></th>
		                            <td><input class="form-control"  size='20px' type='text' name='phone'value="<?php echo $info[8]; ?>"></td>
								</tr>
								<tr>
									<th>Address:</th>
									<th width='5px'></th>
									<th>Gender</th>
									<th width='5px'></th>
									<th>Status:</th>
									<th width='5px'></th>

									
								</tr>
								<tr>
		                            <td><input class="form-control"  size='30px' type='text' name='shome_add' value="<?php echo $info[6]; ?>"></td>
		                            <th width='5px'></th>
									<td><input type="radio" id="male" name="gender"  value="<?php echo $info[4]; ?>"> Male
	 									 <input type="radio" id="female" name="gender" value="female"  value="<?php echo $info[4]; ?>"> Female
	  									<input type="radio" id="other" name="gender" value="other"  value="<?php echo $info[4]; ?>"> Other
									<th width='5px'></th>
					
									<td>
		                                <select class="form-control"  name='scivilstatus'  value="<?php echo $info[5]; ?>">
		                                	 <option></option>
		                                    <option>Single</option>
		                                    <option>Married</option>
		                                    <option>Live In</option>
		                                    <option>Widowed</option>
		                                    <option>Separate</option>
		                                </select> 
		                            </td>
								</tr>
								<tr>
									<th>Eligibility:</th>
									<th width='10px'></th>
								</tr>
								<tr>
								<td><input class="form-control"  size='50px' type='text' name='eligibility' value="<?php echo $info[7]; ?>"></td>
									<th width='10px'></th>
								</tr>
								
							</table>
							</form>
							<form name="educbg" method="post" action="staffget_info?func=editeducbg">
							<hr>
							<h4><b>Educational Background</b></h4> 
							<table border='1px'  width='100%'>
								<tr align='center'>
									<th width='15%' style='text-align: center'>Degree</th>
									<th width='35%' style='text-align: center'>School Graduated</th>
									<th width='15%' style='text-align: center'>Year Start</th>
									<th width='15%' style='text-align: center'>Year End</th>
									<th style='text-align: center' colspan='2'>Action</th>
								</tr>
								<tr align='center'>
									<td style='text-align: center'><input type="text" name="degree" size="20" value="<?php echo $data[0]; ?>"></td>
									<td style='text-align: center'><input type="text" name="scchool" size="50" value="<?php echo $data[1]; ?>"></td>
									<td style='text-align: center'><input type="text" name="yrstart" value="<?php echo $data[2]; ?>"></td>
									<td style='text-align: center'><input type="text" name="yrend" value="<?php echo $data[3]; ?>"></td>
									<td width='50px' style="text-align:center">
								     <a align='right' data-toggle='modal' data-target='#addEB'  class="glyphicon glyphicon-edit"></a>
								    </td>
								    <td width='50px' style="text-align:center">
								      <a id="delete" title="Delete"><span class="glyphicon glyphicon-remove"></span></a>
								    </td>
								</tr>
							</table>
							<button align='right' data-toggle='modal' data-target='#addEB' class="btn btn-primary">Add Educ. Background</button>
						</form>
						<form name="sr" method="post" action="staffget_info?func=editsr">
							<hr>
							<h4><b>Service Record</b></h4>
							<table border='1px'  width='100%'>
								<tr align='center'>
									<th width='15%' style='text-align: center'>Date Started</th>
									<th width='35%' style='text-align: center'>Position</th>
									<th width='35%' style='text-align: center'>Monthly Salary</th>
									<th style='text-align: center' colspan='2'>Action</th>
								</tr>
								<tr align='center'>
									<td style='text-align: center'><input type="text" name="date_started" value="<?php echo $for[0]; ?>"></td>
									<td style='text-align: center'><input type="text" size="50" name="position" value="<?php echo $for[1]; ?>"></td>
									<td style='text-align: center'><input type="text" name="monthly_salary" size="35" value="<?php echo $for[2]; ?>"></td>
									<td width='50px' style="text-align:center">
								      <a align='right' data-toggle='modal' data-target='#addSR'  class="glyphicon glyphicon-edit"></a>
								    </td>
								    <td width='50px' style="text-align:center">
								      <a id="delete" title="Delete"><span class="glyphicon glyphicon-remove"></span></a>
								    </td>
								</tr>
							</table> 
							<button align='right' data-toggle='modal' data-target='#addSR' class="btn btn-primary">Add Service Record</button>
							<hr><br>
							<div class="pull-right">
								<button type="submit" class="btn btn-success" name="updatestaff">Update Record</button>
	                            <a  class="btn btn-danger" href="staffs.php">Back</a>
	                        </div>
	                        <br><br><br><br>
						</div>
						<?php 
							require "modal.php";
				        ?>
				        <?php 
							require "updatemodal.php";
				        ?>
					</form>
				</div>
			</div>
		</div>
	</form>
</body>
</html>