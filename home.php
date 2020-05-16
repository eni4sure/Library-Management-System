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
				</h2>
			</div>
			<div class="clearfix"> </div>
			<!-- //BreadCrum -->

			<br>
			
			<!-- Books , Users and Location Button -->
			<?php include("includes/info_grid.php") ?>
			<!-- //Books , Users and Location Button -->

			<!-- <div class="agile-two-grids">
				<div class="col-md-12 count">
						<div class="count-grid">
							<h3 class="title">Countdown</h3>
							<ul id="example">
								<li><span class="hours">00</span><p class="hours_text">Hours</p></li>
								<li class="seperator">:</li>
								<li><span class="minutes">00</span><p class="minutes_text">Minutes</p></li>
								<li class="seperator">:</li>
								<li><span class="seconds">00</span><p class="seconds_text">Seconds</p></li>
							</ul>
							<div class="clearfix"> </div>
							<script type="text/javascript" src="js/jquery.countdown.min.js"></script>
							<script type="text/javascript">
								$('#example').countdown({
									date: '04/22/2018 08:30:00',
									offset: +1,
									day: 'Day',
									days: 'Days'
								}, function () {
									alert('Welcome!');
								});
							</script>
						</div>
				</div>
				
				<div class="clearfix"> </div>
			</div> -->

		</div>

		<!-- Footer and Scripts -->
		<?php include("includes/footer.php") ?>
		<!-- //Footer and Scripts -->
</body>
</html>
