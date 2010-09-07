<?php
class knl_lib_Regras {
	private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function regraCred($id_doc,$id_doc_pend_tipo){
    	$session = knl_lib_Registry::getSession();
    	$DocShow = knl_lib_doc_DocShow::getInstance();
    	$doc = $DocShow->getDocumento($id_doc);
    	$DocCred = knl_dao_doc_cred::getInstance();
   	
    	$DocRegraCred = knl_dao_doc_sub_tipo_regra_cred::getInstance();
    	$mDocRegraCred = $DocRegraCred->selectBySubTipoPendTipo($doc->get_id_doc_sub_tipo(),$id_doc_pend_tipo);
    	foreach($mDocRegraCred as $rc){
    		if ($rc->get_addrem() == 'A'){
    			$newmRegraCred = new knl_model_doc_cred(0,
    		                                       		$id_doc,
	    		                                    	$rc->get_id_knl_usuario(),
    		                                       		$rc->get_id_knl_grupo(),
	    		                                       	$rc->get_perm_usuario(),
	    		                                       	$rc->get_perm_grupo(),
	    		                                       	$rc->get_perm_outros());
    			$newRegraCred = knl_dao_doc_cred::getInstance()->upsert($newmRegraCred);
    		}
    		if ($rc->get_addrem() == 'R'){
    			$mDocCred = $DocCred->selectByIdDoc($id_doc);
    			foreach($mDocCred as $c){
		    		if($c->get_id_knl_usuario() == $session->get_id_usuario() AND $c->get_perm_usuario() & $rc->get_perm_usuario()){
		  				$c->set_perm_usuario($c->get_perm_usuario() - ($rc->get_perm_usuario()));
		  			}
		  			if(($c->get_id_knl_grupo() == $session->get_id_grupo() OR
  		   				in_array($c->get_id_knl_grupo(),$session->get_grupos())) AND
  		   				($c->get_perm_grupo() & $rc->get_perm_grupo())){
		  				$c->set_perm_grupo($c->get_perm_grupo() - ($rc->get_perm_grupo()));		  				
		  			}
		  			if($c->get_perm_outros() & $rc->get_perm_outros()){
		  				$c->set_perm_outros($c->get_perm_outros() - ($rc->get_perm_outros()));
		  			}
					$newmRegraCred = new knl_model_doc_cred($c->get_id(),
	    		                                       		$id_doc,
		    		                                    	$c->get_id_knl_usuario(),
	    		                                       		$c->get_id_knl_grupo(),
		    		                                       	$c->get_perm_usuario(),
		    		                                       	$c->get_perm_grupo(),
		    		                                       	$c->get_perm_outros());
	    			$newRegraCred = knl_dao_doc_cred::getInstance()->upsert($newmRegraCred);
    			}
    		}
    	}
    }
    
    public function regraPend($id_doc,$id_doc_pend_tipo){
    	$DocShow = knl_lib_doc_DocShow::getInstance();
    	$doc = $DocShow->getDocumento($id_doc);
    	$DocRegraPend = knl_dao_doc_sub_tipo_regra_pend::getInstance();
    	$mDocRegraPend = $DocRegraPend->selectBySubTipoPendTipo($doc->get_id_doc_sub_tipo(),$id_doc_pend_tipo);
        foreach($mDocRegraPend as $rp){
        	$newmRegraPend = new knl_model_doc_pendencia(0,
        	                                            $id_doc,
        	                                            $rp->get_id_knl_usuario(),
        	                                            $rp->get_id_knl_grupo(),
        	                                            $rp->get_id_doc_pendencia_tipo2(),
        	                                            'S');
        	$newRegraPend = knl_dao_doc_pendencia::getInstance()->upsert($newmRegraPend);
    		//echo $rp->get_id()."\n";
    	}
    }
}
?>