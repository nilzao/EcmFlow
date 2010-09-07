<?php

class knl_domain_Empresa {
  private static $instance;

  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance; 
  }
  
  public function handle(){
  	$request = knl_lib_Registry::getRequest()->getInstance();
      switch($request->getGet('action')) {
    	case "set":
    		$this->setEmpresa($request->getGet('id'));
    		break;
    	default :
            $this->mostraEmpresas();
            break;
    }
  }
  
  public function mostraEmpresas(){
  	$session = knl_lib_Registry::getSession();
  	$Empresas = knl_dao_empresa::getInstance();
  	$lista = $Empresas->selectAll();
  	  	$vl = knl_view_Loader::getInstance();
        $vl->setVar("lista",$lista);
        $vl->setVar("empresa_ativa",$Empresas->selectById($session->get_id_empresa()));
        $vl->display("EmpresaList");
  }
  
  public function setEmpresa($id_empresa){
  	$session = knl_lib_Registry::getSession();
  	$request = knl_lib_registry::getRequest();
    $session->set_id_empresa($request->getGet('id'));  	
  	  	//$vl = knl_view_Loader::getInstance();
        //$vl->setVar("empresa",$mEmpresa);
        //$vl->display("EmpresaAtiva");
    $this->mostraEmpresas();
  }

}
?>
