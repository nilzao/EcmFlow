<?php

class knl_lib_perm_DocTipo {
  private static $instance;
  
  private function __construct(){}
  
  public function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }

  public function montaTipos(){
  	$sessao = knl_lib_Registry::getSession();
  	$DocTipo = knl_dao_doc_tipo::getInstance();
  	$model = $DocTipo->selectByUserGroup($sessao->get_id_usuario(),$sessao->get_id_grupo(),$sessao->get_grupos());
  	return $model;
  }

}
?>
