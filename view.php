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
					<i class="fa fa-angle-right"></i> <span>View History</span>
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

				<table id="example" class="table2">

					<thead>
						<tr>
							<th>I/D</th>
							<th>Fullname</th>
							<th>Title</th>
							<th>Book S/N</th>
							<th>Date Borrowed</th>
							<th>Date Due</th>
							<th>Date Returned</th>
						</tr>
					</thead>
					<tbody>
						<?php

							$show = "SELECT * FROM transaction";
							$showcase = mysqli_query($connection, $show);
							
							while ($row = mysqli_fetch_assoc($showcase)){

							$find_mem_id = "SELECT firstname,lastname FROM member WHERE member_id = {$row['member_id']}";
							$find_mem_id_code = mysqli_query($connection, $find_mem_id);
							$find_mem_id_res = mysqli_fetch_array($find_mem_id_code);

							$find_bk_id = "SELECT title FROM `book` WHERE book_id = {$row['book_id']}";
							$find_bk_id_code = mysqli_query($connection, $find_bk_id);
							$find_bk_id_res = mysqli_fetch_array ($find_bk_id_code);

							echo "
							<tr>
								<td> {$row['transaction_id']} </td>
								<td> {$find_mem_id_res['firstname']} {$find_mem_id_res['lastname']} </td>
								<td> {$find_bk_id_res['title']}</td> 
								<td> {$row['s_n']}</td>
								<td> {$row['date_borrowed']}</td>
								<td> {$row['date_due']}</td> 
								<td> {$row['date_returned']}</td> 
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
