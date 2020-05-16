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
					<i class="fa fa-angle-right"></i> <span>Search</span>
				</h2>
			</div>
			<div class="clearfix"> </div>
			<!-- BreadCrum -->

			<br>
			
			<!-- Books , Users and Location Button -->
			<?php include("includes/info_grid.php") ?>
			<!-- //Books , Users and Location Button -->

			<div class="agile-grids col-md-12">
				<br>

				<table id="table">
					<thead>
						<tr>
							<th>I/D</th>
							<th>Book Title</th>
							<th>Author</th>
							<th>No. of Copies</th>
							<th>No. of Pages</th>
							<th>Category</th>
							<th>Shelf</th>
							<th>Book Condition</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php

							$s=$_GET['search'];
							
							$show = "SELECT * FROM book WHERE title ='$s' ";
							$showcase = mysqli_query($connection, $show);

							while ($row = mysqli_fetch_assoc($showcase)){

							$count_copies = "SELECT COUNT(*) FROM `all_book` WHERE title ='{$row['title']}' AND author = '{$row['author']}' AND bk_cond='Ready'";
							$count_copies_code = mysqli_query($connection, $count_copies);
							$count_copies_get = mysqli_fetch_array ($count_copies_code);
							$count_copies_res =array_shift($count_copies_get);

							$find_cat_id = "SELECT cat_name,shelf FROM `category` WHERE cat_id = {$row['category_id']}";
							$find_cat_id_code = mysqli_query($connection, $find_cat_id);
							$find_cat_id_res = mysqli_fetch_array ($find_cat_id_code);

							$id=$row['book_id'];

							echo "
							<tr>
								<td> $id </td>
								<td> {$row['title']}</td>
								<td> {$row['author']}</td> 
								<td> $count_copies_res </td>
								<td> {$row['pages']}</td>
								<td> {$find_cat_id_res['cat_name']}</td>
								<td> {$find_cat_id_res['shelf']}</td>
								<td> {$row['bk_cond']}</td>
								<td>
								<a title=\"Delete\" href=\"del_book.php?id=$id\" class=\"btn btn-danger\"><i class=\"icon-trash icon-large\"></i></a>
								<a title=\"Edit\" href=\"edit_book.php?id=$id\" class=\"btn btn-success\"><i class=\"icon-pencil icon-large\"></i></a>
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