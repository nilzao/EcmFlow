<?php
class knl_extensions_dnfsaida_edit extends knl_lib_daoext_Convert {
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
 	
  	$NfSaida = knl_extensions_dnfsaida_dao::getInstance();
  	$mNfSaida = $NfSaida->selectByIdDoc($request->getpost('id'));
  	    $mNfSaida->set_datasai($this->data_br_to_mysql($request->getpost('datasai')));
  	    $mNfSaida->set_id_fornecedor($forn->get_id());
  	    
  	$NfSaida->upsert($mNfSaida);
  }
}
?>