<?php
class knl_extensions_dctapagar_edit extends knl_lib_daoext_Convert {
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
 	
  	$CtaPagar = knl_extensions_dctapagar_dao::getInstance();
  	$mCtaPagar = $CtaPagar->selectByIdDoc($request->getpost('id'));
  	    $mCtaPagar->set_data_vencimento($this->data_br_to_mysql($request->getpost('data_vencimento')));
  	    $mCtaPagar->set_id_fornecedor($forn->get_id());
  	    
  	$CtaPagar->upsert($mCtaPagar);
  }
}
?>