<?php
class knl_extensions_dnfservprest_edit extends knl_lib_daoext_Convert {
  private static $instance;

  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance; 
  }
  
  public function gravaNoBanco(){
  	$request = knl_lib_Registry::getRequest();

  	$forn = knl_extensions_cadastronf_cadedit::getInstance()->gravaNoBanco();
 	
  	$NfServPrest = knl_extensions_dnfservprest_dao::getInstance();
  	$mNfServPrest = $NfServPrest->selectByIdDoc($request->getpost('id'));
  	    $mNfServPrest->set_datasai($this->data_br_to_mysql($request->getpost('datasai')));
  	    $mNfServPrest->set_id_fornecedor($forn->get_id());
  	    
  	$NfServPrest->upsert($mNfServPrest);
  }
}
?>