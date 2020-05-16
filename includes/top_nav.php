<nav class="user-menu">
			<a href="javascript:;" class="main-menu-access">
			<i class="icon-proton-logo"></i>
			<i class="icon-reorder"></i>
			</a>
		</nav>

		<!-- Logo, Search Bar, Notification and Admin Img -->
		<section class="title-bar">

			<!-- Logo and website name -->
			<div class="logo">
				<h1>
					<a href="home.php"><img src="images/logo.png" alt=""/>Library-Management</a>
				</h1>
			</div>
			<!-- //Logo and website name  -->

			<!-- Search Bar -->
			<div class="w3l_search">
				<form action="action/search.php" method="get">
					<input list="title" type="text" name="search" placeholder="Search Book" required>
					<datalist id="title">
						<?php 
							$get_title = "SELECT * FROM `book` ";
							$run_title = mysqli_query($connection, $get_title);

							while ($row_title = mysqli_fetch_assoc($run_title)){ echo "
								<option value=\"{$row_title['title']}\">
							";}
						?>
					</datalist>
					<button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
				</form>
			</div>
			<!-- //Search Bar -->

			<!-- Notification And Admin Image -->
			<div class="header-right">
				<div class="profile_details_left">

					<!--notifications of menu start -->
					<?php
						$date = date("F d, Y");
						$count_notif = "SELECT COUNT(date_due) from transaction WHERE date_returned ='Book not Returned' AND date_due <= now()";

						$count_notif_code = mysqli_query($connection, $count_notif);
						$count_notif_fetch = mysqli_fetch_array($count_notif_code);
						$count_notif_res =array_shift($count_notif_fetch);

					?>
					<div class="header-right-left">
						<ul class="nofitications-dropdown">
							<li class="dropdown head-dpdn">
								<a href="notification.php" title="notification" ><i class="fa fa-bell"></i><span class="badge blue"><?php echo $count_notif_res ;?></span></a>
							</li>
							<div class="clearfix"> </div>
						</ul>
					</div>
					<!--notifications of menu start -->

					<!-- Admin Pic -->
					<div class="profile_details">		
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">	
										<span class="prfil-img"><i class="fa fa-user" aria-hidden="true"></i></span> 
										<div class="clearfix"></div>	
									</div>	
								</a>
								<ul class="dropdown-menu drp-mnu">
									<li> <a><i class="fa fa-sign-in"></i> Admin</a> </li> 
									<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="clearfix"> </div>
					<!-- //Admin Pic -->

				</div>
			</div>
			<div class="clearfix"> </div>
			<!-- //Notification And Admin Image -->
		</section>
		<!-- Logo, Search Bar, Notification and Admin Img -->