<?php

class knl_lib_doc_DocEdit extends knl_lib_daoext_Convert {
  private static $instance;

  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance; 
  }
  
  public function gravaNoBanco (){
  	$request = knl_lib_Registry::getRequestObj();
 	
  	$Doc = knl_dao_doc::getInstance();
  	$mDoc = $Doc->selectById($request->getpost('id'));
  	    $mDoc->set_id_empresa($request->getpost('id_empresa'));
  	    $mDoc->set_numero($request->getpost('numero'));
  	    $mDoc->set_data_doc($this->data_br_to_mysql($request->getpost('data_doc')));
    $Doc->upsert($mDoc);
    
    $Carimbo = knl_dao_doc_carimbo::getInstance();
    $arrcarimbo = $request->getPost('carimbo');
	if (!empty($arrcarimbo) AND ($arrcarimbo[0]!=0)){
	$Carimbo->deleteByIdDoc($mDoc->get_id());
    $mCarimbo = new knl_model_doc_carimbo(0,$mDoc->get_id(),$arrcarimbo[0]);
    $Carimbo->upsert($mCarimbo);
	}
	
    $DocShow = knl_lib_doc_DocShow::getInstance();
  	$doc = $DocShow->getDocumento($request->getpost('id'));
  	$cabecalho = $DocShow->getDocumentoTipo($doc);
  	$classe = $cabecalho->get_classe();
    
    $DocH = call_user_func("knl_extensions_".$classe."_edit::getInstance");
    $DocH->gravaNoBanco();
    
    $docAssina = knl_lib_doc_Assina::getInstance();
  	$docAssina->gravaNoBanco($request->getpost('id'),6);
  }
}
?>
