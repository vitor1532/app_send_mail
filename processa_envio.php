<?php
	
	require "./biblioteca/PHPMailer/Exception.php";
	require "./biblioteca/PHPMailer/OAuth.php";
	require "./biblioteca/PHPMailer/PHPMailer.php";
	require "./biblioteca/PHPMailer/POP3.php";//recebimento de email
	require "./biblioteca/PHPMailer/SMTP.php";//envio de email

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	class Mensagem {

		private $para = null;
		private $assunto = null;
		private $mensagem = null;

		public function __get($attr) {

			return $this->$attr;

		}

		public function __set($atributo, $valor) {

			$this->$atributo = $valor;

		}

		public function mensagemValida() {
			if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
				return false;
			}
			return true;
		}

	}

	$mensagem = new Mensagem();

	$mensagem->__set('para', $_POST['para']);
	$mensagem->__set('assunto', $_POST['assunto']);
	$mensagem->__set('mensagem', $_POST['mensagem']);


	//print_r($mensagem);

	if(!$mensagem->mensagemValida()) {

		echo 'Mensagem é válida';
		die();

	} 

	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = 2;                      //Enable verbose debug output
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = 'alcachofrafrederico@gmail.com';                     //SMTP username
	    $mail->Password   = 'Alcachofra123';                               //SMTP password
	    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
	    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	    

	    //Recipients
	    $mail->setFrom('alcachofrafrederico@gmail.com', 'alcachofra remetente');
	    $mail->addAddress('alcachofrafrederico@gmail.com', 'alcachofra destinatário');     //Add a recipient
	    //$mail->addReplyTo('alcachofrafrederico@gmail.com', 'Information');
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('bcc@example.com');

	    //Attachments
	   // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
	   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = 'Eu sou o assunto';
	    $mail->Body    = '<strong>Oi, eu sou o conteúdo do email</strong>';
	    $mail->AltBody = 'eu sou o conteúdo alternativo';

	    $mail->send();
	    echo 'Message has been sent';
	} catch (Exception $e) {
	    echo "Deu ruim, tenta mais tarde. Mailer Error: {$mail->ErrorInfo}";
	}

?>