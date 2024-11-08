<div class="modal fade" id="campusModal" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="campusModalLabel">Add Campus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="../backEnd/campusAuth.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="campusCode" class="form-label">Campus Code:</label>
                            <input type="text" class="form-control" id="campusCode" name="campusCode" required>
                        </div>
                        <div class="mb-3">
                            <label for="campusName" class="form-label">Campus Name:</label>
                            <input type="text" class="form-control" id="campusName" name="campusName" required>
                        </div>
                        <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addCampus" value="addCampus">Add Campus</button>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModaledit<?php echo $row['campus_id'];?>" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="campusModalLabel">Edit Campus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="../backEnd/campusAuth.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="campusCode" class="form-label">Campus Code:</label>
                            <input type="text" class="form-control" id="campusCode" name="id" value="<?php echo $row['campus_id'];?>" >
                            <input type="text" class="form-control" id="campusCode" name="campusCode" value="<?php echo $row['campusCode'];?>" >
                        </div>
                        <div class="mb-3">
                            <label for="campusName" class="form-label">Campus Name:</label>
                            <input type="text" class="form-control" id="campusName" name="campusName" value="<?php echo $row['campusName'];?>">
                        </div>
                        <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editCampus" value="editCampus">Edit Campus</button>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    