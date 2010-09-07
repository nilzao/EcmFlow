<?php

class knl_lib_doc_Assina {
  private static $instance;

  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance; 
  }
  
  public function gravaNoBanco ($id_doc,$id_doc_assinatura_tipo = 1){
  	$session = knl_lib_Registry::getSession();
  	$newAssinatura = new knl_model_doc_assinatura(0,$id_doc,$id_doc_assinatura_tipo,$session->get_id_usuario(),date("Y-m-d H:i:s"),'S');
  	knl_dao_doc_assinatura::getInstance()->upsert($newAssinatura);
  }
}
?>
