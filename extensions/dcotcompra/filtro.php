<?php
class knl_extensions_dcotcompra_filtro extends knl_lib_daoext_Convert {
    private static $instance;
    
    private function __construct() {}
    public static function getInstance() {
       if(!isset(self::$instance)) {
           self::$instance = new self();
       }
       return self::$instance;
    }
    
    public function montaFiltro(){
      $filtro = array();      
    	$request = knl_lib_Registry::getRequestObj();
    	$filtro = array('cotacao_cli'=>$request->getRequest('cotacao_cli'));
    	return $filtro;
    }
}
?>
