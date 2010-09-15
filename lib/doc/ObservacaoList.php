<?php

class knl_lib_doc_ObservacaoList {
  private static $instance;
  
  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }
  
  public function listaObservacoes(){
  	$request = knl_lib_Registry::getRequestObj();
  	$Obs = knl_dao_doc_obs::getInstance();
  	$mObs = $Obs->selectByIdDoc($request->getGet('id'));
  	return $mObs;
  }
}
?>
