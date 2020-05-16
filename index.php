<?php include("includes/connect.php"); ?>
<?php include("includes/functions.php"); ?>
<?php
	//user has logged in before
	if(logged_in())
	{
		header("location:home.php");
		exit();
	}
	
	$error = "";

	if(isset($_POST['submit']))
	{
	    $username = mysqli_real_escape_string($connection, $_POST['username']);
	    $password = mysqli_real_escape_string($connection, $_POST['password']);
		$checkBox = isset($_POST['keep']);
		
		if(username_exists($username,$connection))
		{
			$result = mysqli_query($connection, "SELECT password FROM admin WHERE username='$username'");
			$retrievepassword = mysqli_fetch_assoc($result);
			
			if(!password_verify($password, $retrievepassword['password']))
			{
				$error = "<br><div class=\"alert alert-error alert-dismissable\">
				<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
				<strong>Error!</strong><br/>Password is incorrect</div>";
			}
			else
			{
				$_SESSION['username'] = $username;
				
				if($checkBox == "on")
				{
					setcookie("username",$username, time()+72000);
				}
				
				header("location:home.php");
			}	
			
		}
		else
		{
			$error = "<br><div class=\"alert alert-error alert-dismissable\">
				<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
				<strong>Error!</strong><br/>Username Does not exists</div>";
		}	
	}
?>

<!DOCTYPE html>

<?php include("Includes/head.php") ?>

<body class="signup-body">
<div class="se-pre-con"></div>
	<div class="agile-signup">	
		
		<div class="content2">
			<div class="grids-heading gallery-heading signup-heading">
				<h2> Library Management</h2>
			</div>
			<form action="index.php" method="post">
				<?php echo "$error"; ?>
				<input type="text" 		name="username" placeholder="Username" required>
				<input type="password"	name="password"	placeholder="Password" required>
				<div class="checkbox" style="float: left; margin-left: 2em;"> 
					<label> <input type="checkbox"  name="keep" checked> Remember me </label> 
				</div>
				<input type="submit" name="submit"	class="register" value="Login">
			</form>
			<div class="signin-text">
				<div class="text-right">
					<p><a href="Demo.php">Not Admin? Click here</a></p>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		
		<!-- footer -->
		<div class="copyright">
			<p>&copy 2018 Library Management.</p>
		</div>
		<!-- //footer -->
	</div>
	<script src="js/proton.js"></script>
</body>

</html>
