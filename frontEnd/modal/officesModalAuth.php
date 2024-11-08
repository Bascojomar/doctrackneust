<div class="modal fade" id="officeModal" tabindex="-1" aria-labelledby="officeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="officeModalLabel">Add Offices</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="../backEnd/officesAuth.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="officeCode" class="form-label">Office Code:</label>
                            <input type="text" class="form-control" id="officeCode" name="officeCode" required>
                        </div>
                        <div class="mb-3">
                            <label for="officeName" class="form-label">Office Name:</label>
                            <input type="text" class="form-control" id="officeName" name="officeName" required>
                        </div>
                        <div class="mb-3">
                            <label for="officeName" class="form-label">Campus:</label>
                            <select class="form-control" id="campus" name="campus" required>
                            <?php
                            $q = "SELECT campus_id, campusName FROM campus";
                            $rs = mysqli_query($conn, $q);
                            while ($rw = mysqli_fetch_array($rs)) {
                                echo '<option value="' . $rw['campus_id'] . '">' . $rw['campusName'] . '</option>';
                            }

                            ?>
                        </select>
                        </div>
                        <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addOffice" value="addOffice">Add Office</button>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="officeModaledit<?php echo $row['office_id']; ?>" tabindex="-1" aria-labelledby="officeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="officeModalLabel">Edit Offices</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="../backEnd/officesAuth.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="officeCode" class="form-label">Office Code:</label>
                            <input type="text" class="form-control" id="officeCode" name="id" value="<?php echo $row['office_id'];?>" required hidden>
                            <input type="text" class="form-control" id="officeCode" name="officeCode" value="<?php echo $row['officeCode'];?>"   required >
                        </div>
                        <div class="mb-3">
                            <label for="officeName" class="form-label">Office Name:</label>
                            <input type="text" class="form-control" id="officeName" name="officeName" value="<?php echo $row['officeName'];?>" >
                        </div>
                        <div class="mb-3">
                            <label for="officeName" class="form-label">Campus: </label>
                            <select class="form-control" id="campus" name="campus" required>
                            <?php
                           
                           $currentAccess = $row['campus'];
                           $q = "SELECT campus_id, campusName FROM campus";
                           $rs = mysqli_query($conn, $q);
                           while ($rw = mysqli_fetch_array($rs)) {
                               $selected = ($rw['campus_id'] == $currentAccess) ? 'selected' : '';
                               echo '<option value="' . $rw['campus_id'] . '" ' . $selected . '>' . $rw['campusName'] . '</option>';
                           }

                            ?>
                        </select>
                        </div>
                        <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editOffice" value="editOffice">Edit Office</button>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    
    