<?php
class knl_extensions_dcaixa_edit extends knl_lib_daoext_Convert {
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

  	$Caixa = knl_extensions_dcaixa_dao::getInstance();
  	$mCaixa = $Caixa->selectByIdDoc($request->getpost('id'));
  	    $mCaixa->set_data_ini($this->data_br_to_mysql($request->getpost('data_ini')));
  	    $mCaixa->set_data_fim($this->data_br_to_mysql($request->getpost('data_fim')));
  	    
  	$Caixa->upsert($mCaixa);
  	//print_r($_POST);
  }
}
?>