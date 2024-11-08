<div class="modal fade" id="view">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Announcement File</h4>
                <button type="button" class="close" data-dismiss="modal">X</button>
            </div>

            <div class="modal-body">
            <table id="example" class="table table-striped" style="width:100%;">
                <tr class="text-center">
                    <th>Title</th>
                    <th>File</th>
                </tr>

                <?php
                $user_office = $_SESSION['offices'];

                $sql = "SELECT * FROM attachmentdetails where office_tag = $user_office";
                $results = mysqli_query($conn, $sql);
                
                while($row = mysqli_fetch_assoc($results)){

                    $attachmentReferenceNo = $row['attachmentReferenceNo'];
                    $ad_id = $row['ad_id'];

                $sql = "SELECT * FROM attachment where is_released = 1 and attachmentReferenceNo = '$attachmentReferenceNo'";
                $result = mysqli_query($conn, $sql);

               
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $date = date("y-m-s");

                        echo '<form action="../backEnd/viewAuth.php" method="post">
                        <tr>';
                        echo '<input type="text" value="' . $row['attachmentReferenceNo'] . '" name="attachmentReferenceNo" hidden>
                        <input type="text" value="' . $ad_id . '" name="ad_id" hidden>
                         <td class="text-center"><label>' . $row['attachmentTitle'] . '</label></td>';
                        $file_dir = '../Attachment/' . $row['attachmentFile'];
                        echo '<td class="text-center"><button type="submit" title="' . $row['attachmentTitle'] . ' File" name="announcement" onclick="openCustom(\'' .
                        $file_dir . '?' . time() . '\',1000,1000)" class="btn button-s btn-sm"><i class="fa fa-file"></i>
                        Announcement file</button></td></tr>';
                    }

                    echo '</form>';
                }

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