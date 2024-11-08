
<?php


include "../backEnd/database.php";

session_start();

$id =  $_SESSION['user_id'];


$update = mysqli_query($conn, "UPDATE users set is_online = NULL, sessionCode = NULL
                 where user_id = '$id'" );
// Unset all session variables
$_SESSION = array();



// Destroy the session
session_destroy();

// Redirect to the login page or another appropriate page
header("Location: ../index.php");
exit();
?>