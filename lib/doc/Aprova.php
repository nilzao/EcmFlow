<?php

class knl_lib_doc_Aprova {
  private static $instance;

  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance; 
  }
  
  public function Aprovado ($id_doc){
  	$Assina = knl_lib_doc_Assina::getInstance();
  	$Assina->gravaNoBanco($id_doc,2);
  }
  
  public function Reprovado ($id_doc){
  	$Assina = knl_lib_doc_Assina::getInstance();
  	$Assina->gravaNoBanco($id_doc,3);
  }
}
?>
