<?php

class knl_lib_doc_newAnexoList {
  private static $instance;
  
  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }

  public function montaLista(){
  	/**
  	 * pegar as variaveis de sessao
  	 * e passar para o dao_doc se virar
  	 * dao_doc traz o array com os models da listagem
  	 */
    $request = knl_lib_Registry::getRequest();
  	$session = knl_lib_Registry::getSession();
  	
  	$filtro = knl_lib_doc_MontaFiltro::getInstance();
    
    $arrayFiltro = $filtro->montafiltro();
    //$arrayFiltro['metodo']="ListaNewAnexo";
  	
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
