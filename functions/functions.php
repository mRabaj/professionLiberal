<?php

require 'vendor/autoload.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	
	  /* envoi de l'email de confirmation d'inscription ou de mot de passe oublié */
	function sendMail($recipient,$recipient_name,$subject,$body) {
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
			//Server settings
			$mail->SMTPDebug = 0;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'dwwm.rodez.2020@gmail.com';                 // SMTP username
			$mail->Password = 'Afpa_2020';                           // SMTP password
			$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 465;                                    // TCP port to connect to
			$mail->CharSet = 'UTF-8';
			//Recipients
			$mail->setFrom('noreply@cvtheque.com', 'CV-Thèque');
			$mail->addAddress($recipient, $recipient_name);     // Add a recipient


			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $body;
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			return true;
		} catch (Exception $e) {
			//return 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
			return "Le message n'a pas pu être envoyé.";
		}
	}
	
    ?>