<?php
class knl_extensions_dextrato_edit extends knl_lib_daoext_Convert {
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

  	$Extrato = knl_extensions_dextrato_dao::getInstance();
  	$mExtrato = $Extrato->selectByIdDoc($request->getpost('id'));
  		$mExtrato->set_id_conta($request->getPost('id_conta'));
  	    $mExtrato->set_data_ini($this->data_br_to_mysql($request->getpost('data_ini')));
  	    $mExtrato->set_data_fim($this->data_br_to_mysql($request->getpost('data_fim')));
  	    
  	$Extrato->upsert($mExtrato);
  	//print_r($_POST);
  }
}
?>