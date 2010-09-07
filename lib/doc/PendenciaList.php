<?php

class knl_lib_doc_PendenciaList {
  private static $instance;

  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance; 
  }
  
  public function listaPendencias(){
  	$session = knl_lib_Registry::getSession();
  	
  	$filtro = knl_lib_doc_MontaFiltro::getInstance();
  	$arrayFiltro = $filtro->montafiltro();
  	$arrayFiltro['metodo']="ListaPendencia";
  	
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
