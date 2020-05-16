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
					<i class="fa fa-angle-right"></i> <span>Return Book</span>
				</h2>
			</div>
			<div class="clearfix"></div>
			<!-- BreadCrum -->

			<br>
			
			<!-- Books , Users and Location Button -->
			<?php include("includes/info_grid.php") ?>
			<!-- //Books , Users and Location Button -->

			<div class="agile-grids">
				<div class="form-title">
					<h4>Return Book Form :</h4>
				</div>
				<div class="form-body">
					<?php
						
						if(isset($_POST['return'])){

							$firstname = null;
							$lastname = null;
							$title = null;
							$serialnumber = null;
							$datereturned = null;

							if(isset($_POST["firstname"])){$firstname = $_POST["firstname"];}
							if(isset($_POST["lastname"])){$lastname = $_POST["lastname"];}
							if(isset($_POST["title"])){$title = $_POST["title"];}
							if(isset($_POST["serialnumber"])){$serialnumber = $_POST["serialnumber"];}
							if(isset($_POST["datereturned"])){$datereturned = $_POST["datereturned"];}

							$get_mem_id = "SELECT member_id FROM member WHERE firstname = '$firstname' AND lastname = '$lastname'";
							$get_mem_id_code = mysqli_query($connection, $get_mem_id);
							$get_mem_id_res = mysqli_fetch_array($get_mem_id_code);

							$get_bk_id = "SELECT `book_id` FROM `book` WHERE title ='$title'";
							$get_bk_id_code = mysqli_query($connection, $get_bk_id);
							$get_bk_id_res = mysqli_fetch_array ($get_bk_id_code);

							$unique=  $get_bk_id_res['book_id'];

							$get_bk_mem_ids = "SELECT `member_id`,`book_id` FROM `transaction` WHERE `s_n` = $serialnumber AND date_returned='Book not Returned' AND book_id = $unique ";
							$get_bk_mem_ids_code = mysqli_query($connection, $get_bk_mem_ids);
							$get_bk_mem_ids_res = mysqli_fetch_array ($get_bk_mem_ids_code);

							$unique2= $get_bk_mem_ids_res['book_id'];
							$unique3= $get_bk_mem_ids_res['member_id'];

							if ( $get_bk_mem_ids_res['member_id'] == $get_mem_id_res['member_id']) {
								if ( $get_bk_mem_ids_res['book_id'] == $get_bk_id_res['book_id']) {

									$upd_allbook = "UPDATE `all_book` SET `status` = 'Available' WHERE `all_book`.`s/n` = $serialnumber";
									$upd_transaction = "UPDATE `transaction` SET `date_returned` = '$datereturned' WHERE `member_id`= $unique3 AND `book_id` = $unique2 ";

									$conn1 = mysqli_query($connection, $upd_allbook);
									$conn2 = mysqli_query($connection, $upd_transaction);

									if($conn1 and $conn2) {
										echo "<br><br><div class=\"alert alert-success alert-dismissable\">
										<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
										<strong>Success!</strong><br/>Book has been returned succesfully</div>";
									} else {
										echo "<br><br><div class=\"alert alert-danger alert-dismissable\">
										<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
										<strong>Error</strong><br>Operation was unsuccesfull</div>";
									}

								} else { 
									echo "<br><br><div class=\"alert alert-danger alert-dismissable\">
									<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
									<strong>Error</strong><br>This book has been deleted or is not borrowed</div>";
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
							<label for="Date Returned" class="col-sm-2 control-label">Date Returned</label> 
							<div class="col-sm-9"> 
								<input type="date" name="datereturned" class="form-control" id="Date Returned" placeholder="Date Returned" required> 
							</div> 
						</div>

						<div class="col-sm-offset-2"> 
							<button name="return" type="submit" class="btn btn-default w3ls-button">Return</button> 
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
