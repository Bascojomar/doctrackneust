<?php


 include "database.php";
 
 include "function.php";
 session_start();

//Authentication for login
           if(isset($_POST['sendEmail']))
           {

    
            $Email =  $_POST['Email'];
            
            $sql = "SELECT * FROM users WHERE email = '".$Email."' and dateDeleted is null limit 1 ";

       
            $result = $conn->query($sql);

                if($result && $result->num_rows > 0){
                    //swal alert
                  
                $user_data = $result->fetch_assoc(); 

                $_SESSION['user_id'] ="$user_data[user_id]"; 
                $id = $user_data['user_id'];
                $email = $user_data['email'];
           

                $otp = GenerateOtp();
       

                $insert = "INSERT INTO request SET user_id='$id',
                    otp = '$otp'";
                echo $insert;
                   

                mysqli_query($conn,$insert);

                 include('../email/received_otp.php');
               header("location: ../otp");

                }
                else{
                    header("location: ../forgotpassword?invalidemail");
                }
            }
    ?>
