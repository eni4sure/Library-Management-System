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
					<i class="fa fa-angle-right"></i> <span>Book</span>
				</h2>
			</div>
			<div class="clearfix"> </div>
			<!-- //BreadCrum -->

			<br>
			
			<!-- Books , Users and Location Button -->
			<?php include("includes/info_grid.php") ?>
			<!-- //Books , Users and Location Button -->

			<div class="agile-grids">

				<style type="text/css">
					.comments-icon i.fa.fa-plus{
					font-size: 5em;
					color: #FDA285
					}
				</style>

				<?php

					$error = "";
					$success= "";

					$author = null;
					$title = null;
					$copies = null;
					$pages = null;
					$location = null;

					if(isset($_POST["title"])){$title = $_POST["title"];}
					if(isset($_POST["author"])){$author = $_POST["author"];}
					if(isset($_POST["copies"])){$copies = $_POST["copies"];}
					if(isset($_POST["pages"])){$pages = $_POST["pages"];}
					if(isset($_POST["category"])){$category_id = $_POST["category"];}
			
					if(isset($_POST['submit'])){
						$count = 0;
						while($count < $copies){ 
							$ins_allbook = "INSERT INTO all_book( title,author,pages,dateadded,status,category_id,bk_cond) 
							VALUES ('$title','$author','$pages',now(),'Available','$category_id','Ready')";
							$ins_allbook_code = mysqli_query($connection, $ins_allbook);
							$count++;
						}

						$ins_book = "INSERT INTO book(title,author,pages,category_id,dateadded,bk_cond) 
						VALUES ('$title','$author','$pages','$category_id',now(),'Ready')";
						$ins_book_code = mysqli_query($connection, $ins_book);

						if($ins_book_code) {
								echo "<div class=\"alert alert-success alert-dismissable\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<strong>Success!</strong><br/>New book created successfully! The serial numbers of $title are ";

								$find_bk_sn = "SELECT `s/n` FROM `all_book` WHERE title ='$title'";
								$find_bk_sn_code = mysqli_query($connection, $find_bk_sn);

								while($find_bk_sn_res = mysqli_fetch_assoc($find_bk_sn_code)){
									echo "<strong>{$find_bk_sn_res['s/n']}, </strong>";
								}
								echo "</div>";
						} else {
							$error= "<div class=\"alert alert-error alert-dismissable\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<strong>Error!</strong><br/>Error</div>";
						}
					}
				?>

				<!-- Add Book Button -->
				<?php echo "$success"; ?>
				<?php echo "$error"; ?>

				<a href="#" data-toggle="modal" data-target="#myModal">
				<div class="col-md-4 top-comment-grid">
					<div class="comments">
						<div class="comments-icon">
							<i class="fa fa-plus"></i>
						</div>
						<div class="comments-info">
							<h3>Add</h3>
							<a href="#">Book</a>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div></a>
				<div class="clearfix"> </div>
				<!-- Add Book Button -->

				<!-- Add Book Modal -->
				<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">

							<div class="modal-header">
								Add Book
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>	
							</div>

							<div class="modal-body">
								<div class="form-body">
									<form class="form-horizontal" action="#" method="post">

										<div class="form-group"> 
											<label for="Title" class="col-sm-2 control-label">Title</label> 
											<div class="col-sm-10"> 
												<input type="text" name="title" class="form-control" id="Title" placeholder="Book Title" required> 
											</div>
										</div>

										<div class="form-group"> 
											<label for="Author" class="col-sm-2 control-label">Author</label> 
											<div class="col-sm-10"> 
												<input type="text" name="author" class="form-control" id="Author" placeholder="Author" required> 
											</div>
										</div>

										<div class="form-group"> 
											<label for="Number of books" class="col-sm-4 control-label">Number of Copies</label> 
											<div class="col-sm-8"> 
												<input type="number" name="copies" class="form-control" id="Number of books" placeholder="Number of books" required> 
											</div>
										</div>

										<div class="form-group"> 
											<label for="Number of Pages" class="col-sm-4 control-label">Number of Pages</label> 
											<div class="col-sm-8"> 
												<input type="number" name="pages" class="form-control" id="Number of Pages" placeholder="Number of Pages" required> 
											</div>
										</div>

										<div class="form-group">
											<label for="Category" class="col-sm-2 control-label">Category</label> 
											<div class="col-sm-10">
												<select name="category" id="Category" class="form-control" required>
													<option value="">Select a category</option>
													<?php 
														$get_cat = "SELECT * FROM `category`";
														$run_cat = mysqli_query($connection, $get_cat);

														while ($row_cat = mysqli_fetch_assoc($run_cat)){ echo "
															<option value=\"{$row_cat['cat_id']}\">{$row_cat['cat_name']}</option>
														";}
													?>
												</select>
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
				<!-- //Add Book Modal -->
			</div>
			<div class="clearfix"> </div>

			<div class="agile-grids col-md-12">
				<br>

				<table id="example" class="table2">
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
							
							$show = "SELECT * FROM book";
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
								<a title=\"Delete\" href=\"action/del_book.php?id=$id\" class=\"btn btn-danger\"><i class=\"icon-trash icon-large\"></i></a>
								<a title=\"Edit\" href=\"action/edit_book.php?id=$id\" class=\"btn btn-success\"><i class=\"icon-pencil icon-large\"></i></a>
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
