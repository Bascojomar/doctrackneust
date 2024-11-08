<?php
	
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
		$mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'NEW USER CREDENTIALS';


        $mail->Body = '*** PLEASE DO NOT REPLY OR SEND MESSAGE TO THIS EMAIL *** <br> <br> <br>
		Good day '.$fullname.' <br> <br>
		Below is your Login Credentials <br>
        Email: '.$email.' <br>
        Password: '.$Password.'
		<br> <br>
		do not share

		Thankyou.
		<br>
		<br>
        For inquiries, please call (044) 336-0272 or E-mail us at doctracksystem.@gmail.com <br>
		Document Tracking System.
		
		
		';
        
        try {
            $mail->send();
			echo '';
			echo '<span style="color:green;">Email Sent</span>';
			
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

$conn->close();

?>
