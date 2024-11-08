<?php
include "database.php";
include "function.php";

if (isset($_POST['add_signatory'])) {
    $signatory_array = $_POST['signatory_ar'];
    $document_id = $_POST['document_id'];
    $referenceNo = GetData('select referenceNo from documenttransac where docu_id='.$document_id);
    $count=1;
    foreach($signatory_array as $os_id) {
        mysqli_query($conn,'INSERT INTO documentdetails SET office_tag='.
			mysqli_real_escape_string($conn,$os_id).', referenceNo=\''.
			mysqli_real_escape_string($conn,$referenceNo).'\',
			indexing='.$count++.' ');
        header('Location: ../frontEnd/document?success');
    }
}

if(isset($_POST['edit_signatory'])){
	echo'edit me';
}
?>