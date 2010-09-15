<?php

class knl_lib_doc_DocShow {
  private static $instance;
  
  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }

  public function getDocumento($id){
  	$request = knl_lib_Registry::getRequestObj();
  	$Doc = knl_dao_doc::getInstance();
  	$mDoc = $Doc->selectById($id);
  	return $mDoc;
  }
  
  public function getDocumentoTipo (knl_model_doc $mDoc){
  	$DocTipo = knl_dao_doc_tipo::getInstance();
  	$mDocTipo = $DocTipo->selectById($mDoc->get_id_doc_tipo());
  	return $mDocTipo;
  }

  public function getDocumentoSubTipo (knl_model_doc $mDoc){
  	$DocSubTipo = knl_dao_doc_sub_tipo::getInstance();
  	$mDocSubTipo = $DocSubTipo->selectById($mDoc->get_id_doc_sub_tipo());
  	return $mDocSubTipo;
  }
    
  public function getDocumentoH (knl_model_doc $mDoc){
  	$mDocTipo = $this->getDocumentoTipo($mDoc);
  	$func = "knl_extensions_".$mDocTipo->get_classe()."_dao::getInstance";
  	$DocH = call_user_func($func);
  	$mDocH = $DocH->selectByIdDoc($mDoc->get_id());
  	return $mDocH;
  }
  
  public function getDocumentoCarimbo (knl_model_doc $mDoc){
  	$mDocCarimbo = knl_dao_doc_carimbo::getInstance()->selectByIdDoc($mDoc->get_id());
  	return $mDocCarimbo; 
  }
  
  public function getDocumentoHFull (knl_model_doc $mDoc){
  	$mDocTipo = $this->getDocumentoTipo($mDoc);
  	$func = "knl_extensions_".$mDocTipo->get_classe()."_dao::getInstance";
  	$DocH = call_user_func($func);
  	$mDocH = $this->getDocumentoH($mDoc);
  	$mDocHFull = $DocH->getFullData($mDocH);
  	//print_r($mDocHFull);die();
  	return $mDocHFull;
  }
  
  public function getDocumentoFull(knl_model_doc $mDoc){
  	$tudo = array();
  	$tudo["docTipo"] = $this->getDocumentoTipo($mDoc);
  	$tudo["docSubTipo"] = $this->getDocumentoSubTipo($mDoc);
  	$tudo[$tudo["docTipo"]->get_classe()] = $this->getDocumentoH($mDoc);
  	$tudo[$tudo["docTipo"]->get_classe()."Full"] = $this->getDocumentoHFull($mDoc);
  	$tudo["docCred"] = $this->getDocumentoCred($mDoc);
  	$tudo["docActions"] = $this->getActions($mDoc);
  	return $tudo;
  }
  
  public function getDocumentoCred(knl_model_doc $mDoc){
  	$session = knl_lib_Registry::getSession();
  	$DocCred = knl_dao_doc_cred::getInstance();
  	$mDocCred = $DocCred->selectByIdDocUsuarioGrupo($mDoc->get_id(),$session->get_id_usuario(),$session->get_id_grupo(),$session->get_grupos());
  	return $mDocCred;
  }
  
  public function getDocumentoPend(knl_model_doc $mDoc){
  	$session = knl_lib_Registry::getSession();
  	$DocPend = knl_dao_doc_pendencia::getInstance();
  	$mDocPend = $DocPend->selectByUserGroupIdDoc($session->get_id_usuario(),
  	                                             $session->get_id_grupo(),
  	                                             $session->get_grupos(),
  	                                             $mDoc->get_id());
  	return $mDocPend;
  }
  
  public function getActions(knl_model_doc $mDoc){
  	$session = knl_lib_Registry::getSession();
  	$mDocCred = $this->getDocumentoCred($mDoc);
  	$actions = array();
  	foreach($mDocCred as $dc){
  	  	if (!isset($actions['excluir'])){
  			if(($dc->get_id_knl_usuario() == $session->get_id_usuario() AND $dc->get_perm_usuario() & 8) OR
  			   ($dc->get_id_knl_grupo() == $session->get_id_grupo() AND $dc->get_perm_grupo() & 8) OR
  			   (in_array($dc->get_id_knl_grupo(),$session->get_grupos())  AND $dc->get_perm_grupo() & 8) OR
  			   ($dc->get_perm_outros() & 8)){
  			    $actions['excluir']=true;
  			}
  	  	}
  		if (!isset($actions['anexar'])){
  			if(($dc->get_id_knl_usuario() == $session->get_id_usuario() AND $dc->get_perm_usuario() & 64) OR
  			   ($dc->get_id_knl_grupo() == $session->get_id_grupo() AND $dc->get_perm_grupo() & 64) OR
  			   (in_array($dc->get_id_knl_grupo(),$session->get_grupos())  AND $dc->get_perm_grupo() & 64) OR
  			   ($dc->get_perm_outros() & 64)){
  			    $actions['anexar']=true;
  			}
  			
  		}
  	  	if (!isset($actions['aprovar'])){
  			if(($dc->get_id_knl_usuario() == $session->get_id_usuario() AND $dc->get_perm_usuario() & 128) OR
  			   ($dc->get_id_knl_grupo() == $session->get_id_grupo() AND $dc->get_perm_grupo() & 128) OR
  			   (in_array($dc->get_id_knl_grupo(),$session->get_grupos())  AND $dc->get_perm_grupo() & 128) OR
  			   ($dc->get_perm_outros() & 128)){
  			    $actions['aprovar']=true;
  			}
  	  	}
  	  	if (!isset($actions['editar'])){
  			if(($dc->get_id_knl_usuario() == $session->get_id_usuario() AND $dc->get_perm_usuario() & 256) OR
  			   ($dc->get_id_knl_grupo() == $session->get_id_grupo() AND $dc->get_perm_grupo() & 256) OR
  			   (in_array($dc->get_id_knl_grupo(),$session->get_grupos())  AND $dc->get_perm_grupo() & 256) OR
  			   ($dc->get_perm_outros() & 256)){
  			    $actions['editar']=true;
  			}
  	  	}
  	    if (!isset($actions['desanexar'])){
  			if(($dc->get_id_knl_usuario() == $session->get_id_usuario() AND $dc->get_perm_usuario() & 32) OR
  			   ($dc->get_id_knl_grupo() == $session->get_id_grupo() AND $dc->get_perm_grupo() & 32) OR
  			   (in_array($dc->get_id_knl_grupo(),$session->get_grupos())  AND $dc->get_perm_grupo() & 32) OR
  			   ($dc->get_perm_outros() & 32)){
  			    $actions['desanexar']=true;
  			}
  	  	}
  	}
  	return $actions;
  }
}
?>
