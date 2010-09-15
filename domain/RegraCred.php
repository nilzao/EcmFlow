<?php
class knl_domain_RegraCred {
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
  	echo "<a href=\"index.php?domain=RegCred&action=formadd\">Adicionar<a><br>";
  	$dRegraCred = knl_dao_doc_sub_tipo_regra_cred::getInstance();
  	$array_regras_cred = $dRegraCred->selectAll();
  	foreach($array_regras_cred as $v) {
  		echo $v->get_addrem()." / ";
  		$mPendtipo = knl_dao_doc_pendencia_tipo::getInstance()->selectById(
  		$v->get_id_doc_pendencia_tipo());
  		echo " tipo: ".$mPendtipo->get_descricao()." / ";
  		
  		$mDocSubTipo = knl_dao_doc_sub_tipo::getInstance()->selectById(
  		$v->get_id_doc_sub_tipo());
  		echo " doc: ".$mDocSubTipo->get_descricao()." / ";
  		$usu_regra = ""; $grupo_regra = "";
  		if ($v->get_id_knl_usuario() != 0){
  			$mUsu = knl_dao_knl_usuario::getInstance()->selectById(
  			$v->get_id_knl_usuario());
  			$usu_regra = $mUsu->get_login();
  			echo "usuario: ".$usu_regra." / ";
  		}
  		if ($v->get_id_knl_grupo() !=0){
  			$mGrupo = knl_dao_knl_grupo::getInstance()->selectById(
  			$v->get_id_knl_grupo());
  			$grupo_regra = $mGrupo->get_nome();
  			echo "grupo: ".$grupo_regra." / ";
  		}
  		echo "<a href=\"index.php?domain=RegCred&action=del&id_regra=".$v->get_id()."\">X</a><br>";
  	}
  	/*
      $Usuarios = knl_dao_knl_usuario::getInstance();
      $lstUsrs = $Usuarios->selectAll();
      $vl = knl_view_Loader::getInstance();
        $vl->setVar("users",$lstUsrs);
        $vl->display("UserList");
        */
  }
  
  public function del(){
  	echo "del em RegraCred<br>";
  	$request = knl_lib_Registry::getRequestObj()->getInstance();
  	$id_regra = $request->getGet('id_regra');
  	//echo $id_regra;
  	knl_dao_doc_sub_tipo_regra_cred::getInstance()->deleteById($id_regra);
  }
  
  public function formadd(){
  	$dPendTipo = knl_dao_doc_pendencia_tipo::getInstance();
  	$array_PendTp = $dPendTipo->selectAll();
  	$array_DocSubTp = knl_dao_doc_sub_tipo::getInstance()->selectAll();
  	$array_grupos = knl_dao_knl_grupo::getInstance()->selectAll();
  	$vl = knl_view_Loader::getInstance();
        $vl->setVar("pendtipo",$array_PendTp);
        $vl->setVar("docsubtipo",$array_DocSubTp);
        $vl->setVar("grupos",$array_grupos);
        $vl->display("RegraCredForm");
  }
  
  public function add(){
  	$request = knl_lib_Registry::getRequestObj()->getInstance();
  	$arr_grupos = $request->getPost("grupos");
  	$doc_pend_tp = $request->getPost("pendtipo");
  	$doc_sub_tp = $request->getPost("docsubtipo");
  	$addrem = $request->getPost("addrem");
  	/*
  	$id,$addrem,$id_doc_pendencia_tipo,
  	$id_knl_usuario,$id_knl_grupo,$id_doc_sub_tipo,
  	$perm_usuario,$perm_grupo,$perm_outros
  	*/
  	$mRegraCred = new knl_model_doc_sub_tipo_regra_cred(
  						0,$addrem,$doc_pend_tp,0,0,$doc_sub_tp,
  						0,0,0);
	$dRegraCred = knl_dao_doc_sub_tipo_regra_cred::getInstance();
  	if (!empty ($arr_grupos)){
  		foreach($arr_grupos as $v){
  			$mGrupo = knl_dao_knl_grupo::getInstance()->selectById($v);
  			$mPermBin = knl_dao_knl_perm_bin::getInstance()->selectById(
  							$mGrupo->get_id_knl_perm_bin());
  			$mRegraCred->set_id(0);
  			$mRegraCred->set_id_knl_grupo($v);
  			$mRegraCred->set_perm_grupo($mPermBin->get_permbin());
  			$dRegraCred->upsert($mRegraCred);
  		}
  	}
  	echo "add em domain RegraCred";
  }
}
?>
