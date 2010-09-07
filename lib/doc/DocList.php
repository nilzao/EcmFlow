<?php

class knl_lib_doc_DocList {
  private static $instance;
  
  private function construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }

  public function montaLista(){
    $session = knl_lib_Registry::getSession();
    $filtro = knl_lib_doc_MontaFiltro::getInstance();
    
    $arrayFiltro = $filtro->montafiltro();
  	
  	$Doc = knl_dao_doc::getInstance();
  	$lista = $Doc->selectListagem($session->get_id_usuario(),
  	                              $session->get_id_grupo(),
  	                              $session->get_grupos(),
  	                              $arrayFiltro);
   
    $tudo = knl_lib_doc_MontaDocList::getInstance()->montaLista($lista);
    return $tudo;
  }
  
}
?>