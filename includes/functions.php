<?php 
include("includes/connect.php");

	//redirects user to location   
	function Redirect_to($New_Location){
		header("Location:".$New_Location);
		exit;
	}

	// checks if the user exist in the database
	function username_exists($username, $connection){
		$sqli = "SELECT * FROM admin WHERE username='$username'";
		$result = mysqli_query($connection, $sqli);
		
		$sql = mysqli_num_rows($result);
		
		if($sql == 1){
			return true;
		}
		else {
			return false;
		}	
	}
	
	//checks if a user is logged in after a period of time 
	function logged_in(){
		if(isset($_SESSION['username']) || isset($_COOKIE['username'])){
			return true;
		}
		else {
			return false;
		}
	}

	//checks if a user is logged in.
	function Confirm_Login(){
		if(!logged_in()){
			Redirect_to("index.php");
		}	
	}
?>
