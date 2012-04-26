<?php
class knl_domain_RegraPend {
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
  	$dRegraPend = knl_dao_doc_sub_tipo_regra_pend::getInstance();
  	$array_regras_pend = $dRegraPend->selectAll();
  	$arrayDesc = array();
  	foreach($array_regras_pend as $v) {
  		$mDocSubTipo = knl_dao_doc_sub_tipo::getInstance()->selectById(
  		$v->get_id_doc_sub_tipo());
  		$arrayDesc[$v->get_id()] = " doc: ".$mDocSubTipo->get_descricao()." / ";
  		
  		$usu_regra = ""; $grupo_regra = "";
  		if ($v->get_Id_knl_usuario() != 0){
  			$mUsu = knl_dao_knl_usuario::getInstance()->selectById(
  			$v->get_Id_knl_usuario());
  			$usu_regra = $mUsu->get_Login();
  			$arrayDesc[$v->get_id()] .= "usuario: ".$usu_regra." / ";
  		}
  		if ($v->get_Id_knl_grupo() !=0){
  			$mGrupo = knl_dao_knl_grupo::getInstance()->selectById(
  			$v->get_Id_knl_grupo());
  			$grupo_regra = $mGrupo->get_Nome();
  			$arrayDesc[$v->get_id()] .= "grupo: ".$grupo_regra." / ";
  		}
  		
  		$mPendtipo = knl_dao_doc_pendencia_tipo::getInstance()->selectById(
  		$v->get_id_doc_pendencia_tipo());
  		$arrayDesc[$v->get_id()] .= " tipo: ".$mPendtipo->get_descricao()." / ";
  		
  		$mPendtipo = knl_dao_doc_pendencia_tipo::getInstance()->selectById(
  		$v->get_id_doc_pendencia_tipo2());
  		$arrayDesc[$v->get_id()] .= " tipo2: ".$mPendtipo->get_descricao()." / ";
  		$arrayDesc[$v->get_id()] .= "<a href=\"index.php?domain=RegPend&action=del&id_regra=".$v->get_id()."\">X</a><br>";
  	}
  	$vl = knl_view_Loader::getInstance();
  	$vl->setVar("lista",$arrayDesc);
  	$vl->display("RegraPendList");
  }
  
  public function del(){
  	echo "del em RegraPend<br>";
  	$request = knl_lib_Registry::getRequestObj()->getInstance();
  	$id_regra = $request->getGet('id_regra');
  	knl_dao_doc_sub_tipo_regra_pend::getInstance()->deleteById($id_regra);
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
        $vl->display("RegraPendForm");
  }
  
  public function add(){
    $request = knl_lib_Registry::getRequestObj()->getInstance();
  	$arr_grupos = $request->getPost("grupos");
  	$doc_pend_tp = $request->getPost("pendtipo");
  	$doc_pend_tp2 = $request->getPost("pendtipo2");
  	$doc_sub_tp = $request->getPost("docsubtipo");
  	/*
  	$id,$id_doc_pendencia_tipo,$id_doc_pendencia_tipo2,
  	$id_doc_sub_tipo,$id_knl_usuario,$id_knl_grupo
  	*/
  	$mRegraPend = new knl_model_doc_sub_tipo_regra_pend(
  						0,$doc_pend_tp,$doc_pend_tp2,
  						$doc_sub_tp,0,0);
	$dRegraPend = knl_dao_doc_sub_tipo_regra_pend::getInstance();
  	if (!empty ($arr_grupos)){
  		foreach($arr_grupos as $v){
  			$mRegraPend->set_id(0);
  			$mRegraPend->set_id_knl_grupo($v);
  			$dRegraPend->upsert($mRegraPend);
  		}
  	}
  	echo "add em domain RegraPend";
  }
}
?>
