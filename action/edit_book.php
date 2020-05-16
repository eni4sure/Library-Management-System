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
					<i class="fa fa-angle-right"></i> <span>Edit Book</span>
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

					
				?>
				<?php


					$get_id =$_GET['id'];
					$show = "SELECT * FROM book where book_id = '$get_id' ";
					$showcase = mysqli_query($connection, $show);
					
					while ($row = mysqli_fetch_assoc($showcase)){

					$author = null;
					$title = null;
					$copies = null;
					$pages = null;
					$location = null;

					if(isset($_POST["id"])){$id = $_POST["id"];}
					if(isset($_POST["title"])){$title = $_POST["title"];}
					if(isset($_POST["author"])){$author = $_POST["author"];}
					if(isset($_POST["copies"])){$copies = $_POST["copies"];}
					if(isset($_POST["pages"])){$pages = $_POST["pages"];}
					if(isset($_POST["category"])){$category_id = $_POST["category"];}

					if(isset($_POST['update'])){

						$count_book = "SELECT COUNT(*) FROM all_book WHERE title='{$row['title']}'";
						$count_book_code = mysqli_query($connection, $count_book);
						$count_book_res = mysqli_fetch_array($count_book_code);
						$count_result = array_shift($count_book_res);

						if($count_result <= $copies){

							$math_res = $copies - $count_result;
							$count = 0;
							while ($count < $math_res){

								$ins_new_book = "INSERT INTO all_book(title,author,pages,dateadded,status,category_id,bk_cond) 
								VALUES ('$title','$author','$pages',now(),'Available','$category_id','Ready')";

								$ins_new_book_code = mysqli_query($connection, $ins_new_book);
								$count++;
							}

							$update_book = "UPDATE book SET title='$title',author='$author', category_id = $category_id WHERE book_id = $id";	
							$update_book_con = mysqli_query($connection, $update_book);

							$update_all_book = "UPDATE all_book SET title='$title',author='$author', category_id = $category_id WHERE title = '{$row['title']}'";
							$update_all_book_con = mysqli_query($connection, $update_all_book);

							if ($update_book_con and $update_all_book_con) {
								echo "<br><div class=\"alert alert-success alert-dismissable\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<strong>Success!</strong><br/>Book updated successfully</div>";
							} else {
								echo "<br><div class=\"alert alert-error alert-dismissable\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<strong>Error!</strong><br/>Error in Connection</div>";
							}

						} else {
							echo "<br><div class=\"alert alert-error alert-dismissable\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<strong>Error!</strong><br/>Your Number of books can only be higher not lower.</div>";
						}
					}

					$find_cat_id = "SELECT cat_id,cat_name FROM category WHERE cat_id ={$row['category_id']}";
					$find_cat_id_code = mysqli_query($connection, $find_cat_id);
					$find_cat_id_res = mysqli_fetch_array($find_cat_id_code);

					$count_copies = "SELECT COUNT(*) FROM `all_book` WHERE title ='{$row['title']}' AND bk_cond='Ready'";
					$count_copies_code = mysqli_query($connection, $count_copies);
					$count_copies_get = mysqli_fetch_array ($count_copies_code);
					$count_copies_res =array_shift($count_copies_get);
				?>

				<div class="form-body">
					<form class="form-horizontal" action="#" method="post">
						
						<div class="form-group"> 
							<label for="Title" class="col-sm-2 control-label">Title</label> 
							<div class="col-sm-10"> 
								<input type="hidden" id="id" name="id" value="<?php echo $row['book_id']; ?>" placeholder="Id" required>
								<input type="text" name="title" class="form-control" value="<?php echo $row['title'] ?>" id="Title" placeholder="New Book Title" required> 
							</div>
						</div>

						<div class="form-group"> 
							<label for="Author" class="col-sm-2 control-label">Author</label> 
							<div class="col-sm-10"> 
								<input type="text" name="author" class="form-control" value="<?php echo $row['author'] ?>" id="Author" placeholder="New Author" required> 
							</div>
						</div>

						<div class="form-group"> 
							<label for="Number of books" class="col-sm-2 control-label">Number of Copies</label> 
							<div class="col-sm-10"> 
								<input type="number" name="copies" class="form-control" value="<?php echo $count_copies_res ?>" id="Number of books" placeholder="New Number of books" required> 
							</div>
						</div>

						<div class="form-group"> 
							<label for="Number of Pages" class="col-sm-2 control-label">Number of Pages</label> 
							<div class="col-sm-10"> 
								<input type="number" name="pages" class="form-control" value="<?php echo $row['pages'] ?>" id="Number of Pages" placeholder="New Number of Pages" disabled required> 
							</div>
						</div>

						<div class="form-group">
							<label for="Category" class="col-sm-2 control-label">Category</label> 
							<div class="col-sm-10">
								<select name="category" id="Category" class="form-control" required>
									<option value="<?php echo $find_cat_id_res['cat_id'] ?>"><?php echo $find_cat_id_res['cat_name'] ?></option>
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