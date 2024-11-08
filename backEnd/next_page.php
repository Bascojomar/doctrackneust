<?php


include "database.php";
include "function.php";
session_start();

//  if (isset($_POST['sub'])) {

    $id = $_POST['id'];
    $sub1 = $_POST['sub1'];
    $sub2 = $_POST['sub2'];
    $sub3 = $_POST['sub3'];
    $sub4 = $_POST['sub4'];
    $sub5 = $_POST['sub5'];
    $sub6 = $_POST['sub6'];

    $otpRequest = $sub1 . $sub2 . $sub3 . $sub4 . $sub5 . $sub6;

    

    $sql = "SELECT * FROM request WHERE user_id = '".$id."' and otp = '".$otpRequest."'  limit 1 ";
    $result = $conn->query($sql);
echo $sql;
        if($result && $result->num_rows > 0){
            //swal alert
          
        $user_data = $result->fetch_assoc(); 

        $newpass = GenerateOtp();
        $email_ad = GetData('select email from users where user_id='.$user_data['user_id']);
        $fullname = GetData('select fullname from users where user_id='.$user_data['user_id']);
        $getpass = md5($newpass);

        $user_id = $user_data['user_id'];
       

        $update = mysqli_query($conn, "UPDATE users set userPassword = '$getpass' where user_id = '$user_id'" );

        echo $update;

        if($update)
        {
            include('../email/send_otp.php');
            // Redirect to the login page or another appropriate page
            header("Location: session.php");

        }

        }
        header("Location: session.php");
//  }
?>
