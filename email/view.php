<?php
include("../database.php");
session_start();
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$query = "SELECT * FROM attachment WHERE attachmentReferenceNo = '$attachmentReferenceNo'";
$results = $conn->query($query);

$rows = $results->fetch_assoc();
$attachmentTitle = $rows['attachmentTitle'];

$checkQuery = "SELECT * FROM attachmentdetails WHERE attachmentReferenceNo = '$attachmentReferenceNo'";
$resultt = $conn->query($checkQuery);
   
// $rs = $resultt->fetch_assoc();
// $office_tag = $rs['office_tag'];

$office_tags = [];
while ($rs = $resultt->fetch_assoc()) {
    $office_tags[] = $rs['office_tag'];
}

foreach ($office_tags as $office_tag) {
    $sql = "SELECT * FROM users WHERE offices = '$office_tag'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $email = $row['email'];

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'mail.neust.edu.ph';
            $mail->SMTPAuth = true;
            $mail->Username = 'neustdoctrack@neust.edu.ph';
            $mail->Password = 'CH=eLL~t+!dz'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('neustdoctrack@neust.edu.ph', 'NEUST Document Tracking System');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Email for ' . $email;

            $mail->Body = "*** PLEASE DO NOT REPLY OR SEND MESSAGE TO THIS EMAIL *** <br> <br> <br>
                $attachmentTitle for <br>" . OfficeName($office_tag);

            try {
                $mail->send();
                echo '<span style="color:green;">Email Sent</span> ' . $email . '<br>';
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '<br>';
            }
        }
    } else {
        echo "No users found for office tag: $office_tag<br>";
    }
}


?>