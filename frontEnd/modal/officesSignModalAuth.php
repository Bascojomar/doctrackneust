<div class="modal fade" id="officeSignModal" tabindex="-1" aria-labelledby="officeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="officeModalLabel">Add Signatory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="../backEnd/officesSignAuth.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="officeCode" class="form-label">Signatory Name</label>
                            <input type="text" class="form-control" id="sn" name="sn" val required>
                        </div>
                        <div class="mb-3">

                        <label for="officeName" class="form-label">Position:</label>
                        <select name="sp" class="form-control" id="select_box">
                        <option value="">Select Signatory</option>
                        <?php 
                        $query = "
                        SELECT positionId, positionTitle FROM position 
                      
                    ";
                    
                    $resultxx = $conn->query($query);
                    
                    
                        foreach($resultxx as $rowx)
                        {
                            echo '<option value="'.$rowx["positionId"].'">'.$rowx["positionTitle"].'</option>';
                        }
                        ?>  
                    </select>
                        </div>
                        <div class="mb-3">
                            <label for="officeName" class="form-label">Campus:</label>
                            <select class="form-control" id="office" name="office" required>
                            <?php
                            
                            $q = "SELECT office_id, officeName FROM offices where office_id != 5";
                            $rs = mysqli_query($conn, $q);
                            while ($rw = mysqli_fetch_array($rs)) {
                                echo '<option value="' . $rw['office_id'] . '">' . $rw['officeName'] . ' - ' . Getcampus($rw['office_id']) .'</option>';
                            }

                            ?>
                        </select>
                        </div>
                        <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addOfficeSign" value="addOfficeSign">Add Signatory</button>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="officesignModaledit<?php echo $row['os_id']; ?>" tabindex="-1" aria-labelledby="officeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="officeModalLabel">Edit Signatory [<?php echo $row['signatory'];?>]</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="../backEnd/officesSignAuth.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="officeCode" class="form-label">Signatory Name</label>
                            <input type="text" class="form-control" id="sn" name="id" value="<?php echo $row['os_id'];?>" hidden>
                            <input type="text" class="form-control" id="sn" name="sn" value="<?php echo $row['signatory'];?>"required>
                        </div>
                        <div class="mb-3">

                        <label for="officeName" class="form-label">Position: [<?php echo $row['position_id'];?>]</label>
                        <select name="sp" class="form-control" id="select_box">
                   

                        
                        <?php
                            $currentPosition = $row['position_id'];
                            $q = "SELECT positionID, positionTitle FROM position";
                            $rs = mysqli_query($conn, $q);
                            while ($rw = mysqli_fetch_array($rs)) {
                                $selected = ($rw['positionID'] == $currentPosition) ? 'selected' : '';
                                echo '<option value="' . $rw['positionID'] . '" ' . $selected . '>' . $rw['positionTitle'] . '</option>';
                            }

                            ?>
                    </select>
                        </div>
                        <div class="mb-3">
                            <label for="officeName" class="form-label">Campus:</label>
                            <select class="form-control" id="office" name="office" required>
                            <?php
                            $currentOffice = $row['office_id'];
                            $q = "SELECT office_id, officeName FROM offices where office_id != 5";
                            $rs = mysqli_query($conn, $q);
                            while ($rw = mysqli_fetch_array($rs)) {
                                $selected = ($rw['office_id'] == $currentOffice) ? 'selected' : '';
                                echo '<option value="' . $rw['office_id'] . '" ' . $selected . '>' . $rw['officeName'] . ' - ' . Getcampus($rw['office_id']) .'</option>';
                               
                            }

                            ?>
                        </select>
                        </div>
                        <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editsign" value="editsign">Edit Signatory</button>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
