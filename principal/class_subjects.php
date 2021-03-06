<?php
	define("ROW_PER_PAGE",2);
	session_start();
	require "../dao/UserDAO.php";
	$login = new UserDAO;
	$view = new UserDAO;

	$year = $_GET['year'];
	$year1 = $year-1;
	$levelId = $_GET['levelId'];
	$level = $_GET['level'];

	$info = $view->getClassSubjects($year, $levelId);

	if(!$login->log_test()){
		header('Location: ../index.php');
	} else {
		$name = $_SESSION['name'];
	}
	$_SESSION['page'] = "class";
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
	                        <h2 class="pull-left">View Subjects</h2>
                   		</div>
	                    <div>
	                    	<div class="container-fluid">
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-6">
										<div class="table-responsive">
											<h4 style="text-align: center"><?php echo $level; ?></h4>
											<h4 style="text-align: center"><?php echo 'SY: '.$year1.' - '.$year; ?></h4>
											<h5>Adviser: </h5>
											<table class="table table bordered">
												<tr>
													<th class="table-header" width="20%"> # </th>
													<th class="table-header">&nbsp;&nbsp;&nbsp;Subjects</th>
													<th style="text-align:center" class="table-header" width="25%">Action</th>
												</tr>
												<?php
													for($i=0; $i<count($info); $i++){
														$ctr = $i+1;
														if ($info[$i] != '0') {
															echo "
																<tr>
																	<td>".$ctr."</td>
																	<td>".$info[$i]."</td>
	      															<td style='text-align:center'><a data-toggle='modal' data-target='#editClassSubject' title='Edit'><span class='glyphicon glyphicon-edit'></span></a></td>
	      														</tr>
															";
														} else {
															echo "
																<tr>
																	<td style='text-align: center' colspan='3'> No Subjects Added </td>
																</tr>
															";
														}
													}
												?>
											</table>
										</div>	
										<div class="pull-right">
				                            <a  class="btn btn-primary" href="class.php">Back</a>
				                        </div>
				                    </div>
									<div class="col-sm-3">
										<?php
											if(count($info) < 8){
												echo '
													<div class="pull-right">
							                            <button class="btn btn-success" data-toggle="modal" data-target="#addClassSubject">Add Subject</button>
							                        </div>
												';
											}
										?>
									</div>
			                    </div>
								<?php 
									require "modal.php";
						        ?>
		                    </div>
	                    </div>
					</div>
                </div>
            </div>
        </div>
    </body>
</html>