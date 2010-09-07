<?php
require_once "class.phpmailer.php";
class knl_lib_doc_DocMail {
  private static $instance;
  
  private function construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }

  public function enviaMail(knl_model_doc $mDoc,$destinatario,$body){
  	$docFull = knl_lib_doc_DocShow::getInstance()->getDocumentoFull($mDoc);
  	$mail = new PHPMailer();
  	//print_r($docFull);print_r($mDoc);
  	
  	$mail->AddReplyTo("contato@capitalphp.com.br","CapitalPhp");
		
	$mail->Subject    = "Envio de ".$docFull["docTipo"]->get_descricao()." Número: ".$mDoc->get_numero();
	
	
	//$address = "andre@capitalphp.com.br";
	$mail->AddAddress($destinatario, "");
  	
  	for ($i = 1;$i<=$mDoc->get_pag();$i++){
  		$nomearq = "./img/doc/".$mDoc->get_id()."_".$i.".jpg";
  		//echo "<img src=\"$nomearq\">";
  		$mail->AddAttachment($nomearq);
  	}
  	$body = nl2br($body);
  	
  	knl_lib_SendMail::getInstance()->envia($mail,$body);

  }
  
}
?>