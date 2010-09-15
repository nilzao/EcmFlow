<?php

class knl_lib_perm_Doc {
  private static $instance;
  
  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }
  
  public function montaActions(){
  }

  public function verificaDocVis($id){
  	$session = knl_lib_registry::getSession();
	$DocCred = knl_dao_doc_cred::getInstance();
	$mDocCred = $DocCred->selectByIdDocUsuarioGrupo($id,$session->get_id_usuario(),$session->get_id_grupo(),$session->get_grupos());
	$vis = 0;
	foreach($mDocCred as $v){
		if ($v->get_perm_usuario() && 2 OR $v->get_perm_grupo() && 2 or $v->get_perm_outros() && 2){
			$vis =1;
		}
	}
	if ($vis == 0){
		echo "Permissão negada! Documento não existente, ou sem permissões para visualizar.";
		die();
	}
  }
}
?>
