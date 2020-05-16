<?php include("includes/connect.php"); ?>

<?php

	$error = "";
	$success= "";

	if(isset($_POST['submit']))
	{
		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$password = $_POST['password'];
		$passwordConfirm = $_POST['passwordConfirm'];
		$firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
		$surname = mysqli_real_escape_string($connection, $_POST['surname']);
		
		if(strlen($username) < 3)
		{
			$error = "<div class=\"alert alert-danger alert-dismissable\">
				  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
				  <strong> Danger</strong><br>Username $username is too short</div>";
		}
		
		else if(strlen($firstname) < 3)
		{
			$error = "<div class=\"alert alert-danger alert-dismissable\">
				  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
				  <strong> Danger</strong><br>Firstname $firstname is too short</div>";
		}
		else if(strlen($surname) < 3)
		{
			$error = "<div class=\"alert alert-danger alert-dismissable\">
				  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
				  <strong> Danger</strong><br>Surname $surname name is too short</div>";
		}
		
		else if(strlen($password) < 5)
		{
			$error = "<div class=\"alert alert-danger alert-dismissable\">
				  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
				  <strong> Danger</strong><br>Password must be greater than 8 characters</div>";
		}
		else if($password !== $passwordConfirm)
		{
			$error = "<div class=\"alert alert-danger alert-dismissable\">
				  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
				  <strong> Danger</strong><br>Password does not match</div>";
		}
		
		else
		{	
			$password = password_hash($password, PASSWORD_DEFAULT);


			if (($username != null) && ($password != null ) && ($firstname != null)  && ($surname != null))
			{

				$sql = "INSERT INTO admin (username, password, firstname, surname) VALUES ('$username','$password','$firstname','$surname')";

				$conn = mysqli_query($connection, $sql);

				if ($conn) {
				$success = "<div class=\"alert alert-success alert-dismissable\">
				<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
				  <strong>Success!</strong><br/>New record created successfully</div>";

				} else {

				$error = "<div class=\"alert alert-danger alert-dismissable\">
				  <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
				  <strong> Danger</strong>"."<br/>"; 
				echo "Error: " . $sql . "<br/>" . mysqli_error($con);
				echo "</div>";
				}

				mysqli_close($connection);
			}
		}
	}
?>

<!DOCTYPE html>

<!-- Links -->
<?php include("includes/head.php") ?>
<!-- Links -->

<body class="signup-body">
<div class="se-pre-con"></div>
	<div class="agile-signup">	
	
		<div class="content2">
			<div class="grids-heading gallery-heading signup-heading">
				<h2>Add Admin</h2>
			</div>
			<form method="POST"  enctype="multipart/form-data">
			<br><?php echo "$error"; ?><?php echo "$success"; ?>
				<input type="text"		name="username"		value="Username" 	onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}">
				<input type="text"		name="firstname"	value="First Name" 	onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'First Name';}">
				<input type="text"		name="surname"		value="Surname" 	onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Surname';}">
				<input type="password"	name="password"			placeholder="Password">
				<input type="password"	name="passwordConfirm" 	placeholder="Confirm Password">
				<input type="submit" class="register" name="submit" value="Submit">
			</form>
			<div class="signin-text">
				<div class="text-right">
					<p><a href="index.php">Sign in</a></p>
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
