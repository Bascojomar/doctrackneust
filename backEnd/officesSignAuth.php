<?php
include "database.php";
include "../backEnd/function.php";


if (isset($_POST['addOfficeSign'])) {
    $signatory = mysqli_real_escape_string($conn, $_POST['sn']);
    $Position = mysqli_real_escape_string($conn, $_POST['sp']);
    $office_id = mysqli_real_escape_string($conn, $_POST['office']);




    $query = "SELECT * FROM officesignatory WHERE position_ID = '$Position' and office_id = '$office_id'";

    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();
        header("Location: ../frontEnd/officesignatory?alreadyIn");
       
    } else {


        $q = "INSERT INTO officesignatory    SET signatory='$signatory',
        position_ID = '$Position',
        office_id = '$office_id' ";

        mysqli_query($conn, $q);
        header("Location: ../frontEnd/officesignatory?addedsignatory");
    }
}

    if (isset($_POST['editsign'])) {
        
        $id = $_POST['id'];
        $signatory =  $_POST['sn'];
        $position_id = $_POST['sp'];
        $office_id = mysqli_real_escape_string($conn, $_POST['office']);

       echo $id ; 
       echo "<br>";
       echo $signatory ; 
       echo "<br>";
       echo $position_id ; 
       echo "<br>";
       echo $office_id ; 
       echo "<br>";

       $query = "SELECT * FROM officesignatory WHERE  position_id = '$position_id' and $office_id = $office_id AND os_id != '$id' ";
        
       $result = $conn->query($query);
   
       if ($result->num_rows == 1) {
           $user_data = $result->fetch_assoc();

        header("Location: ../frontEnd/officesignatory?xPosition");
          
       }
       else{
        $update = mysqli_query($conn, "UPDATE officesignatory set signatory = '$signatory', position_id = '$position_id' , office_id = '$office_id' where os_id = '$id'" );
            if($update)
            {
               header("Location: ../frontEnd/officesignatory?updatesign");
           }
       }
    }



?>