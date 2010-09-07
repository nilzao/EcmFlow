<?php

class knl_lib_doc_AnexoList {
  private static $instance;
  
  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }

  public function ListaAnexos(){
  	/**
  	 * pegar as variaveis de sessao
  	 * e passar para o dao_doc se virar
  	 * dao_doc traz o array com os models da listagem
  	 */
    $request = knl_lib_Registry::getRequest();
  	$session = knl_lib_Registry::getSession();

  	$arrayFiltro = array('metodo'=>'ListaAnexo',
  	                     'pag'=>$request->getRequest('pag'),
  	                     'doc_anexo'=>$request->getRequest('doc_anexo'),
  	                     'doc_id'=>$request->getRequest('doc_id'));
  	
  	$Doc = knl_dao_doc_anexo::getInstance();
  	$lista = $Doc->selectListagem($session->get_id_usuario(),
  	                              $session->get_id_grupo(),
  	                              $session->get_grupos(),
  	                              $arrayFiltro);
    //$tudo = knl_lib_doc_MontaDocList::getInstance()->montaLista($lista);
    
    $tudo = $this->montaAnexoLista($lista);
    //print_r($tudo);die();
    return $tudo;
  }
  
  private function montaAnexoLista($lista){
  	$DocShow = knl_lib_doc_DocShow::getInstance();
  	$Doc = knl_dao_doc::getInstance();
  	$tudo = array();
    foreach($lista as $k=>$mAnexo){
      if(is_int($k)){
      	$filtro = $lista["detalhes"];
      	if(empty($filtro["doc_anexo"])){
      		$id_doc = $mAnexo->get_id_doc1();
      	} else {
      		$id_doc = $mAnexo->get_id_doc2();
      	}
      	$DocFull = $DocShow->getDocumentoFull($Doc->selectById($id_doc));
      	$DocFull["doc_anexo"] = $mAnexo;
  	    $tudo[] = array_merge(array('doc'=>$Doc->selectById($id_doc)),$DocFull);
      }
    }
    $tudo['detalhes'] = $lista['detalhes'] ;
    return $tudo;
  }
}
?>
