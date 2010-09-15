<?php
class knl_extensions_dcotcompra_edit extends knl_lib_daoext_Convert {
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
  	
  	$cotacao_cli = knl_extensions_cadastronf_cotEdit::getInstance()->gravaNoBanco();

  	$dcotcompra = knl_extensions_dcotcompra_dao::getInstance();
  	$m_dcotcompra = $dcotcompra->selectByIdDoc($request->getpost('id'));
  	$m_dcotcompra->set_id_fornecedor($cotacao_cli->get_id());
  	  //  $m_dcotcompra->set_data_ini($this->data_br_to_mysql($request->getpost('data_ini')));
  	  //  $m_dcotcompra->set_data_fim($this->data_br_to_mysql($request->getpost('data_fim')));
  	$dcotcompra->upsert($m_dcotcompra);
  }
}
?>
