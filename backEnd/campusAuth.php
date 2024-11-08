<?php
include "database.php";
include "../backEnd/function.php";


if (isset($_POST['addCampus'])) {
    $campusCode = mysqli_real_escape_string($conn, $_POST['campusCode']);
    $campusName = mysqli_real_escape_string($conn, $_POST['campusName']);



    $query = "SELECT * FROM campus WHERE campusCode = '$campusCode' and campusName = '$campusName'";
    echo $query;
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();
        header("Location: ../frontEnd/campus?alreadyIn");
       
    } else {


        $q = "INSERT INTO campus SET campusCode='$campusCode',
        campusName = '$campusName'";

        mysqli_query($conn, $q);
        header("Location: ../frontEnd/campus?addedcampus");
    }
}

    if (isset($_POST['editCampus'])) {
        
        $id = $_POST['id'];
        $campusCode =  $_POST['campusCode'];
        $campusName = $_POST['campusName'];

        $query = "SELECT * FROM campus WHERE  campusName = '$campusName' AND campus_id != '$id' ";
        
        $result = $conn->query($query);
    
        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();

            header("Location: ../frontEnd/campus?Alreadyname");
           
        } else {

            $query = "SELECT * FROM campus WHERE  campusCode = '$campusCode' AND campus_id != '$id' ";
        
        $result = $conn->query($query);
    
        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();

            header("Location: ../frontEnd/campus?Alreadycode");
           
        } else {

            $update = mysqli_query($conn, "UPDATE campus set campusCode = '$campusCode', campusName = '$campusName' where campus_id = '$id'" );
            if($update)
            {
               header("Location: ../frontEnd/campus?updateCampus");
           }


        }

        }

    }



?>