<?php
$sql = "SELECT * FROM attachment where is_released = 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="modal fade" id="viewattachment<?php echo $row['attachmentID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Office Seen</h4>
                        <button type="button" class="close" data-dismiss="modal">X</button>
                    </div>

                    <div class="modal-body">
                        <table id="example" class="table table-striped" style="width:100%;">
                            <tr class="text-center">
                                <th>Office</th>
                            </tr>

                            <?php
                            $attachmentReferenceNo = $row['attachmentReferenceNo'];
                            $sql = "SELECT * FROM attachmentdetails WHERE attachmentReferenceNo = '$attachmentReferenceNo' AND isView = 1";
                            $resultDetails = mysqli_query($conn, $sql);

                            while ($rs = mysqli_fetch_assoc($resultDetails)) {
                                $office = OfficeName($rs['office_tag']);
                                // $office = $rs['office_tag'];

                                echo "<tr>
                                        <td class='text-center'>$office</td>
                                      </tr>";
                            }
                            ?>
                        </table>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>