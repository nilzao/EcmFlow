<?php

class knl_lib_Session extends knl_lib_Registry {
	private static $instance;
	private $id_usuario = 0;
    private $id_grupo = 0;
    private $grupos = array();
    private $id_empresa;

    private function __construct(){
    	session_start();
    	$this->id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;
    	$this->id_grupo = isset($_SESSION['id_grupo']) ? $_SESSION['id_grupo'] : 0 ;
    	$this->grupos = isset($_SESSION['grupos']) ? $_SESSION['grupos'] : array(0) ;
    	$this->id_empresa = isset($_SESSION['id_empresa']) ? $_SESSION['id_empresa'] : 0 ;
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function get_id_usuario(){
    	return $this->id_usuario;
    }
    
    public function get_id_grupo(){
    	return $this->id_grupo;
    }
    
    public function get_grupos(){
    	return $this->grupos;
    }
    
    public function get_id_empresa(){
    	return $this->id_empresa;
    }
    
    public function set_id_usuario($id_usuario){
    	$_SESSION['id_usuario'] = $id_usuario;
    	$this->id_usuario = $id_usuario;
    }
    
    public function set_id_grupo($id_grupo){
    	$_SESSION['id_grupo'] = $id_grupo;
    	$this->id_grupo = $id_grupo;
    }
    
    public function set_grupos($array_grupos){
    	$_SESSION['grupos'] = $array_grupos;
    	$this->grupos = $array_grupos;
    }

    public function set_id_empresa($id_empresa){
    	$_SESSION['id_empresa'] = $id_empresa;
    	$this->id_empresa = $id_empresa;
    }
    
    public function killSession(){
    	foreach($_SESSION as $var => $chave){
    		unset($_SESSION[$var]);
    		$this->$var = 0;
    	}
    	session_destroy();
    }
}
?>
