<?php
error_reporting(0);
//echo $_SERVER['REQUEST_URI'];
$servername = "localhost";
$username = "root";	
$password ="";
$dbname = "edoctracke";
global $conn;
$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

// function GetData($sql_query) {
	// error_reporting(0);
	// global $db_connection;
	// $result = mysqli_query($db_connection,$sql_query);
	// $row = mysqli_fetch_array($result);
	// return $row[0];
// }
?>