<?php include("includes/connect.php");?>
<?php include("includes/functions.php");?>
<?php Confirm_Login() ?>

<!DOCTYPE html>

<!-- Links -->
<?php include("includes/head.php") ?>
<!-- Links -->

<body class="dashboard-page">
<div class="se-pre-con"></div>

	<!-- Website Links and Script -->
	<?php include("includes/sidebar.php") ?>
	<!-- //Website Links and Script -->

	<section class="wrapper scrollable">

		<!-- Website Title , Notification and Admin Image -->
		<?php include("includes/top_nav.php") ?>
		<!-- //Website Title , Notification and Admin Image -->

		<div class="main-grid">

			<!-- BreadCrum -->
			<div class="banner">
				<h2>
					<a href="home.html">Dashboard</a>
					<i class="fa fa-angle-right"></i> <span>User</span>
				</h2>
			</div>
			<div class="clearfix"> </div>
			<!--// BreadCrum -->

			<br>
			
			<!-- Books , Users and Location Button -->
			<?php include("includes/info_grid.php") ?>
			<!-- //Books , Users and Location Button -->

			<div class="agile-grids">

				<style type="text/css">
					.comments-icon i.fa.fa-plus{
					font-size: 5em;
					color: #6C8CD0;
					}
				</style>

				<?php

					$error = "";
					$success= "";

					$firstname = null;
					$lastname = null;
					$gender = null;
					$class = null;
					$classteacher = null;
					$contact = null;

					if(isset($_POST["firstname"])){$firstname = $_POST["firstname"];}
					if(isset($_POST["lastname"])){$lastname = $_POST["lastname"];}
					if(isset($_POST["gender"])){$gender = $_POST["gender"];}
					if(isset($_POST["class"])){$class = $_POST["class"];}
					if(isset($_POST["classteacher"])){$classteacher = $_POST["classteacher"];}
					if(isset($_POST["contact"])){$contact = $_POST["contact"];}

					if (isset($_POST['submit'])){

						$add = "INSERT INTO member(firstname,lastname,gender,class,class_teacher,contact,status) 
						VALUES ('$firstname','$lastname','$gender','$class','$classteacher','$contact','Active')";

						$addmember = mysqli_query($connection, $add);

						if ($addmember) {
							$success = "<div class=\"alert alert-success alert-dismissable\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<strong>Success!</strong><br/>New User created successfully</div>";
						} else {
							$error = "<div class=\"alert alert-error alert-dismissable\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<strong>Error!</strong><br/>Error in Connection</div>";
						}
					}
				?>

				<!-- Add User Button -->
				<?php echo "$success";?>
				<?php echo "$error";?>
				<a href="#" data-toggle="modal" data-target="#myModal">
				<div class="col-md-4 top-comment-grid">
					<div class="comments likes">
						<div class="comments-icon">
							<i class="fa fa-plus"></i>
						</div>
						<div class="comments-info likes-info">

							<h3>Add</h3>
							<a href="#">User</a>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div></a>
				<div class="clearfix"> </div>
				<!-- //Add User Button -->

				<!-- Add User Modal -->
				<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">

							<div class="modal-header">
								Add User
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>	
							</div>

							<div class="modal-body">
								<div class="form-body">
									<form class="form-horizontal" action="#" method="post">


										<div class="form-group"> 
											<label for="First Name" class="col-sm-3 control-label">First Name</label> 
											<div class="col-sm-9"> 
												<input type="text" name="firstname" class="form-control" id="First Name" placeholder="First Name" required> 
											</div>
										</div>

										<div class="form-group"> 
											<label for="Last Name" class="col-sm-3 control-label">Last Name</label> 
											<div class="col-sm-9"> 
												<input type="text" name="lastname" class="form-control" id="Last Name" placeholder="Last Name" required> 
											</div>
										</div>

										<div class="form-group">
											<label for="Gender" class="col-sm-2 control-label">Gender</label> 
											<div class="col-sm-10">
												<select name="gender" id="Gender" class="form-control" required>
													<option value="">Select Gender</option>
													<option value="Male">MALE</option>
													<option value="Female">FEMALE</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label for="Class" class="col-sm-2 control-label">Class</label> 
											<div class="col-sm-10">
												<select name="class" id="Class" class="form-control" required>
													<option value="">Choose a Class</option>
													<option value="JSS 1">JSS 1</option>
													<option value="JSS 2">JSS 2</option>
													<option value="JSS 3">JSS 3</option>
													<option value="SSS 1">SSS 1</option>
													<option value="SSS 2">SSS 2</option>
													<option value="SSS 3">SSS 3</option>
													<option value="Teacher">Teacher</option>
												</select>
											</div>
										</div>

										<div class="form-group"> 
											<label for="Classteacher" class="col-sm-3 control-label">Class Teacher</label> 
											<div class="col-sm-9"> 
												<input type="text" name="classteacher" class="form-control" id="Classteacher" placeholder="Class Teacher" required> 
											</div>
										</div>

										<div class="form-group"> 
											<label for="Phonenumber" class="col-sm-4 control-label">Phone Number</label> 
											<div class="col-sm-8">
												<input type='tel' name="contact" class="form-control" id="Phonenumber" pattern="[0-9]{11,11}" placeholder="Phone Number" autocomplete="off" maxlength="11" required>
											</div>
										</div>


										<div class="col-sm-offset-2"> 
											<button name="submit" value="submit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> Submit</button>
										</div>

									</form> 
								</div>
							</div>

							<div class="modal-footer">
								<button type="Cancel" class="btn btn-default" data-dismiss="modal">Cancel</button> 
							</div>
						</div>
					</div>
				</div>
				<!-- //Add User Modal -->
			</div>
			<div class="clearfix"> </div>

			<div class="agile-grids col-md-12">
				<br>

				<table id="example" class="table2">
					<thead>
						<tr>
							<th>I/D</th>
							<th>Name</th>
							<th>Gender</th>
							<th>Class</th>
							<th>Class teacher</th>
							<th>Contact</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$show = "SELECT * FROM member";
							$showcase = mysqli_query($connection, $show);
							
							while ($row = mysqli_fetch_assoc($showcase)){

								$id=$row['member_id'];

								echo "
						<tr>
							<td> $id </td>
							<td> {$row['firstname']} {$row['lastname']} </td>
							<td> {$row['gender']}</td> 
							<td> {$row['class']}</td>
							<td> {$row['class_teacher']}</td>
							<td> {$row['contact']}</td> 
							<td> {$row['status']}</td> 
							<td>
							<a title=\"Delete\" id=\"del$id\" data-toggle=\"modal\" href=\"#del_mem$id\" class=\"btn btn-danger\"><i class=\"icon-trash icon-large\"></i></a>
							<a title=\"Edit\" 	id=\"edit$id\" href=\"action/edit_user.php?id=$id\" class=\"btn btn-success\"><i class=\"icon-pencil icon-large\"></i></a>
							<!-- Modal -->
							<div id=\"del_mem$id\" class=\"modal fade\" role=\"dialog\">
								<div class=\"modal-dialog\">
									<!-- Modal content-->
									<div class=\"modal-content\">
										<div class=\"modal-body\">
											<p style=\"color:red; background:grey; padding:10px;\">Are you Sure you want to Delete this User?</p>
										</div>
										<div class=\"modal-footer\">
											<a class=\"btn btn-success\" href=\"action/del_mem.php?id=$id\"<i class=\"icon-check icon-large\"></i>&nbsp;Yes</a>
											<button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\"><i class=\"icon-remove icon-large\"></i>&nbsp;Close</button>
										</div>
									</div>
								</div>
							</div>
							</td>
						</tr>
						 ";}
						 ?>
					</tbody>
				</table>
			</div>
			<div class="clearfix"> </div>
		</div>

		<!-- Footer and Scripts -->
		<?php include("includes/footer.php") ?>
		<!-- //Footer and Scripts -->
</body>
</html>
