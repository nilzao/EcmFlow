<?php
class knl_extensions_dpedcompra_edit extends knl_lib_daoext_Convert {
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
 	
  	$PedCompra = knl_extensions_dpedcompra_dao::getInstance();
  	$mPedCompra = $PedCompra->selectByIdDoc($request->getpost('id'));
  	    $mPedCompra->set_id_fornecedor($forn->get_id());
  	$this->gravaDataEntrega($mPedCompra,$request->getPost('dataentrega')); 
  	$PedCompra->upsert($mPedCompra);
  }
  
  private function gravaDataEntrega(knl_extensions_dpedcompra_model $PedCompra,$dataentrega) {
  	$PedCompraEntrega = knl_extensions_dpedcompra_daoPedCompraEntrega::getInstance();
  	$PedCompraEntrega->deleteByIdPedCompra($PedCompra->get_id());
  	$mPedCompraEntrega = new knl_extensions_dpedcompra_modelPedCompraEntrega(0,$PedCompra->get_id(),"");
    foreach ($dataentrega as $v) {
    	$v = $this->data_br_to_mysql($v);
    	if ($v != "0000-00-00" AND $v != "00-00-00"){
    		$mPedCompraEntrega->set_id(0);
    		$mPedCompraEntrega->set_dataentrega($v);
    		$PedCompraEntrega->upsert($mPedCompraEntrega);	
    	}
  	}
  }
}
?>