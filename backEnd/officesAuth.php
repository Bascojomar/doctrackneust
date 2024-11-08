<?php
include "database.php";
include "../backEnd/function.php";


if (isset($_POST['addOffice'])) {
    $officeCode = mysqli_real_escape_string($conn, $_POST['officeCode']);
    $officeName = mysqli_real_escape_string($conn, $_POST['officeName']);
    $campus = mysqli_real_escape_string($conn, $_POST['campus']);




    $query = "SELECT * FROM offices WHERE officeCode = '$officeCode' and officeName = '$officeName'";
    echo $query;
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();
        header("Location: ../frontEnd/offices?alreadyIn");
       
    } else {


        $q = "INSERT INTO offices SET officeCode='$officeCode',
        officeName = '$officeName',
        campus = '$campus' ";

        mysqli_query($conn, $q);
        header("Location: ../frontEnd/offices?addedoffices");
    }
}

    if (isset($_POST['editOffice'])) {
        
        $id = $_POST['id'];
        $officeCode =  $_POST['officeCode'];
        $officeName = $_POST['officeName'];
        $campus = mysqli_real_escape_string($conn, $_POST['campus']);

        $query = "SELECT * FROM offices WHERE  officeName = '$officeName' AND office_id != '$id' ";
        
        $result = $conn->query($query);
    
        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();

            header("Location: ../frontEnd/offices?Alreadyname");
           
        } else {

            $query = "SELECT * FROM offices WHERE  officeCode = '$officeCode' AND office_id != '$id' ";
        
        $result = $conn->query($query);
    
        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();

            header("Location: ../frontEnd/offices?Alreadycode");
           
        } else {

            $update = mysqli_query($conn, "UPDATE offices set officeCode = '$officeCode', officeName = '$officeName' , campus = '$campus' where office_id = '$id'" );
            if($update)
            {
               header("Location: ../frontEnd/offices?updateoffices");
           }


        }

        }

    }



?>