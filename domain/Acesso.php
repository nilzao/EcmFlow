<?php

class knl_domain_Acesso {
	private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

  public function handle(){
  	$request = knl_lib_Registry::getRequest()->getInstance();
    switch($request->getGet('action')) {
    	case "formin":
    		$this->formLogin();
    		break;
        case "in":
            $this->login();
            knl_domain_Index::getInstance()->handle();
            break;
		case "out":
            $this->logout();
            knl_domain_Index::getInstance()->handle();
            break;
    }
  }

  public function formLogin(){
  	$vh = knl_view_Loader::getInstance();
  	$vh->display("formlogin");
  	//echo "aqui vai a chamada de viewLoad do form";
  }

  public function login(){
  	$request = knl_lib_Registry::getRequest()->getInstance();
	$usuario = knl_dao_knl_usuario::getInstance()->selectByUserPass($request->getPost('user'),md5($request->getPost('passwd')));
	
	if ($usuario->get_id() == 0){
		//erro de login, chamar alguma view, ou algum aviso a se pensar ainda...
	} else {
       $gruposObj = knl_dao_knl_grupo_usuario::getInstance()->selectByUser($usuario->get_id());
       $session = knl_lib_Registry::getSession();
       
	   $session->set_id_usuario($usuario->get_id());
	   $session->set_id_grupo($usuario->get_id_knl_grupo());
	   $session->set_id_empresa(1);
	   
	   $grupos = array();
       foreach ($gruposObj as $grupo){
       	$grupos[] = $grupo->get_id_knl_grupo();
       }
       $session->set_grupos($grupos);
	}
  }

  public function logout(){
  	$session = knl_lib_Registry::getSession();
  	$session->killSession();
  	$session->set_grupos(array());
  }
}
?>
