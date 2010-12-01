<?php
class knl_extensions_dordserv_filtro extends knl_lib_daoext_Convert {
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
    	$filtro = array('malha'=>$request->getRequest('malha'),
    	                'fio'=>$request->getRequest('fio'));
    	return $filtro;
    }
}
?>
