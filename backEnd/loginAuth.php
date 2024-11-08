<?php

 include "database.php";

 session_start();

//Authentication for login
           if(isset($_POST['loginauth']))
           {

    
            $Email =  $_POST['Email'];
            $Password = $_POST['Password'];
            $getpass = md5($Password);
     
            
            $sql = "SELECT * FROM users WHERE email = '".$Email."' and userPassword = '".$getpass."'";
            $result = $conn->query($sql);



                if($result && $result->num_rows > 0){
                    //swal alert
                  
                $user_data = $result->fetch_assoc(); 
                
                $userStatus = $user_data['statusUser'];

                $id = $user_data['user_id']; 

                include "sessionverify.php";

                $is_online = 1;

                $update = mysqli_query($conn, "UPDATE users set is_online = '$is_online', sessionCode = '$sessionCode'
                 where user_id = '$id'" );
            
                    $_SESSION['scode'] = $sessionCode;

                    $_SESSION['Name'] = $user_data['fullname'];  
                    $_SESSION['user_id'] = $user_data['user_id']; 
                    $_SESSION['accesstype'] = $user_data['accesstype'];
                    $_SESSION['offices'] = $user_data['offices'];
                    

    

                    header('Location: ../frontEnd/home');   
              
                }
                else{
              
                    header('Location: ../index?statusError');
                }                         
                }
                
            
    ?>
