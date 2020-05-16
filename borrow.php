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
					<a href="home.html">Dashboard</a>
					<i class="fa fa-angle-right"></i> <span>Borrow Book</span>
				</h2>
			</div>
			<div class="clearfix"> </div>
			<!-- BreadCrum -->

			<br>
			
			<!-- Books , Users and Location Button -->
			<?php include("includes/info_grid.php") ?>
			<!-- //Books , Users and Location Button -->

			<div class="agile-grids">
				<div class="form-title">
					<h4>Borrow Book Form :</h4>
				</div>
				<div class="form-body">
					<?php
						$firstname = null;
						$lastname = null;
						$title = null;
						$serialnumber = null;
						$dateborrowed = null;
						$datedue = null;

						if(isset($_POST["firstname"])){$firstname = $_POST["firstname"];}
						if(isset($_POST["lastname"])){$lastname = $_POST["lastname"];}
						if(isset($_POST["title"])){$title = $_POST["title"];}
						if(isset($_POST["serialnumber"])){$serialnumber = $_POST["serialnumber"];}
						if(isset($_POST["dateborrowed"])){$dateborrowed = $_POST["dateborrowed"];}
						if(isset($_POST["datedue"])){$datedue = $_POST["datedue"];}

						if (isset($_POST['borrow'])){

							$check_user = "SELECT status FROM member WHERE firstname = '$firstname' AND lastname = '$lastname'";
							$check_user_code = mysqli_query($connection, $check_user);
							$check_user_res = mysqli_fetch_array($check_user_code);

							$check_mem_id = "SELECT member_id FROM member WHERE firstname = '$firstname' AND lastname = '$lastname'";
							$check_mem_id_code = mysqli_query($connection, $check_mem_id);
							$check_mem_id_res = mysqli_fetch_array($check_mem_id_code);

							$member_id = $check_mem_id_res['member_id'];

							if ($check_user_res['status'] == 'Active'){

								$check_book = "SELECT status,bk_cond FROM `all_book` WHERE `s/n` = $serialnumber AND title='$title'";
								$check_book_code = mysqli_query($connection, $check_book);
								$check_book_res = mysqli_fetch_array ($check_book_code);

								$check_bk_id = "SELECT book_id FROM `book` WHERE title ='$title'";
								$check_bk_id_code = mysqli_query($connection, $check_bk_id);
								$check_bk_id_res = mysqli_fetch_array ($check_bk_id_code);

								$book_id = $check_bk_id_res ['book_id'];

								if ( $check_book_res['bk_cond'] == 'Ready') {

									if ($check_book_res ['status'] == 'Available'){

										if (($username != null ) && ($title != null) && ($dateborrowed != null) && ($datedue != null)){

											$ins_transaction = "INSERT INTO transaction(member_id,book_id,s_n,date_borrowed,date_due,date_returned) 
											VALUES ('$member_id','$book_id','$serialnumber','$dateborrowed','$datedue','Book not Returned')";

											$upd_allbook = "UPDATE `all_book` SET `status` = 'Unavailable' WHERE `all_book`.`s/n` = $serialnumber";

											$conn2 = mysqli_query($connection, $ins_transaction);
											$conn1 = mysqli_query($connection, $upd_allbook);

											if($conn2 and $conn1) {
												echo "<br><br><div class=\"alert alert-success alert-dismissable\">
												<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
												<strong>Success!</strong><br/>Book has been borrowed succesfully</div>";
											} else {
												echo "<br><br><div class=\"alert alert-danger alert-dismissable\">
												<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
												<strong>Error</strong><br>Operation was unsuccesfull</div>";
											}
										}
									} else {
										echo "<br><br><div class=\"alert alert-danger alert-dismissable\">
										<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
										<strong>Error</strong><br>This book has been borrowed</div>";
									}
								} else {
									echo "<br><br><div class=\"alert alert-danger alert-dismissable\">
									<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
									<strong>Error</strong><br>This book does not exist</div>";
								}
							} else {
								echo "<br><br><div class=\"alert alert-danger alert-dismissable\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<strong>Error</strong><br>This user does not exist or has been disabled</div>";
							}
						}
					?>
					<form class="form-horizontal" action="#" method="post">

						<div class="form-group"> 
							<label for="Firstname" class="col-sm-2 control-label">Firstname</label> 
							<div class="col-sm-9"> 
								<input list="firstname" type="text" name="firstname" class="form-control" id="Firstname" placeholder="Firstname" required>
								<datalist id="firstname">
									<?php 
										$get_mem = "SELECT * FROM `member`";
										$run_mem = mysqli_query($connection, $get_mem);

										while ($row_mem = mysqli_fetch_assoc($run_mem)){ echo "
											<option value=\"{$row_mem['firstname']}\">
										";}
									?>
								</datalist>
							</div>
						</div>

						<div class="form-group"> 
							<label for="Lastname" class="col-sm-2 control-label">Lastname</label> 
							<div class="col-sm-9"> 
								<input list="lastname" type="text" name="lastname" class="form-control" id="Lastname" placeholder="Lastname" required>
								<datalist id="lastname">
									<?php 
										$get_mem = "SELECT * FROM `member`";
										$run_mem = mysqli_query($connection, $get_mem);

										while ($row_mem = mysqli_fetch_assoc($run_mem)){ echo "
											<option value=\"{$row_mem['lastname']}\">
										";}
									?>
								</datalist> 
							</div>
						</div>

						<div class="form-group"> 
							<label for="Book Title" class="col-sm-2 control-label">Book Title</label> 
							<div class="col-sm-9"> 
								<input list="title" type="text" name="title" class="form-control" id="Book Title" placeholder="Book Title" required>
								<datalist id="title">
									<?php 
										$get_title = "SELECT * FROM `book`";
										$run_title = mysqli_query($connection, $get_title);

										while ($row_title = mysqli_fetch_assoc($run_title)){ echo "
											<option value=\"{$row_title['title']}\">
										";}
									?>
								</datalist>
							</div> 
						</div>

						<div class="form-group"> 
							<label for="Serial Number" class="col-sm-2 control-label">Serial Number</label> 
							<div class="col-sm-9"> 
								<input type="Number" name="serialnumber" class="form-control" id="Serial Number" placeholder="Serial Number" required> 
							</div> 
						</div>

						<div class="form-group"> 
							<label for="Date Borrowed" class="col-sm-2 control-label">Date Borrowed</label> 
							<div class="col-sm-9"> 
								<input type="date" name="dateborrowed" class="form-control" id="Date Borrowed" placeholder="Date Borrowed" required> 
							</div> 
						</div>

						<div class="form-group"> 
							<label for="Due Date" class="col-sm-2 control-label">Due Date</label> 
							<div class="col-sm-9"> 
								<input type="date" name="datedue" class="form-control" id="Due Date" placeholder="Due Date" required> 
							</div> 
						</div>

						<div class="col-sm-offset-2"> 
							<button name="borrow" type="submit" class="btn btn-default w3ls-button">Borrow</button> 
						</div> 
					</form>
				</div>
			</div>
		</div>

		<!-- Footer and Scripts -->
		<?php include("includes/footer.php") ?>
		<!-- //Footer and Scripts -->
</body>
</html>
