<!-- Info Grid -->
			
			<div class="social grid">
				<div class="grid-info">

					<!-- Users Info -->
					<?php
					//number of users

						$count_users = "SELECT COUNT(*) from member WHERE status ='Active'";

						$count_users_query = mysqli_query($connection, $count_users);
						$count_users_get = mysqli_fetch_array($count_users_query);
						$count_users_res = array_shift($count_users_get);
					?>
					<div class="col-md-4 top-comment-grid">
						<a href="users.php"><div class="comments likes">
							<div class="comments-icon">
								<i class="fa fa-users"></i>
							</div>
							<div class="comments-info likes-info">
								<h3><?php echo $count_users_res ?></h3>
								<a href="#">Users</a>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div></a>
					<!-- //Users Info -->

					<!-- Books Info -->
					<?php
					//number of book

						$count_book = "SELECT COUNT(*) from all_book WHERE bk_cond='Ready'";

						$count_book_query = mysqli_query($connection, $count_book);
						$count_book_get = mysqli_fetch_array($count_book_query);
						$count_book_res = array_shift($count_book_get);
					?>
					<div class="col-md-4 top-comment-grid">
						<a href="books.php"><div class="comments">
							<div class="comments-icon">
								<i class="fa fa-book"></i>
							</div>
							<div class="comments-info">
								<h3><?php echo $count_book_res ?></h3>
								<a href="#">Books</a>
							</div>
							<div class="clearfix"> </div>
						</div></a>
					</div>
					<!-- //Books Info -->

					<!-- Locations Info -->
					<?php
					//number of category

						$count_cat = "SELECT COUNT(*) from category ";

						$count_cat_query = mysqli_query($connection, $count_cat);
						$count_cat_get = mysqli_fetch_array($count_cat_query);
						$count_cat_res = array_shift($count_cat_get);
					?>
					<div class="col-md-4 top-comment-grid">
						<a href="category.php"><div class="comments tweets">
							<div class="comments-icon">
								<i class="fa fa-list-ul"></i>
							</div>
							<div class="comments-info tweets-info">
								<h3><?php echo $count_cat_res ?></h3>
								<a href="#">Category</a>
							</div>
							<div class="clearfix"> </div>
						</div></a>
					</div>
					<!-- //Locations Info -->

					<div class="clearfix"> </div>

				</div>
			</div>
			<!-- //Info Grid -->