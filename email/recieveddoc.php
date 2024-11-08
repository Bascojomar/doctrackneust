<?php
include("../database.php");
session_start();
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$checkQuery = "SELECT * FROM documenttransac where referenceNo = '$reference'";
$resultt = $conn->query($checkQuery);

$rs = $resultt->fetch_assoc();
$officeCreated = $rs['officeCreated'];
$docusub = $rs['documentSubject'];

$sql = "SELECT * FROM users where offices = $officeCreated";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
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
    $mail->Subject = 'Document Submission Update - ' . $docusub;

    $mail->Body = "<i>Please do not reply to this email.</i> <br><br>
    Dear “<strong><i>" . OfficeName($officeCreated) . "</i></strong>”,<br><br>
    Good day!<br><br>
    We are pleased to inform you that your document titled “<strong>" . $docusub . "</strong>” has been received by <strong>" . OfficeName($office) . "</strong>. Please allow time for the processing of your document to be completed.<br><br>
    If you have any questions or require further assistance, do not hesitate to reach out.<br><br>
    Best regards,<br>
    Document Tracking System<br>
    NUEVA ECIJA UNIVERSITY OF SCIENCE AND TECHNOLOGY<br>
    Management Information System | Development Team<br>
    For inquiries, please email us at neustmain@neust.edu.ph";

    try {
        $mail->send();
        echo '<span style="color:green;">Email Sent</span>';
        echo $email;
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
?>