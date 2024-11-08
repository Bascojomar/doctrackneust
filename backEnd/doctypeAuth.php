<?php

include "database.php";
include "../backEnd/function.php";


if (isset($_POST['addDocument'])) {
    $doctypeCode = mysqli_real_escape_string($conn, $_POST['doctypeCode']);
    $doctypeName = mysqli_real_escape_string($conn, $_POST['doctypeName']);



    $query = "SELECT * FROM docktype WHERE doctypeCode = '$doctypeCode' and doctypeName = '$doctypeName'";
    echo $query;
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();
        header("Location: ../frontEnd/doctype?alreadyIn");
       
    } else {


        $q = "INSERT INTO docktype SET doctypeCode='$doctypeCode',
        doctypeName = '$doctypeName'";

        mysqli_query($conn, $q);
        header("Location: ../frontEnd/doctype?addeddocement");
    }
}

    if (isset($_POST['editDocument'])) {
        
        $id = $_POST['id'];
        $doctypeCode =  $_POST['doctypeCode'];
        $doctypeName = $_POST['doctypeName'];

        $query = "SELECT * FROM docktype WHERE  doctypeName = '$doctypeName' AND dt_id != '$id' ";
        
        $result = $conn->query($query);
    
        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();

            header("Location: ../frontEnd/doctype?Alreadyname");
           
        } else {

            $query = "SELECT * FROM docktype WHERE  doctypeCode = '$doctypeCode' AND dt_id != '$id' ";
        
        $result = $conn->query($query);
    
        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();

            header("Location: ../frontEnd/doctype?Alreadycode");
           
        } else {

            $update = mysqli_query($conn, "UPDATE docktype set doctypeName = '$doctypeName', doctypeCode = '$doctypeCode' where dt_id = '$id'" );
            if($update)
            {
               header("Location: ../frontEnd/doctype?updateCampus");
           }


        }

        }

    }



?>