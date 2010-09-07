<?php

class knl_lib_doc_AnexoAdd {
  private static $instance;
  
  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }
  
  public function AddAnexo(){
  	$session = knl_lib_Registry::getSession();
  	$request = knl_lib_Registry::getRequest();
  	$doc_anexo = $request->getGet('doc_anexo');
  	
  	if (empty($doc_anexo)){
  	    $id_doc1 = $request->getGet('idanexo');
  	    $id_doc2 = $request->getGet('doc_id');
  	}else{
  		$id_doc1 = $request->getGet('doc_id');
  	    $id_doc2 = $request->getGet('idanexo');
  	}
  	
  	$newmDocAnexo = new knl_model_doc_anexo(0,$id_doc1,$id_doc2,date("Y-m-d H:i:s"),$session->get_id_usuario(),0,0,0);
  	$DocAnexo = knl_dao_doc_anexo::getInstance()->upsert($newmDocAnexo);
  	return $DocAnexo;
  }

}
?>
