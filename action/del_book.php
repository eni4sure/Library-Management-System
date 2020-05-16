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
					<i class="fa fa-angle-right"></i> <a href="../books.php">Book</a>
					<i class="fa fa-angle-right"></i> <span>Delete Book</span>
				</h2>
			</div>
			<div class="clearfix"> </div>
			<!-- BreadCrum -->

			<br>
			
			<!-- Books , Users and Location Button -->
			<?php include("includes/info_grid.php") ?>
			<!-- //Books , Users and Location Button -->

			<div class="agile-grids">

				<a href="../books.php"><button class="btn btn-warning"><i class="icon-angle-left icon-large"></i> Go Back</button></a>

				<br><br>

				<div class="form-title">
					<h4>Edit Book :</h4>
				</div>

				<?php

				$sn=null;
				if(isset($_POST["sn"])){$sn = $_POST["sn"];}

				if (isset($_POST["delete"])){
					$check_status = "SELECT `status` FROM all_book WHERE `s/n`= $sn ";
					$check_status_code = mysqli_query($connection, $check_status);
					$check_status_res = mysqli_fetch_array($check_status_code);

					if ($check_status_res['status'] == 'Available'){

						$delete_book = "UPDATE all_book SET bk_cond='Deleted' WHERE `s/n`='$sn' ";
						$delete_book_con = mysqli_query($connection, $delete_book);

						if($delete_book_con) {
							echo "<br><br><div class=\"alert alert-success alert-dismissable\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<strong>Success!</strong><br/>Book has been deleted succesfully</div>";
						} else {
							echo "<br><br><div class=\"alert alert-danger alert-dismissable\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<strong>Error</strong><br>Operation was unsuccesfull</div>";
						}

					} else {
						echo "<br><br><div class=\"alert alert-danger alert-dismissable\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<strong>Error</strong><br>This book has been borrowed</div>";
					}
				}

				?>

				<div class="form-body">
					<form class="form-horizontal" action="#" method="post">

						<div class="form-group"> 
							<label for="Book S/N" class="col-sm-2 control-label">Book S/N</label> 
							<div class="col-sm-10"> 
								<input type="number" name="sn" class="form-control" id="Book S/N" placeholder="Specify the book Serial Number"> 
							</div>
						</div>

						<div class="col-sm-offset-2"> 
							<button name="delete" value="delete" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> Delete</button>
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