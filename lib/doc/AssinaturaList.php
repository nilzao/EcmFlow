<?php

class knl_lib_doc_AssinaturaList {
  private static $instance;
  
  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }
  
  public function listaAssinaturas(){
  	$request = knl_lib_Registry::getRequestObj();
  	$Assina = knl_dao_doc_assinatura::getInstance();
  	$mAssina = $Assina->selectByIdDoc($request->getGet('id'));
  	$Usuario = knl_dao_knl_usuario::getInstance();
  	$AssinaTipo = knl_dao_doc_assinatura_tipo::getInstance();
  	$tudo = array();
  	foreach($mAssina as $k=>$v) {
  		$mUsuario = $Usuario->selectById($v->get_id_knl_usuario());
  		$mAssinaTipo = $AssinaTipo->selectById($v->get_id_doc_assinatura_tipo());
  		$tudo[] = array('doc_assinatura'=>$mAssina[$k],'knl_usuario'=>$mUsuario,'doc_assinatura_tipo'=>$mAssinaTipo);
  	}
  	return $tudo;
  }
}
?>
