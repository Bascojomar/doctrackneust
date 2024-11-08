<?php
 include "database.php";
 include "../backEnd/function.php";


 if (isset($_POST['addUser'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $Password = Generatepassword();
    $accesstype = $_POST['accesstype'];
    $offices = $_POST['offices'];
    $Statusres = "1";   

    $getpass = md5($Password);

 if (isset($_FILES['pic']) && !empty($_FILES['pic']['name'])) {
                    $pic = basename($_FILES["pic"]["name"]);
                    $target_dir = "../img/profile/";
                    $target_file = $target_dir . $pic;
                    move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);
                } else {
                    $pic = '';
                }
        
                $q = "INSERT INTO users SET fullname='$fullname',
                email = '$email',
                userPassword = '$getpass',
                offices = '$offices',
                accesstype = '$accesstype',
                pic='$pic', 
                userStatus='$Statusres'";


                    mysqli_query($conn,$q);
                  include('../email/send_userAccount.php');
                    header("Location: ../frontEnd/users?addeduser");
                    }
    
                             
                             if (isset($_POST['removeUser'])) {

                                $id = mysqli_real_escape_string($conn, $_POST['id']);
                                $date = date("Y-m-d");
                
                                $update = mysqli_query($conn, "UPDATE users set dateDeleted = '$date' where user_id = '$id'" );
                                
                                if($update){
                                    header("Location: ../frontEnd/users?removeUser");
                                }   
                
                               }

                               if (isset($_POST['editUser'])) {
                                $id = mysqli_real_escape_string($conn, $_POST['id']);
                                $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
                                $email = mysqli_real_escape_string($conn,$_POST['email']);
                                $accesstype = $_POST['accesstype'];
                                $offices = $_POST['offices'];


                                $update = mysqli_query($conn, "UPDATE users set fullname = '$fullname',  email = '$email', offices = '$offices',
                                accesstype = '$accesstype' where user_id = '$id'" );
                                     if($update){
                                        header("Location: ../frontEnd/users?updateUsers");
                                    }
                                
                               }

                               if (isset($_POST['editProfile'])) {
                                $id = mysqli_real_escape_string($conn, $_POST['id']);
                                $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
                                $email = mysqli_real_escape_string($conn,$_POST['email']);
                            


                                $update = mysqli_query($conn, "UPDATE users set fullname = '$fullname',  email = '$email' where user_id = '$id'" );
                                     if($update){
                                        header("Location: ../frontEnd/home?updateUsers");
                                    }
                                
                               }
                               if (isset($_POST['changepass'])) {
                                $id = mysqli_real_escape_string($conn, $_POST['id']);
                                $oldpass = mysqli_real_escape_string($conn, $_POST['oldpass']);
                                $confirmpass = mysqli_real_escape_string($conn,$_POST['confirmpass']);
                                $newpass = mysqli_real_escape_string($conn,$_POST['newpass']);
                                $newpass1 = md5($newpass);

                                $oldp = md5($oldpass);
                                if($newpass != $confirmpass){

                                    header("Location: ../frontEnd/home?notmatch");
                                        
                                }
                                else{

                                    $query = "SELECT * FROM users WHERE user_id = '$id' and userPassword = '$oldp'";
                                    $result = $conn->query($query);
            
                                    if ($result->num_rows == 1) {
                                        $user_data = $result->fetch_assoc();

                                        $update = mysqli_query($conn, "UPDATE users set userPassword = '$newpass1' where user_id = '$id'" );
                                        if($update)
                                        {
                                           header("Location: ../frontEnd/home?updatepassword");
                                       }

                                    }
                                    else{
                                        header("Location: ../frontEnd/home?oldpass");
                                    }
                                    
                                }
                               
                                
                               }


                               if (isset($_POST['changeImg'])) {
                                $id = mysqli_real_escape_string($conn, $_POST['id']);
          
                                if (isset($_FILES['pic']) && !empty($_FILES['pic']['name'])) {
                                    $pic = basename($_FILES["pic"]["name"]);
                                    $target_dir = "../img/profile/";
                                    $target_file = $target_dir . $pic;
                                    move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);
                                } else {
                                    $pic = '';
                                }

                                $update = mysqli_query($conn, "UPDATE users set pic = '$pic'where user_id = '$id'" );
                                     if($update){
                                        header("Location: ../frontEnd/home?updatePic");
                                    }
                                
                               }
                               ?>
?>