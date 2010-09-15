<?php

class knl_lib_doc_ObservacaoAdd {
  private static $instance;
  
  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }
  
  public function AddObs(){
  	$request = knl_lib_Registry::getRequestObj();
  	$session = knl_lib_Registry::getSession();
  	$usuario = knl_dao_knl_usuario::getInstance()->selectById($session->get_id_usuario());
  	$data = date("d/m/Y");
  	$hora = date("H:i");
  	$Obs = knl_dao_doc_obs::getInstance();
  	$mObs = new knl_model_doc_obs(0,$request->getGet('id'),nl2br($request->getPost('obs'))."<br>&nbsp; Observação por: <strong>{$usuario->get_login()}</strong> em $data as $hora <hr>",0,0,1);
  	$Obs->upsert($mObs);
  }
}
?>
