<?php include("includes/connect.php"); ?>
<?php include("includes/functions.php"); ?>
<?php

	$id =$_GET['id'];
	$delete = "UPDATE member SET status='Disabled' WHERE member_id='$id'";
	$delete_con = mysqli_query($connection, $delete);

	header('location:../users.php');
?>