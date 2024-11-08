<?php
include "database.php";
include "function.php";
session_start();

if (isset($_POST['saves'])) {

    $date = date("-m-d-Y-");  // Corrected date format
    $officeCreated = $_POST['officecreated'];
    $attachmentReferenceNo = $officeCreated . $date . GenerateRandomStringRef();
    $title = $_POST['attachmentTitle'];
    $user_id = $_POST['user_id'];
    $dateUploaded = $_POST['dateUpload'];

    try {
        // Create a new PDO connection
        $dbconnin = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $dbconnin->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the file upload is set
        if (isset($_FILES["uploadfile"]["name"]) && $_FILES["uploadfile"]["error"] == 0) {
            $attachmentFile = basename($_FILES["uploadfile"]["name"]);
            $uploadDir = '../Attachment/';
            $uploadFilePath = $uploadDir . $attachmentFile;
            $uploadFileTemp = $_FILES["uploadfile"]["tmp_name"];

            // Move the uploaded file to the desired directory
            if (move_uploaded_file($uploadFileTemp, $uploadFilePath)) {
                // Prepare and execute the SQL query to insert data
                $queryin = "INSERT INTO attachment (attachmentReferenceNo, attachmentTitle, attachmentFile, user_id) 
                            VALUES (:attachmentReferenceNo, :title, :attachmentFile, :user_id)";
                $qin = $dbconnin->prepare($queryin);

                // Bind parameters to the prepared statement
                $qin->bindParam(':attachmentReferenceNo', $attachmentReferenceNo);
                $qin->bindParam(':title', $title);
                $qin->bindParam(':attachmentFile', $attachmentFile);
                $qin->bindParam(':user_id', $user_id);

                // Execute the statement
                $qin->execute();

                // Redirect after successful insertion
                header("Location: ../frontEnd/createAnn");
                exit(); // Ensure no further code is executed
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "No uploaded file.";
            // Optionally redirect with an error message
            // header("Location: ../frontEnd/document?upload_error");
            // exit();
        }
    } catch (PDOException $e) {
        // Display error message
        echo "Error: " . $e->getMessage();
    }
}
?>
