<?php
include "database.php";
include "../backEnd/function.php";

    if(isset($_POST['announcement'])){
        $attachmentReferenceNo = mysqli_real_escape_string($conn, $_POST['attachmentReferenceNo']);
        $ad_id = mysqli_real_escape_string($conn, $_POST['ad_id']);
        $date = date("y-m-s");
    
        $update = mysqli_query($conn, "UPDATE attachmentdetails set isView = 1, dateView = '$date' where attachmentReferenceNo = '$attachmentReferenceNo' and ad_id = '$ad_id'");
        if ($update) {
            header("Location: ../frontEnd/Attachment");
        }
    }

?>