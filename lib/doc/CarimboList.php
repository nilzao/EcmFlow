<?php

class knl_lib_doc_CarimboList {
  private static $instance;
  
  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }
  
  public function listaCarimbos(){
  	$request = knl_lib_Registry::getRequest();
  	$Carimbos = knl_dao_doc_carimbo::getInstance();
  	$mCarimbos = $Carimbos->selectByIdDoc($request->getGet('id'));
    $CarimboTipo = knl_dao_carimbo::getInstance();
  	$tudo = array();
  	foreach($mCarimbos as $k=>$v) {
		if($v->get_id_carimbo() != 0){
  		$mCarimboTipo = $CarimboTipo->selectById($v->get_id_carimbo());
  		$tudo[] = array('doc_carimbo'=>$mCarimbos[$k],'carimbo'=>$mCarimboTipo);
		}
  	}
  	return $tudo;
  }
}
?>
