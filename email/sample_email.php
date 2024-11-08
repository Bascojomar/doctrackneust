<?php
	include('../backend/database.php');
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'PHPMailer/Exception.php';
	require 'PHPMailer/PHPMailer.php';
	require 'PHPMailer/SMTP.php';
		
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'doctracksystem.mgt@gmail.com';
        $mail->Password = 'mfiylmhshzjzyaik';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('doctracksystem.mgt@gmail.com', 'Document Tracking System');
		$mail->addAddress('darrencelzo77@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'Sample Email';


        $mail->Body = 'Sample Darren Reyjohn';
        
        try {
            $mail->send();
			echo '<span style="color:green;">Email Sent</span>';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

$conn->close();

?>
