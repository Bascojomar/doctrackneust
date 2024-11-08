<?php
error_reporting(0);

include "database.php";
include "function.php";

// include '(../barcode/barcode.php)';
session_start();
// require __DIR__ . '../../vendor2/autoload.php';

//start
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $date = date("ymd");
    $officeCreated = $_POST['officecreated'];
    $docCode = 'NEUST' . $date . '-' . $officeCreated . '-' . GenerateRandomString();
    $referenceNo = $officeCreated . $date . GenerateRandomString();
    $subject = $_POST['subject'];
    $docuType = $_POST['docutype'];
    $userCreated = $_POST['userCreated'];

    $vouchertype = $_POST['vouchertype'];
    $voucherno = $_POST['voucherno'];
    $voucheramt = $_POST['voucheramt'];

    if ($docuType == 3 && 2) {
        $is_voucher = 1;
    } else {
        $is_voucher = 0;
    }

    try {
        // Create a new PDO connection
        $dbconnin = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
        $dbconnin->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //  barcode('../barcode/'.$referenceNo.'.png',$docCode, 50, "horizontal", "code128", true, 1);

        if (isset($_FILES["uploadfile"]["name"]) && $_FILES["uploadfile"]["error"] == 0) {
            $pdf = basename($_FILES["uploadfile"]["name"]);
            $uploadDir = '../pdf/';
            $uploadValue = $uploadDir . basename($_FILES["uploadfile"]["name"]);
            $uploadFileTemp = $_FILES["uploadfile"]["tmp_name"];


            // Move the uploaded file to the directory
            if (move_uploaded_file($uploadFileTemp, $uploadValue)) {
                $queryin = "INSERT INTO documenttransac (documentCode, referenceNo, officeCreated, documentSubject, dt_id, fileUpload, userCreated, is_voucher) 
                            VALUES (:docCode, :referenceNo, :officeCreated, :subject, :docuType, :fileUpload, :userCreated, :is_voucher)";
                $qin = $dbconnin->prepare($queryin);

                // Bind parameters to the statement
                $qin->bindParam(':docCode', $docCode);
                $qin->bindParam(':referenceNo', $referenceNo);
                $qin->bindParam(':officeCreated', $officeCreated);
                $qin->bindParam(':subject', $subject);
                $qin->bindParam(':docuType', $docuType);
                $qin->bindParam(':fileUpload', $pdf);
                $qin->bindParam(':userCreated', $userCreated);
                $qin->bindParam(':is_voucher', $is_voucher);

                $qin->execute();

                if ($docuType == 3 && 2) {
                    $is_voucher = 1;
                    $q = "INSERT INTO documentvoucher SET
                        referenceNo='$referenceNo',
                        vType = '$vouchertype',
                        vAmmount = '$voucheramt',
                        vNumber = '$voucherno' ";

                    mysqli_query($conn, $q);
                }

                // add  voucher

                header("Location: ../frontEnd/document?addeddocement");

            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "No uploaded file.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//end code

//start

if (isset($_POST['addoffice'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $attachmentReferenceNo = $_POST['attachmentReferenceNo'];
    $offices = isset($_POST['offices']) ? $_POST['offices'] : [];

    $attachmentReferenceNo = mysqli_real_escape_string($conn, $attachmentReferenceNo);

    if (!empty($offices)) {
        mysqli_begin_transaction($conn);

        try {
            foreach ($offices as $office_id) {
                $office_id = intval($office_id);
                
                $check_query = "SELECT COUNT(*) AS count FROM attachmentdetails WHERE attachmentReferenceNo = '$attachmentReferenceNo' AND office_tag = $office_id";
                $result = mysqli_query($conn, $check_query);
                $row = mysqli_fetch_assoc($result);

                if ($row['count'] == 0) {
                    $insert_query = "INSERT INTO attachmentdetails (attachmentReferenceNo, office_tag) VALUES ('$attachmentReferenceNo', $office_id)";
                    mysqli_query($conn, $insert_query);
                    header("Location: ../frontEnd/createAnn?send");
                }
            }

            mysqli_commit($conn);
            header("Location: ../frontEnd/createAnn?send");
        } catch (Exception $e) {
            mysqli_rollback($conn);
            echo "Failed to update records: " . $e->getMessage();
        }
    } else {
        echo "No office selected.";
    }
}

//end code

//start

if (isset($_POST['sendTo'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $campusGet = mysqli_real_escape_string($conn, $_POST['campusGet']);

    if ($campusGet == 1 || $campusGet == 2) {
        $is_mainRecord = 1;
    } else {
        $is_mainRecord = 2;
    }

    $update = mysqli_query($conn, "UPDATE documenttransac set  is_mainRecord = '$is_mainRecord' where docu_id = '$id'");
    if ($update) {

        include '../email/senTocampus.php';
        header("Location: ../frontEnd/recordDocument?send");
    }



}

//end code

//start

if (isset($_POST['sendTomain'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);


    $update = mysqli_query($conn, "UPDATE documenttransac set  is_mainRecord = 1, is_mainStatus = 1 where docu_id = '$id'");
    if ($update) {

        include '../email/sentTomain.php';
        header("Location: ../frontEnd/recordDocument?send");
        
}
}

//end code

//start

if (isset($_POST['editsub'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Check if a new subject is provided
    if (isset($_POST['subject'])) {
        $subject = $_POST['subject'];
        $updateSubject = mysqli_query($conn, "UPDATE documenttransac SET documentSubject = '$subject' WHERE docu_id = '$id'");
        if (!$updateSubject) {
            // Handle update subject failure
            echo "Update subject failed. Please try again.";
            exit();
        }
    }

    // Check if a new file is uploaded
    if (isset($_FILES["file"]["name"]) && $_FILES["file"]["error"] == 0) {
        $pdf = basename($_FILES["file"]["name"]);
        $uploadDir = '../pdf/';
        $uploadValue = $uploadDir . basename($_FILES["file"]["name"]);
        $uploadFileTemp = $_FILES["file"]["tmp_name"];

        // Move the uploaded file to the directory
        if (move_uploaded_file($uploadFileTemp, $uploadValue)) {
            $updateFile = mysqli_query($conn, "UPDATE documenttransac SET fileUpload = '$pdf' WHERE docu_id = '$id'");
            if (!$updateFile) {
                echo "Update file name failed. Please try again.";
                exit();
            }
        } else {
            echo "File upload failed. Please try again.";
            exit();
        }
    }

    header("Location: ../frontEnd/document?send");
    exit();
}

//end code

//start

if (isset($_POST['office'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Check if a new subject is provided
    if (isset($_POST['subject'])) {
        $subject = $_POST['subject'];
        $updateSubject = mysqli_query($conn, "UPDATE documenttransac SET documentSubject = '$subject' WHERE docu_id = '$id'");
        if (!$updateSubject) {
            echo "Update subject failed. Please try again.";
            exit(); 
        }
    }

    // Check if a new file is uploaded
    if (isset($_FILES["file"]["name"]) && $_FILES["file"]["error"] == 0) {
        $pdf = basename($_FILES["file"]["name"]);
        $uploadDir = '../pdf/';
        $uploadValue = $uploadDir . basename($_FILES["file"]["name"]);
        $uploadFileTemp = $_FILES["file"]["tmp_name"];

        // Move the uploaded file to the directory
        if (move_uploaded_file($uploadFileTemp, $uploadValue)) {
            $updateFile = mysqli_query($conn, "UPDATE documenttransac SET fileUpload = '$pdf' WHERE docu_id = '$id'");
            if (!$updateFile) {
                echo "Update file name failed. Please try again.";
                exit();
            }
        } else {
            echo "File upload failed. Please try again.";
            exit(); 
        }
    }

    header("Location: ../frontEnd/document?send");
    exit();
}

//end code

//start

if (isset($_POST['mainrecord'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Check if a new subject is provided
    if (isset($_POST['subject'])) {
        $subject = $_POST['subject'];
        $updateSubject = mysqli_query($conn, "UPDATE documenttransac SET documentSubject = '$subject' WHERE docu_id = '$id'");
        if (!$updateSubject) {
            echo "Update subject failed. Please try again.";
            exit();
        }
    }

    // Check if a new file is uploaded
    if (isset($_FILES["file"]["name"]) && $_FILES["file"]["error"] == 0) {
        $pdf = basename($_FILES["file"]["name"]);
        $uploadDir = '../pdf/';
        $uploadValue = $uploadDir . basename($_FILES["file"]["name"]);
        $uploadFileTemp = $_FILES["file"]["tmp_name"];

        // Move the uploaded file to the directory
        if (move_uploaded_file($uploadFileTemp, $uploadValue)) {
            $updateFile = mysqli_query($conn, "UPDATE documenttransac SET fileUpload = '$pdf' WHERE docu_id = '$id'");
            if (!$updateFile) {
                echo "Update file name failed. Please try again.";
                exit();
            }
        } else {
            echo "File upload failed. Please try again.";
            exit(); 
        }
    }
    
    header("Location: ../frontEnd/recordDocument?send");
    exit();
}

//end code

//start

if (isset($_POST['sendTo'])) {

    $id = mysqli_real_escape_string($conn, $_POST['id']); 
    $campusGet = mysqli_real_escape_string($conn, $_POST['campusGet']);

    $sql = "SELECT * FROM documenttransac WHERE docu_id = '$id'";
    $r = mysqli_query($conn, $sql);

    if ($r) {
        if (mysqli_num_rows($r) > 0) {
            $updateQuery = "UPDATE documenttransac SET is_mainRecord = 2 , is_mainStatus = 2 WHERE docu_id = '$id'";
            $result = mysqli_query($conn, $updateQuery);

            if ($result) {
                include '../email/senTocampus.php';
                header("Location: ../frontEnd/document?send");
                exit();
            } else {
                echo "Update failed: " . mysqli_error($conn);
            }
        } else {
            echo "No record found for docu_id = $id";
        }
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }
}
//end code

//start

// no sweet alert - old created

if(isset($_POST['is_released'])){
    $attachmentReferenceNo = mysqli_real_escape_string($conn, $_POST['attachmentReferenceNo']);

    $update = mysqli_query($conn, "UPDATE attachment set  is_released = 1 where attachmentReferenceNo = '$attachmentReferenceNo'");
    if ($update) {
        
        include '../email/view.php';

        header("Location: ../frontEnd/createAnn?send");
    }
}
//end code

//start

if (isset($_POST['sendTosign'])) {
    $referenceNo = mysqli_real_escape_string($conn, $_POST['referenceNo']);

    $updatestat = mysqli_query($conn, "UPDATE documenttransac set  is_mainStatus = 3 where referenceNo = '$referenceNo'");
    $update = mysqli_query($conn, "UPDATE documentdetails set  status = 2 where referenceNo = '$referenceNo'");
    if ($update) {
        include '../email/signatory.php';
        header("Location: ../frontEnd/recordDocument?signator");
    }
}

//end code

//start

if (isset($_POST['receivedby'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $received = $_POST['received'];
    $contact = $_POST['contact'];
    $date = $_POST['date'];


    $update = mysqli_query($conn, "UPDATE documenttransac set  is_mainStatus = 7, recieveBy = '$received', contactNo = '$contact', dateRecievedby = '$date' where docu_id = '$id'");
    if ($update) {
        include '../email/receivedBy.php';
        header("Location: ../frontEnd/recordArchive?signator");
    }
}

//end code

//start

if (isset($_POST['reupload'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    if (isset($_FILES["file"]["name"])) {
        if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
            $uploadDir = "../pdf/";
            $uploadFile = basename($_FILES["file"]["name"]);

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile)) {
                // File uploaded successfully, now update database
                $uploadValue = $uploadFile;

                $updateQuery = "UPDATE documenttransac SET newUpload = '$uploadFile' WHERE docu_id = '$id'";
                $result = $conn->query($updateQuery);
                if ($result) {
                    header("Location: ../frontEnd/recordArchive?signator");
                }
            }
        }
    }
}

//end code

//start

if (isset($_POST['signed'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $referenceNo = mysqli_real_escape_string($conn, $_POST['referenceNo']);
    $remarks = $_POST['remarks'];
    $status = $_POST['status'];
    $date = $_POST['date'];

    if ($status == 5) {
        $update = mysqli_query($conn, "UPDATE documentdetails set dateSigned = '$date', status = $status, remarks = '$remarks' where dd_id = '$id'");
        if ($update) {
            include '../email/signed.php';
            header("Location: ../frontEnd/receivedDoc?signator");
        }
    } elseif ($status == 6) {
        $update = mysqli_query($conn, "UPDATE documentdetails set remarks = '$remarks', status = $status where dd_id = '$id'");
        if ($update) {
            include '../email/reject.php';
            header("Location: ../frontEnd/receivedDoc?signator");
        }
    }
}

//end code

//start

if (isset($_POST['released'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = $_POST['status'];
    $date = $_POST['date'];
    $reference = mysqli_real_escape_string($conn, $_POST['reference']);

    if ($status == 3) {
        // Update the document details with the new release date and status
        $update = mysqli_query($conn, "UPDATE documentdetails SET dateRelease = '$date', status = $status WHERE dd_id = '$id'");
    
        if (!$update) {
            die("Error updating document details: " . mysqli_error($conn));
        }
    
        // Count the total number of records with the same reference number
        $totalQuery = "SELECT COUNT(*) as total FROM documentdetails WHERE referenceNo = '$reference'";
        $totalResult = $conn->query($totalQuery);
        if (!$totalResult) {
            die("Error counting total records: " . mysqli_error($conn));
        }
        $totalRow = $totalResult->fetch_assoc();
        $totalRecords = $totalRow['total'];
    
        // Count the number of records that have already been processed (status = 3)
        $processedQuery = "SELECT COUNT(*) as indexing FROM documentdetails WHERE referenceNo = '$reference' AND status = 3";
        $processedResult = $conn->query($processedQuery);
        if (!$processedResult) {
            die("Error counting processed records: " . mysqli_error($conn));
        }
        $processedRow = $processedResult->fetch_assoc();
        $processedRecords = $processedRow['indexing'];
    
        // If all records are processed, update is_mainStatus in documenttransac
        if ($totalRecords == $processedRecords) {
            if (!include '../email/done.php') {
                echo "Could not include done.php";
            }
            $updateTransac = mysqli_query($conn, "UPDATE documenttransac SET is_mainStatus = 4, remarks = 'All Released' WHERE referenceNo = '$reference'");
            if (!$updateTransac) {
                die("Error updating document transaction: " . mysqli_error($conn));
            }
        }
    
        // Send the release email and redirect
        if (!include '../email/release.php') {
            echo "Could not include release.php";
        }
        header("Location: ../frontEnd/receivedDoc?signator");
        exit();
    }
    
}
//end code

?>