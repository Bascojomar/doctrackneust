<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details Modal</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cover-photo {
            width: 100%;
            height: 200px;
            background-color: #ddd;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid #fff;
            position: absolute;
            bottom: -75px;
            left: 20px;
            background-color: #eee;
            background-size: cover;
            background-position: center;
        }

        .profile-section {
            padding-top: 100px; /* Adjusted for the profile picture overlap */
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userDetailsModal">
        Open User Details
    </button>

    <!-- The Modal -->
    <div class="modal fade" id="userDetailsModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">User Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Cover Photo -->
                    <div class="cover-photo" id="coverPhoto" style="background-image: url('https://via.placeholder.com/800x200');">
                        <!-- Profile Photo -->
                        <div class="profile-photo" id="profilePhoto" style="background-image: url('https://via.placeholder.com/150');"></div>
                    </div>
                    
                    <!-- User Details -->
                    <div class="profile-section">
                        <p><strong>Full Name:</strong> <span id="fullName">John Doe</span></p>
                        <p><strong>Email:</strong> <span id="email">john.doe@example.com</span></p>
                        <p><strong>Access Type:</strong> <span id="accessType">Admin</span></p>
                        <p><strong>Campus:</strong> <span id="campus">Main Campus</span></p>
                        <p><strong>Office:</strong> <span id="office">Room 101</span></p>
                    </div>

                    <!-- Edit Forms -->
                    <div class="edit-forms">
                        <!-- Edit Password Form -->
                        <form id="editPasswordForm">
                            <h5>Edit Password</h5>
                            <div class="form-group">
                                <label for="newPassword">New Password:</label>
                                <input type="password" class="form-control" id="newPassword" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>
                        <hr>

                        <!-- Edit Image Form -->
                        <form id="editImageForm">
                            <h5>Edit Profile Image</h5>
                            <div class="form-group">
                                <label for="profileImage">Profile Image:</label>
                                <input type="file" class="form-control-file" id="profileImage" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Change Image</button>
                        </form>
                        <hr>

                        <!-- Edit Email Form -->
                        <form id="editEmailForm">
                            <h5>Edit Email</h5>
                            <div class="form-group">
                                <label for="newEmail">New Email:</label>
                                <input type="email" class="form-control" id="newEmail" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Change Email</button>
                        </form>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript to handle form submissions can be added here
        $('#editPasswordForm').submit(function(e) {
            e.preventDefault();
            // Handle password change logic
            alert('Password changed successfully!');
        });

        $('#editImageForm').submit(function(e) {
            e.preventDefault();
            // Handle image change logic
            alert('Image changed successfully!');
        });

        $('#editEmailForm').submit(function(e) {
            e.preventDefault();
            // Handle email change logic
            alert('Email changed successfully!');
        });
    </script>
</body>
</html>
