<?php
include('database.php');
session_start();





$_SESSION = array();



// Destroy the session
session_destroy();

// Redirect to the login page or another appropriate page
header("Location: ../index.php");
exit();

?>