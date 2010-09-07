<?php

class knl_lib_doc_AnexoDel {
  private static $instance;
  
  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }
  
  public function DelAnexo(){
  	$request = knl_lib_Registry::getRequest();
  	$request->getGet("id");
  	$request->getGet("doc_id");
  	$request->getGet("doc_anexo");
  	
  	if ($request->getGet("doc_anexo") == 1){
  		knl_dao_doc_anexo::getInstance()->deleteById1Id2($request->getGet("doc_id"),$request->getGet("id"));
  		// 2 e 1  		
  	} else {
  		knl_dao_doc_anexo::getInstance()->deleteById1Id2($request->getGet("id"),$request->getGet("doc_id"));
  		// 1 e 2
  	}
  }
}
?>
