<?php
	
	session_start();
	session_destroy();
	setcookie("username",'',time()-72000);
	header("location: index.php");

?>