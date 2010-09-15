<?php
class knl_domain_Usuarios {
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
      $Usuarios = knl_dao_knl_usuario::getInstance();
      $lstUsrs = $Usuarios->selectAll();
      $vl = knl_view_Loader::getInstance();
        $vl->setVar("users",$lstUsrs);
        $vl->display("UserList");
  }

  public function lstdepto(){
      $request = knl_lib_Registry::getRequestObj()->getInstance();

      $usuario = knl_dao_knl_usuario::getInstance()->selectById(
      $request->GetGet("id_usu"));
      
      $Deptos = knl_dao_knl_depto::getInstance();
      $arrayDpto = $Deptos->selectAll();
      $vl = knl_view_Loader::getInstance();
        $vl->setVar("deptos",$arrayDpto);
        $vl->setVar("usuario",$usuario);
        $vl->display("UserDepto");
  }

  public function savedepto(){
      $request = knl_lib_Registry::getRequestObj()->getInstance();
      $id_usu = $request->getPost("id_usu");
      $deptos = $request->getPost("deptos");
      
      $dGrupoUsu = knl_dao_knl_grupo_usuario::getInstance();
      $dGrupoUsu->clearByIdUsr($id_usu);
      $mGrupoUsu = new knl_model_knl_grupo_usuario(0,$id_usu,0);
      if (!empty($deptos)){
	      foreach($deptos as $v){
			$grupos = knl_dao_knl_grupo::getInstance()->selectByIdDepto($v);
	      	foreach($grupos as $g){
	      		$mGrupoUsu->set_Id_knl_grupo($g->get_Id());
	      		$mGrupoUsu->set_Id(0);
	      		$dGrupoUsu->upsert($mGrupoUsu);
	      	}
	      }
      }
      echo "criado (msg em knl_domain_Usuarios)";
  }
}
?>
