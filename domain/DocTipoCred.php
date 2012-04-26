<?php
class knl_domain_DocTipoCred {
  private static $instance;

  private function __construct(){}

  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }

  public function handle(){
  	$request = knl_lib_Registry::getRequestObj()->getInstance();
  	$metodo = $request->getGet('action');
  	if (method_exists($this,$metodo)){
  		$this->$metodo();
  	}
  }

  public function lst(){
      $dDocTpCred = knl_dao_doc_tipo_cred::getInstance();
      $lstDocTpCred = $dDocTpCred->selectAll();
      $dGrupo = knl_dao_knl_grupo::getInstance();
      $dDocTipo = knl_dao_doc_tipo::getInstance();
      $arrayDesc = array();
      $i = 0;
      foreach($lstDocTpCred as $v){
      	$mDocTipo = $dDocTipo->selectById($v->get_id_doc_tipo());
      	$arrayDesc[$i] = "docTipo: ".$mDocTipo->get_descricao()." / ";
      	$mGrupo = $dGrupo->selectById($v->get_id_knl_grupo());
      	$arrayDesc[$i] .= "grupo: ".$mGrupo->get_nome()."<br>";
      	$i++;
      }
      $vl = knl_view_Loader::getInstance();
      $vl->setVar("lista",$arrayDesc);
      $vl->display("DocTipoCredList");
  }
  
  public function formadd(){
  	$dDocTp = knl_dao_doc_tipo::getInstance();
    $lstDocTp = $dDocTp->selectAll();
    $dGrupo = knl_dao_knl_grupo::getInstance();
    $lstGrupo = $dGrupo->selectAll();
  	$vl = knl_view_Loader::getInstance();
        $vl->setVar("doctipo",$lstDocTp);
        $vl->setVar("grupos",$lstGrupo);
        $vl->display("DocTipoCredForm");
  }
  
  public function add(){
  	$request = knl_lib_Registry::getRequestObj()->getInstance();
  	$arr_grupos = $request->getPost("grupos");
  	$doc_tipo = $request->getPost("doctipo");
  	
  	$dDocTpCred = knl_dao_doc_tipo_cred::getInstance();
  	/*
  	$id,$id_doc_tipo,$id_knl_usuario,$id_knl_grupo,
  	$perm_usuario,$perm_grupo,$perm_outros
  	*/
  	$mDocTp = new knl_model_doc_tipo_cred(
  					0,$doc_tipo,0,0,0,1,0);
  	
  	if (!empty($arr_grupos)){
	  	foreach($arr_grupos as $v){
	  		$mDocTp->set_id(0);
	  		$mDocTp->set_id_knl_grupo($v);
	  		$dDocTpCred->upsert($mDocTp);
	  	}
  	}
  	echo "add em DocTipoCred";
  }
}
?>
