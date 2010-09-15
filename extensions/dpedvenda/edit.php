<?php
class knl_extensions_dpedvenda_edit extends knl_lib_daoext_Convert {
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
 	
  	$PedVenda = knl_extensions_dpedvenda_dao::getInstance();
  	$mPedVenda = $PedVenda->selectByIdDoc($request->getpost('id'));
  	    $mPedVenda->set_id_fornecedor($forn->get_id());
  	$this->gravaDataEntrega($mPedVenda,$request->getPost('dataentrega')); 
  	$PedVenda->upsert($mPedVenda);
  }
  
  private function gravaDataEntrega(knl_extensions_dpedvenda_model $PedVenda,$dataentrega) {
  	$PedVendaEntrega = knl_extensions_dpedvenda_daoPedVendaEntrega::getInstance();
  	$PedVendaEntrega->deleteByIdPedVenda($PedVenda->get_id());
  	$mPedVendaEntrega = new knl_extensions_dpedvenda_modelPedVendaEntrega(0,$PedVenda->get_id(),"");
    foreach ($dataentrega as $v) {
    	$v = $this->data_br_to_mysql($v);
    	if ($v != "0000-00-00" AND $v != "00-00-00"){
    		$mPedVendaEntrega->set_id(0);
    		$mPedVendaEntrega->set_dataentrega($v);
    		$PedVendaEntrega->upsert($mPedVendaEntrega);
    	}
  	}
  }
}
?>