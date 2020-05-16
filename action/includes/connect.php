<?php 
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "alpha";

$connection = new mysqli($servername, $username, $password, $dbname);

if($connection->connect_error){
	die($connection->connect_error);
}
?>