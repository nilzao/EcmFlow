<?php
class knl_extensions_dcaixa_filtro extends knl_lib_daoext_Convert {
	private static $instance;
	
    private function __construct() {}
    public static function getInstance() {
       if (!isset(self::$instance)) {
           self::$instance = new self();
       }
       return self::$instance;
    }
    
    public function montaFiltro(){
    	$request = knl_lib_Registry::getRequestObj();
    	$filtro = array('data1'=>$this->data_br_to_mysql($request->getRequest('data1')),
    	                'data2'=>$this->data_br_to_mysql($request->getRequest('data2')));
    	return $filtro;
    }
}
?>