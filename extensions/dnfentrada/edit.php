<?php
class knl_extensions_dnfentrada_edit extends knl_lib_daoext_Convert {
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
 	
  	$NfEntrada = knl_extensions_dnfentrada_dao::getInstance();
  	$mNfEntrada = $NfEntrada->selectByIdDoc($request->getpost('id'));
  	    $mNfEntrada->set_dataent($this->data_br_to_mysql($request->getpost('dataent')));
  	    $mNfEntrada->set_id_fornecedor($forn->get_id());
  	    
  	$NfEntrada->upsert($mNfEntrada);
  }
}
?>