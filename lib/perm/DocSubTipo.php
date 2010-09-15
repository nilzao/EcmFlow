<?php

class knl_lib_perm_DocSubTipo {
  private static $instance;
  
  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }
  
  public function montaSubTipos(){
  	$sessao = knl_lib_Registry::getSession();
  	$DocSubTipo = knl_dao_doc_sub_tipo::getInstance();
  	$model = $DocSubTipo->selectByUserGroup($sessao->get_id_usuario(),$sessao->get_id_grupo(),$sessao->get_grupos());
  	return $model;
  }

}
?>
