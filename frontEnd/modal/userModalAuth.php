<!--Modal for Remove-->


<div class="modal fade" id="exampleModalremove<?php echo $row['user_id']; ?>" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="../backEnd/userAuth.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Module</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Content will be populated dynamically -->
                    <p id="modalContent"></p>

                    <div class="form-group">
                        <input type=text value="<?php echo $row['user_id']; ?>" name="id" hidden ?>
                        <span> Do you want to remove <b style="color:red"> <?php echo $row['fullname']; ?> </b></span>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="removeUser" value="removeUser">Yes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--Modal for add users-->


<div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="../backEnd/userAuth.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="accesstype">Access Type</label>
                        <select class="form-control" id="accesstype" name="accesstype" required>
                            <?php
                            $q = "SELECT acc_id, accessName FROM accesstype";
                            $rs = mysqli_query($conn, $q);
                            while ($rw = mysqli_fetch_array($rs)) {
                                echo '<option value="' . $rw['acc_id'] . '">' . $rw['accessName'] . '</option>';
                            }

                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="offices">Offices</label>
                        <select class="form-control" name="offices" aria-label=" input example">';
                            <?php
                            $q = "SELECT office_id, officeName FROM offices";
                            $rs = mysqli_query($conn, $q);
                            while ($rw = mysqli_fetch_array($rs)) {
                                echo '<option value="' . $rw['office_id'] . '">' . $rw['officeName'] . '</option>';
                            }

                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <div class="col-title"> Preview </div>
                        <input class="form-control" type="file" id="image-input" accept="image/*"
                            onchange="previewImage(event)" name="pic" aria-label="default input example" required>
                    </div>
                    <div class="col">
                        <div class="col-title"> Capture Image </div>
                        <div id="preview-container">
                            <img id="image-preview"
                                style="border-style: solid !important;border-color:black !important;width:150px !important;maxWidth: 150px !important; "
                                alt="Image Preview" src="../images/talvera.png">
                        </div>


                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="addUser" value="addUser">Add User</button>
                </div>
            </div>
        </form>

    </div>
</div>

<div class="modal fade" id="exampleModaledit<?php echo $row['user_id']; ?>" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="../backEnd/userAuth.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group"><input type="text" class="form-control" id="fullname"
                            value="<?php echo $row['user_id']; ?>" name="id" hidden>
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" id="fullname" value="<?php echo $row['fullname']; ?>"
                            name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="<?php echo $row['email']; ?>"
                            name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="accesstype">Access Type</label>
                        <select class="form-control" id="accesstype" name="accesstype" required>
                            <?php
                            $currentAccess = $row['accesstype'];
                            $q = "SELECT acc_id, accessName FROM accesstype";
                            $rs = mysqli_query($conn, $q);
                            while ($rw = mysqli_fetch_array($rs)) {
                                $selected = ($rw['acc_id'] == $currentAccess) ? 'selected' : '';
                                echo '<option value="' . $rw['acc_id'] . '" ' . $selected . '>' . $rw['accessName'] . '</option>';
                            }

                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="offices">Offices</label>
                        <select class="form-control" name="offices" aria-label=" input example">';
                            <?php
                            $currentOfficeId = $row['offices'];

                            $q = "SELECT office_id, officeName FROM offices";
                            $rs = mysqli_query($conn, $q);
                            while ($rw = mysqli_fetch_array($rs)) {
                                $selected = ($rw['office_id'] == $currentOfficeId) ? 'selected' : '';
                                echo '<option value="' . $rw['office_id'] . '" ' . $selected . '>' . $rw['officeName'] . '</option>';
                            }

                            ?>

                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="editUser" value="editUser">Edit User</button>
                </div>
            </div>
        </form>

    </div>
</div>


