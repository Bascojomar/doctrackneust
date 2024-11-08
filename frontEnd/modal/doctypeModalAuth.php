<div class="modal fade" id="doctypeModal" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="campusModalLabel">Document Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="../backEnd/doctypeAuth.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="campusCode" class="form-label">Document Code:</label>
                            <input type="text" class="form-control" id="doctypeCode" name="doctypeCode" required>
                        </div>
                        <div class="mb-3">
                            <label for="campusName" class="form-label">Document Title:</label>
                            <input type="text" class="form-control" id="doctypeName" name="doctypeName" required>
                        </div>
                        <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addDocument" value="addDocument">Add Document</button>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="doctypeModaledit<?php echo $row['dt_id']; ?>" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="campusModalLabel"> Edit Document Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="../backEnd/doctypeAuth.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                        <input type="text" class="form-control" id="doctypeCode" name="id" value="<?php echo $row['dt_id'];?>" hidden>
                            <label for="campusCode" class="form-label">Document Code:</label>
                            <input type="text" class="form-control" id="doctypeCode" name="doctypeCode" value="<?php echo $row['doctypeCode'];?>" >
                        </div>
                        <div class="mb-3">
                            <label for="campusName" class="form-label">Document Title:</label>
                            <input type="text" class="form-control" id="doctypeName" name="doctypeName" value="<?php echo $row['doctypeName'];?>">
                        </div>
                        <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editDocument" value="editDocument">Edit Document</button>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
