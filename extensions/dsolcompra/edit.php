<?php
class knl_extensions_dsolcompra_edit extends knl_lib_daoext_Convert {
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

  	$dsolcompra = knl_extensions_dsolcompra_dao::getInstance();
  	$m_dsolcompra = $dsolcompra->selectByIdDoc($request->getpost('id'));
  	  //  $m_dsolcompra->set_data_ini($this->data_br_to_mysql($request->getpost('data_ini')));
  	  //  $m_dsolcompra->set_data_fim($this->data_br_to_mysql($request->getpost('data_fim')));
  	    
  	$dsolcompra->upsert($m_dsolcompra);
  }
}
?>
