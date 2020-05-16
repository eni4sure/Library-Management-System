<?php include("includes/connect.php"); ?>
<?php include("includes/functions.php"); ?>
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
					<a href="../home.php">Dashboard</a>
					<i class="fa fa-angle-right"></i> <a href="../users.php">User</a>
					<i class="fa fa-angle-right"></i> <span>Edit User</span>
				</h2>
			</div>
			<div class="clearfix"> </div>
			<!-- BreadCrum -->

			<br>
			
			<!-- Books , Users and Location Button -->
			<?php include("includes/info_grid.php") ?>
			<!-- //Books , Users and Location Button -->

			<div class="agile-grids">

				<a href="../users.php"><button class="btn btn-warning"><i class="icon-angle-left icon-large"></i> Go Back</button></a>

				<br><br>

				<div class="form-title">
					<h4>Edit User :</h4>
				</div>

				<?php
					$id = null;
					$firstname = null;
					$lastname = null;
					$gender = null;
					$class = null;
					$classteacher = null;
					$contact = null;
					$status = null;

					if(isset($_POST["id"])){$id = $_POST["id"];}
					if(isset($_POST["firstname"])){$firstname = $_POST["firstname"];}
					if(isset($_POST["lastname"])){$lastname = $_POST["lastname"];}
					if(isset($_POST["gender"])){$gender = $_POST["gender"];}
					if(isset($_POST["class"])){$class = $_POST["class"];}
					if(isset($_POST["classteacher"])){$classteacher = $_POST["classteacher"];}
					if(isset($_POST["contact"])){$contact = $_POST["contact"];}
					if(isset($_POST["status"])){$status = $_POST["status"];}


					if(isset($_POST['update'])){

						$update = "UPDATE member SET firstname='$firstname',lastname='$lastname',gender='$gender',class='$class',class_teacher='$classteacher',contact='$contact',status='$status' WHERE member_id='$id'";
						
						$update_con = mysqli_query($connection, $update);

						if ($update_con) {
							echo "<br><div class=\"alert alert-success alert-dismissable\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<strong>Success!</strong><br/>User updated successfully</div>";
						} else {
							echo "<br><div class=\"alert alert-error alert-dismissable\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<strong>Error!</strong><br/>Error in Connection</div>";
						}
					}
				?>
				<?php
					$get_id =$_GET['id'];
					$show = "SELECT * FROM member where member_id = '$get_id' ";
					$showcase = mysqli_query($connection, $show);
					
					while ($row = mysqli_fetch_assoc($showcase)){
				?>

				<div class="form-body">
					<form class="form-horizontal" action="#" method="post">
						
						<div class="form-group"> 
							<label for="First Name" class="col-sm-2 control-label">First Name</label> 
							<div class="col-sm-10">
								<input type="hidden" id="id" name="id" value="<?php echo $row['member_id']; ?>" placeholder="Id" required>
								<input type="text" name="firstname" class="form-control" value="<?php echo $row['firstname']; ?>" id="First Name" placeholder="New First Name" required> 
							</div>
						</div>

						<div class="form-group"> 
							<label for="Last Name" class="col-sm-2 control-label">Last Name</label> 
							<div class="col-sm-10"> 
								<input type="text" name="lastname" class="form-control" value="<?php echo $row['lastname']; ?>" id="Last Name" placeholder="New Last Name" required> 
							</div>
						</div>

						<div class="form-group">
							<label for="Gender" class="col-sm-2 control-label">Gender</label> 
							<div class="col-sm-10">
								<select name="gender" id="Gender" class="form-control" required>
									<option value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
									<option value="Male">MALE</option>
									<option value="Female">FEMALE</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="Class" class="col-sm-2 control-label">Class</label> 
							<div class="col-sm-10">
								<select name="class" id="Class" class="form-control" required>
									<option value="<?php echo $row['class']; ?>"><?php echo $row['class']; ?></option>
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
							<label for="Classteacher" class="col-sm-2 control-label">Class Teacher</label> 
							<div class="col-sm-10"> 
								<input type="text" name="classteacher" class="form-control" value="<?php echo $row['class_teacher']; ?>" id="Classteacher" placeholder="New Class Teacher" required> 
							</div>
						</div>

						<div class="form-group"> 
							<label for="Phonenumber" class="col-sm-2 control-label">Phone Number</label> 
							<div class="col-sm-10">
								<input type='tel' name="contact" class="form-control" value="<?php echo $row['contact']; ?>" id="Phonenumber" pattern="[0-9]{11,11}" placeholder="New Phone Number" autocomplete="off" maxlength="11" required>
							</div>
						</div>

						<div class="form-group"> 
							<label for="Status" class="col-sm-2 control-label">Status</label> 
							<div class="col-sm-10"> 
								<select name="status" id="Status" class="form-control" required>
									<option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>
									<option value="Active">Active</option>
									<option value="Diasbled">Diasbled</option>
								</select>
							</div>
						</div>

						<div class="col-sm-offset-2"> 
							<button name="update" value="update" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> Update</button>
						</div>

					</form>
				</div>
				<?php } ?>
			</div>
		</div>

		<!-- Footer and Scripts -->
		<?php include("includes/footer.php") ?>
		<!-- //Footer and Scripts -->
</body>
</html>