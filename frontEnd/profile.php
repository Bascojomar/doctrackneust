<div class="modal fade" id="userDetailsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">User Details</h4>
                <button type="button" class="close" data-dismiss="modal">X</button>
            </div>

            <!-- Modal Body -->







            <div class="modal-body">
                <!-- Cover Photo -->
                <div class="cover-photo" id="coverPhoto"
                    style="background-image: url('../img/profile/coverphoto.jpg');">
                    <!-- Profile Photo -->

                    <?php

                    if (isset($_SESSION['user_id'])) {
                        // Retrieve user data from the database
                        $user_id = $_SESSION['user_id'];
                        $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                        $result = $conn->query($query);

                        if ($result->num_rows == 1) {
                            $user_data = $result->fetch_assoc();

                            // Use user data as needed
                    

                            echo ' <img class="profile-photo" id="profilePhoto"
                               src="../img/profile/';
                            echo $user_data['pic'];
                            echo '">';

                            echo '  </div>
                               <div class="profile-section">
                        <p><strong>Full Name:</strong> <span id="fullName">';
                            echo $user_data['fullname'];
                            echo '</span></p>
                        <p><strong>Email:</strong> <span id="email">';
                            echo $user_data['email'];
                            echo '</span></p>
                        <p><strong>Access Type:</strong> <span id="accessType">';
                            echo GetAccessname($user_data['accesstype']);
                            echo '</span></p>
                        <p><strong>Campus:</strong> <span id="campus">';
                            echo GetCampus($user_data['offices']);
                            echo '</span></p>
                        <p><strong>Office:</strong> <span id="office">';
                            echo OfficeName($user_data['offices']);
                            echo '</span></p>
                    </div>
                               ';


                            echo '   <div class="edit-forms">

                    
                               <form id="editEmailForm" action="../backEnd/userAuth.php" method="POST" enctype="multipart/form-data">
                                       <h5>Edit Profile</h5>
                                       <input type="text" class="form-control" id="newEmail"  value="';
                            echo $user_data['user_id'];
                            echo '"name="id" hidden >
                                       <div class="form-group">  
                                           <label for="newEmail">Fullname</label>
                                           <input type="text" class="form-control" name="fullname" value="';
                            echo $user_data['fullname'];
                            echo '" id="newEmail" >
                                       </div>
                                       <div class="form-group">
                                           <label for="newEmail"> Email:</label>
                                           <input type="email" class="form-control" id="newEmail"  value="';
                            echo $user_data['email'];
                            echo '"name="email">
                                       </div>
                                       <button type="submit" class="btn btn-primary" name="editProfile" value="editProfile">Edit Profile</button>
                                   </form>';

                            echo '<hr>
                            <!-- Edit Password Form -->
                            <form id="editEmailForm" action="../backEnd/userAuth.php" method="POST" enctype="multipart/form-data">
                                <h5>Edit Password</h5>
                                <div class="form-group">
                                <input type="text" class="form-control" id="newEmail"  value="';
                                echo $user_data['user_id'];
                                echo '"name="id" hidden >
                                    <label for="newPassword">Old Password:</label>
                                    <input type="password" class="form-control" id="newPassword" name="oldpass" required>
                                    <label for="newPassword">Confirm Password:</label>
                                    <input type="password" class="form-control" id="newPassword"  name="confirmpass" required>
                                    <label for="newPassword">New Password:</label>
                                    <input type="password" class="form-control" id="newPassword"  name="newpass" required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="changepass" value="changepass">Change Password</button>
                            </form>';

                            echo '         <hr>
                             <form id="editEmailForm" action="../backEnd/userAuth.php" method="POST" enctype="multipart/form-data">
                                <h5>Edit Profile Image</h5>
                                <div class="form-group">
                                    <label for="profileImage">Profile Image:</label>
                                    <input type="text" class="form-control" id="newEmail"  value="';
                                    echo $user_data['user_id'];
                                    echo '"name="id" hidden >

                                    <input class="form-control-file" type="file" id="image-input" accept="image/*"
                            onchange="previewImage(event)" name="pic" aria-label="default input example" required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="changeImg" value="changeImg">Change Avatar</button>
                            </form>
                            <hr>';

                        } else {
                            // Handle the case where user data couldn't be retrieved
                        }
                    } else {
                        // Redirect to the login page if the user is not logged in
                        // header("Location: index.php");
                        // exit();
                    }
                    ?>
            
                    
           
                

                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>