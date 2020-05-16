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
					<a href="home.php">Dashboard</a>
					<i class="fa fa-angle-right"></i> <span>View Book S/N</span>
				</h2>
			</div>
			<div class="clearfix"> </div>
			<!-- //BreadCrum -->

			<br>
			
			<!-- Books , Users and Location Button -->
			<?php include("includes/info_grid.php") ?>
			<!-- //Books , Users and Location Button -->

			<div class="agile-grids col-md-12">
				<br>

				<table id="example" class="table2">
					<thead>
						<tr>
							<th>S/N</th>
							<th>Book Title</th>
							<th>Category</th>
							<th>Date added</th>
							<th>Book Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$show = "SELECT * FROM all_book";
							$showcase = mysqli_query($connection, $show);
						
							while ($row = mysqli_fetch_assoc($showcase)){

								$find_cat_id = "SELECT cat_name FROM `category` WHERE cat_id = {$row['category_id']}";
								$find_cat_id_code = mysqli_query($connection, $find_cat_id);
								$find_cat_id_res = mysqli_fetch_array ($find_cat_id_code);

							echo "
						<tr>
							<td> {$row['s/n']} </td>
							<td> {$row['title']}</td>
							<td> {$find_cat_id_res['cat_name']}</td>
							<td> {$row['dateadded']}</td> 
							<td> {$row['bk_cond']}</td> 
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
