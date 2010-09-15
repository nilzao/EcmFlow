<?php
require_once "class.phpmailer.php";

class knl_lib_SendMail {
  private static $instance;
  
  private function construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }

	public function envia(PHPMailer $mail,$body){
		//$mail             = new PHPMailer();
		
		//$body             = file_get_contents('contents.html');
		//$body             = eregi_replace("[\]",'',$body);
		$body = $body."\n\n<br><br>
		---------------------------------------------------------------------------------------------------------------<br>
		Documento enviado pelo sistema EcmFlow <a href=\"http://www.capitalphp.com.br/\">www.capitalphp.com.br</a><br>
		Seus documentos sempre a sua disposição<br><br>";
		
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "smtp.gmail.com"; // SMTP server
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
		                                           // 1 = errors and messages
		                                           // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "alguem@gmail.com";  // GMAIL username
		$mail->Password   = "passwd123";            // GMAIL password
		
		$mail->SetFrom('alguem@gmail.com', 'Documento EcmFlow');
		/*
		$mail->AddReplyTo("name@yourdomain.com","First Last");
		
		$mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";
		
		//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		
		
		
		$address = "john@gmail.com.br";
		$mail->AddAddress($address, "John Doe");
		*/
		//$mail->AddAttachment("images/phpmailer.gif");      // attachment
		//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
		
		$mail->MsgHTML($body);
		
		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		} 
	}
  
}
?>