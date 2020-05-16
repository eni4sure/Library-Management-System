<!-- Script -->
	<script type="text/javascript">
        var theme = $.cookie('protonTheme') || 'default';
        $('body').removeClass (function (index, css) {
            return (css.match (/\btheme-\S+/g) || []).join(' ');
        });
        if (theme !== 'default') $('body').addClass(theme);
	</script>
	<!-- //Script -->

	<!-- Side Navbar -->
	<nav class="main-menu">
		<ul>
			<li>
				<a href="home.php">
					<i class="fa fa-dashboard nav_icon"></i>
					<span class="nav-text">
					Dashboard
					</span>
				</a>
			</li>
			<li>
				<a href="users.php">
					<i class="fa fa-users nav_icon"></i>
					<span class="nav-text">
					Users
					</span>
				</a>
			</li>
			<li>
				<a href="books.php">
					<i class="fa fa-book nav_icon"></i>
					<span class="nav-text">
					Books
					</span>
				</a>
			</li>
			<li>
				<a href="category.php">
					<i class="fa fa-list-ul nav_icon"></i>
					<span class="nav-text">
					Category
					</span>
				</a>
			</li>
			<li>
				<a href="borrow.php">
					<i class="fa fa-exchange nav_icon"></i>
					<span class="nav-text">
						Borrow Book
					</span>
				</a>
			</li>
			<li>
				<a href="return.php">
					<i class="fa fa-exchange nav_icon"></i>
					<span class="nav-text">
						Return Book
					</span>
				</a>
			</li>
			<li>
				<a href="view.php">
					<i class="fa fa-eye nav_icon"></i>
					<span class="nav-text">
						View History
					</span>
				</a>
			</li>
			<li>
				<a href="notification.php">
					<i class="fa fa-bell nav_icon"></i>
					<span class="nav-text">
						Notification
					</span>
				</a>
			</li>
			<li>
				<a href="view-book-sn.php">
					<i class="fa fa-eye nav_icon"><i class="fa fa-book nav_icon"></i></i>
					<span class="nav-text">
						View Book S/N
					</span>
				</a>
			</li>
			
		</ul>
		<ul class="logout">
			<li>
				<a href="logout.php">
					<i class="icon-off nav-icon"></i>
					<span class="nav-text">
						Logout
					</span>
				</a>
			</li>
		</ul>
	</nav>
	<!-- //Side Navbar -->