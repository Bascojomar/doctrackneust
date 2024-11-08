<?php
include("../database.php");
session_start();
require '../vendor/autoload.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;


    $checkQuery = "SELECT * FROM documenttransac where docu_id = '$id'";
    $resultt = $conn->query($checkQuery);
  
    $rs = $resultt->fetch_assoc();
    $officeCreated = $rs['officeCreated'];
    $receivedby = $rs['receivedBy'];
    $contact = $rs['contactNo'];
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
        $mail->Subject = 'Email for '.$email.'';


        $mail->Body = "*** PLEASE DO NOT REPLY OR SEND MESSAGE TO THIS EMAIL *** <br> <br> <br>
        Received By '.$receivedby.' Contact Number '.$contact.'";
        
        try { 
            $mail->send();
			echo '<span style="color:green;">Email Sent</span>';
            echo $email;
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
?>
