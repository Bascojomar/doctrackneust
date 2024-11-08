<?php
include('database.php');
session_start();



$user_id = $_SESSION['user_id'];

$del = "DELETE FROM request where user_id = '$user_id' ";

mysqli_query($conn,$del);

$_SESSION = array();



// Destroy the session
session_destroy();

// Redirect to the login page or another appropriate page
header("Location: ../index.php");
exit();

?>