<?php
class knl_extensions_dsolcompra_filtro extends knl_lib_daoext_Convert {
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
      /*
    	$request = knl_lib_Registry::getRequest();
    	$filtro = array('data1'=>$this->data_br_to_mysql($request->getRequest('data1')),
    	                'data2'=>$this->data_br_to_mysql($request->getRequest('data2')));
    	*/
    	return $filtro;
    }
}
?>
