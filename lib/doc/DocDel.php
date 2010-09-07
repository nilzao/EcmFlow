<?php
class knl_lib_doc_DocDel {
  private static $instance;

  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance; 
  }
  
  public function LimpaDoc (){
  	$request = knl_lib_Registry::getRequest();
  	$id_doc = $request->getGet('id');
  	$DocCred = knl_dao_doc_cred::getInstance();
  	$DocCred->deleteByIdDoc($id_doc);
  	$mDocCred = new knl_model_doc_cred(0,$id_doc,1,0,511,0,0);
  	$DocCred->upsert($mDocCred);
  	$docAssina = knl_lib_doc_Assina::getInstance();
  	$docAssina->gravaNoBanco($request->getget('id'),5);
  }
}
?>
