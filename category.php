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
					<i class="fa fa-angle-right"></i> <span>Category</span>
				</h2>
			</div>
			<div class="clearfix"> </div>
			<!-- //BreadCrum -->

			<br>
			
			<!-- Books , Users and category Button -->
			<?php include("includes/info_grid.php") ?>
			<!-- //Books , Users and category Button -->

			<div class="agile-grids">

				<style type="text/css">
					.comments-icon i.fa.fa-plus{
					font-size: 5em;
					color: #9DCBEF;
					}
				</style>

				<?php

					$error = "";
					$success= "";

					$cat_name = null;
					$shelf = null;
					
					if(isset($_POST["cat_name"])){$cat_name = $_POST["cat_name"];}
					if(isset($_POST["shelf"])){$shelf = $_POST["shelf"];}

					if(isset($_POST["submit"])){

						$add = "INSERT INTO category (cat_name,shelf) VALUES ('$cat_name','$shelf')";

						$addcategory = mysqli_query($connection, $add);

						if ($addcategory) {
							$success= "<div class=\"alert alert-success alert-dismissable\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<strong>Success!</strong><br/>New category created successfully</div>";
						} else {
							$error= "<div class=\"alert alert-error alert-dismissable\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<strong>Error!</strong><br/>Error</div>";
						}
					}
				?>

				<!-- Add category Button -->
				<?php echo "$success"; ?>
				<?php echo "$error"; ?>

				<a href="#" data-toggle="modal" data-target="#myModal">
				<div class="col-md-4 top-comment-grid">
					<div class="comments tweets">
						<div class="comments-icon">
							<i class="fa fa-plus"></i>
						</div>
						<div class="comments-info tweets-info">
							<h3>Add</h3>
							<a href="#">Category</a>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div></a>
				<div class="clearfix"> </div>
				<!-- Add category Button -->

				<!-- Add category Modal -->
				<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">

							<div class="modal-header">
								Add category 
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>	
							</div>

							<div class="modal-body">
								<div class="form-body">
									<form class="form-horizontal" action="#" method="post"> 

										<div class="form-group"> 
											<label for="category Name" class="col-sm-2 control-label">Category</label> 
											<div class="col-sm-10"> 
												<input type="text" name="cat_name" class="form-control" id="category Name" placeholder="e.g Science, Arts" required> 
											</div>
										</div>

										<div class="form-group"> 
											<label for="Shelf Name" class="col-sm-2 control-label">Shelf</label> 
											<div class="col-sm-10"> 
												<input type="text" name="shelf" class="form-control" id="Shelf Name" placeholder="e.g Shelf A, Shelf B" required> 
											</div>
										</div>

										<div class="col-sm-offset-2"> 
											<button name="submit" value="submit" type="submit" class="btn btn-default w3ls-button">Submit</button> 
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
				<!-- //Add category Modal -->
			</div>

			<div class="agile-grids col-md-12">
				<br>

				<table id="example" class="table2">
					<thead>
						<tr>
							<th>I/D</th>
							<th>Category</th>
							<th>Shelf</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$show = "SELECT * FROM category";
							$showcase = mysqli_query($connection, $show);
						
							while ($row = mysqli_fetch_assoc($showcase)){ echo "
						<tr>
							<td> {$row['cat_id']} </td>
							<td> {$row['cat_name']}</td>
							<td> {$row['shelf']}</td> 
							<td>
							<a title=\"Edit\" 	id=\"#\" href=\"action/edit_cat.php?id={$row['cat_id']}\" class=\"btn btn-success\"><i class=\"icon-pencil icon-large\"></i></a>
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
