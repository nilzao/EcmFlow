<?php

class knl_lib_doc_PendenciaOk {
  private static $instance;

  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance; 
  }
 
  public function EditOk($id_doc){
  	$doc = knl_lib_doc_DocShow::getInstance()->getDocumento($id_doc);
  	$pendencias = knl_lib_doc_DocShow::getInstance()->getDocumentoPend($doc);
  	$Pend = knl_dao_doc_pendencia::getInstance();
  	$Cred = knl_dao_doc_cred::getInstance();

  	foreach($pendencias as $v){
  		if($v->get_id_doc_pendencia_tipo() == 4){
  			// excluir a pendencia em questao
  			$Pend->deleteById($v->get_id());
  			
  			// retirar permissão de edição do grupo e de outros do documento em questao
  			$mCred = $Cred->selectByIdDocUsuarioGrupo($v->get_id_doc(),$v->get_id_knl_usuario(),$v->get_id_knl_grupo());
  			foreach ($mCred as $c){
  				if($c->get_perm_usuario() & 256){
  					$c->set_perm_usuario($c->get_perm_usuario() - 256);
  				}
  			    if($c->get_perm_grupo() & 256){
  					$c->set_perm_grupo($c->get_perm_grupo() - 256);
  				}
  			    if($c->get_perm_outros() & 256){
  					$c->set_perm_outros($c->get_perm_outros() - 256);
  				}
  				$Cred->upsert($c);
  			}
  		}
  	}
  	$Regras = knl_lib_Regras::getInstance();
  	// executar as regras de credenciais para a id_doc_pend_tipo atual
  	$Regras->regraCred($id_doc,4);
  	
  	// executar as regras de pendencias para o id_doc_pend_tipo atual
  	$Regras->regraPend($id_doc,4);
  }
  
  public function AprovaOk($id_doc){
  	$doc = knl_lib_doc_DocShow::getInstance()->getDocumento($id_doc);
  	$pendencias = knl_lib_doc_DocShow::getInstance()->getDocumentoPend($doc);
  	$Pend = knl_dao_doc_pendencia::getInstance();
  	$Cred = knl_dao_doc_cred::getInstance();
  	
  	foreach($pendencias as $v){
  		if($v->get_id_doc_pendencia_tipo() == 5){
  			// excluir a pendencia em questao
  			$Pend->deleteById($v->get_id());
  			
  			// retirar permissão de edição do grupo e de outros do documento em questao
  			$mCred = $Cred->selectByIdDocUsuarioGrupo($v->get_id_doc(),$v->get_id_knl_usuario(),$v->get_id_knl_grupo());
  			foreach ($mCred as $c){
  				if($c->get_perm_usuario() & 128){
  					$c->set_perm_usuario($c->get_perm_usuario() - 128);
  				}
  			    if($c->get_perm_grupo() & 128){
  					$c->set_perm_grupo($c->get_perm_grupo() - 128);
  				}
  			    if($c->get_perm_outros() & 128){
  					$c->set_perm_outros($c->get_perm_outros() - 128);
  				}
  				
  				$Cred->upsert($c);
  			}
  		}
  	}
  	$Regras = knl_lib_Regras::getInstance();
  	// executar as regras de credenciais para a id_doc_pend_tipo atual
  	$Regras->regraCred($id_doc,5);
  	
  	// executar as regras de pendencias para o id_doc_pend_tipo atual + id_doc_pend_tipo seguinte
  	$Regras->regraPend($id_doc,5);
  }
  
  public function ReprovaOk($id_doc){
  	$doc = knl_lib_doc_DocShow::getInstance()->getDocumento($id_doc);
  	$pendencias = knl_lib_doc_DocShow::getInstance()->getDocumentoPend($doc);
  	$Pend = knl_dao_doc_pendencia::getInstance();
  	$Cred = knl_dao_doc_cred::getInstance();

  	foreach($pendencias as $v){
  		if($v->get_id_doc_pendencia_tipo() == 5){
  			// excluir a pendencia em questao
  			$Pend->deleteById($v->get_id());
  			
  			// retirar permissão de aprovação do grupo e de outros do documento em questao
  			$mCred = $Cred->selectByIdDocUsuarioGrupo($v->get_id_doc(),$v->get_id_knl_usuario(),$v->get_id_knl_grupo());
  			foreach ($mCred as $c){
  				if($c->get_perm_usuario() & 128){
  					$c->set_perm_usuario($c->get_perm_usuario() - 128);
  				}
  			    if($c->get_perm_grupo() & 128){
  					$c->set_perm_grupo($c->get_perm_grupo() - 128);
  				}
  			    if($c->get_perm_outros() & 128){
  					$c->set_perm_outros($c->get_perm_outros() - 128);
  				}
  				$Cred->upsert($c);
  			}
  		}
  	}
  	$Regras = knl_lib_Regras::getInstance();
  	// executar as regras de credenciais para a id_doc_pend_tipo atual
  	$Regras->regraCred($id_doc,6);
  	
  	// executar as regras de pendencias para o id_doc_pend_tipo atual + id_doc_pend_tipo seguinte
  	$Regras->regraPend($id_doc,6);
  }
  
  public function AssinaOk($id_doc){
  	$session = knl_lib_Registry::getSession();
  	$doc = knl_lib_doc_DocShow::getInstance()->getDocumento($id_doc);
  	$pendencias = knl_lib_doc_DocShow::getInstance()->getDocumentoPend($doc);
  	$Pend = knl_dao_doc_pendencia::getInstance();
  	//$Cred = knl_dao_doc_cred::getInstance();
  	foreach($pendencias as $v){
  		if($v->get_id_doc_pendencia_tipo() == 1 AND 
  		   ($v->get_id_knl_usuario() == $session->get_id_usuario() OR
  		   $v->get_id_knl_grupo() == $session->get_id_grupo() OR
  		   in_array($v->get_id_knl_grupo(),$session->get_grupos())))
  		   {
  		   $Pend->deleteById($v->get_id());
  		}
  	}
  }
  
  public function AnexoOk($id_doc){
  	$session = knl_lib_Registry::getSession();
  	$doc = knl_lib_doc_DocShow::getInstance()->getDocumento($id_doc);
  	$pendencias = knl_lib_doc_DocShow::getInstance()->getDocumentoPend($doc);
  	$Pend = knl_dao_doc_pendencia::getInstance();
  	//$Cred = knl_dao_doc_cred::getInstance();
  	foreach($pendencias as $v){
  		if($v->get_id_doc_pendencia_tipo() == 2 AND 
  		   ($v->get_id_knl_usuario() == $session->get_id_usuario() OR
  		   $v->get_id_knl_grupo() == $session->get_id_grupo() OR
  		   in_array($v->get_id_knl_grupo(),$session->get_grupos())))
  		   {
  		   $Pend->deleteById($v->get_id());
  		}
  	}
  }
}
?>
