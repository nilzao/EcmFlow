<?php
class knl_lib_doc_MontaFiltro extends knl_lib_daoext_Convert {
  private static $instance;
  
  private function construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }
  
  public function montaFiltro () {
  	$session = knl_lib_Registry::getSession();
    $request = knl_lib_Registry::getRequest();
  	$tipoClasse = "";
  	if ($request->getRequest('doc_tipo')){
  	    $DocTipo = knl_dao_doc_tipo::getInstance();
  	    $modelDocTipo = $DocTipo->selectById($request->getRequest('doc_tipo'));
  	    $tipoClasse = $modelDocTipo->get_classe();
  	}

  	$arrayFiltro = array('tipoClasse'=>$tipoClasse,
  	                     'pag'=>$request->getRequest('pag'),
  	                     'doc_num'=>$request->getRequest('doc_num'),
  	                     'data_ini'=>$this->data_br_to_mysql($request->getRequest('data_ini')),
  	                     'data_fim'=>$this->data_br_to_mysql($request->getRequest('data_fim')),
  	                     'doc_tipo'=>$request->getRequest('doc_tipo'),
  	                     'doc_sub_tipo'=>$request->getRequest('doc_sub_tipo'),
  	                     'id_empresa'=>$session->get_id_empresa());
  	if (!empty($tipoClasse)){//knl_extensions_dnfentrada_
  	    //$tipoObj = call_user_func("knl_lib_doc_filtro_{$tipoClasse}::getInstance");
  	    $tipoObj = call_user_func("knl_extensions_{$tipoClasse}_filtro::getInstance");
  	    $arrayFiltro = array_merge($arrayFiltro,$tipoObj->montaFiltro());
  	    //print_r($arrayFiltro);
  	}
  	return $arrayFiltro;
  }
}
?>