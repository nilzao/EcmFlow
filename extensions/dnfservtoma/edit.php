<?php
class knl_extensions_dnfservtoma_edit extends knl_lib_daoext_Convert {
  private static $instance;

  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance; 
  }
  
  public function gravaNoBanco(){
  	$request = knl_lib_Registry::getRequestObj();

  	$forn = knl_extensions_cadastronf_cadedit::getInstance()->gravaNoBanco();
 	
  	$NfServToma = knl_extensions_dnfservtoma_dao::getInstance();
  	$mNfServToma = $NfServToma->selectByIdDoc($request->getpost('id'));
  	    $mNfServToma->set_dataent($this->data_br_to_mysql($request->getpost('dataent')));
  	    $mNfServToma->set_id_fornecedor($forn->get_id());
  	    
  	$NfServToma->upsert($mNfServToma);
  }
}
?>