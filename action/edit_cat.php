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
					<i class="fa fa-angle-right"></i> <a href="../category.php">Category</a>
					<i class="fa fa-angle-right"></i> <span>Edit Category</span>
				</h2>
			</div>
			<div class="clearfix"> </div>
			<!-- BreadCrum -->

			<br>
			
			<!-- Books , Users and Location Button -->
			<?php include("includes/info_grid.php") ?>
			<!-- //Books , Users and Location Button -->

			<div class="agile-grids">

				<a href="../Category.php"><button class="btn btn-warning"><i class="icon-angle-left icon-large"></i> Go Back</button></a>

				<br><br>

				<div class="form-title">
					<h4>Edit Category :</h4>
				</div>

				<?php
					$id = null;
					$cat_name = null;
					$shelf = null;

					if(isset($_POST["id"])){$id = $_POST["id"];}
					if(isset($_POST["cat_name"])){$cat_name = $_POST["cat_name"];}
					if(isset($_POST["shelf"])){$shelf = $_POST["shelf"];}

					if(isset($_POST['update'])){

						$update = "UPDATE category SET cat_name='$cat_name', shelf='$shelf' WHERE cat_id = $id ";
						
						$update_con = mysqli_query($connection, $update);

						if ($update_con) {
							echo "<br><div class=\"alert alert-success alert-dismissable\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<strong>Success!</strong><br/>Category updated successfully</div>";
						} else {
							echo "<br><div class=\"alert alert-error alert-dismissable\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<strong>Error!</strong><br/>Error in Connection</div>";
						}
					}
				?>
				<?php
					$get_id =$_GET['id'];
					$show = "SELECT * FROM category where cat_id = '$get_id' ";
					$showcase = mysqli_query($connection, $show);
					
					while ($row = mysqli_fetch_assoc($showcase)){
				?>

				<div class="form-body">
					<form class="form-horizontal" action="#" method="post">
						
						<div class="form-group"> 
							<label for="category Name" class="col-sm-2 control-label">Category</label> 
							<div class="col-sm-10">
								<input type="hidden" id="id" name="id" value="<?php echo $row['cat_id']; ?>" placeholder="Id" required>
								<input type="text" name="cat_name" class="form-control" value="<?php echo $row['cat_name']; ?>" id="category Name" placeholder="e.g Science, Arts" required> 
							</div>
						</div>

						<div class="form-group"> 
							<label for="Shelf Name" class="col-sm-2 control-label">Shelf</label> 
							<div class="col-sm-10"> 
								<input type="text" name="shelf" class="form-control" value="<?php echo $row['shelf']; ?>" id="Shelf Name" placeholder="e.g Shelf A, Shelf B" required> 
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