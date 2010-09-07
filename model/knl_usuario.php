<?php
class knl_model_knl_usuario {
     private $id;
     private $id_knl_grupo;
     private $login;
     private $senha;
     private $script_ini;
     private $home;
     private $passwdauth1;
     private $passwdauth2;
     private $passwdauth3;

     public function __construct($id,$id_knl_grupo,$login,$senha,$script_ini,$home,$passwdauth1,$passwdauth2,$passwdauth3){
        $this->id = $id;
        $this->id_knl_grupo = $id_knl_grupo;
        $this->login = $login;
        $this->senha = $senha;
        $this->script_ini = $script_ini;
        $this->home = $home;
        $this->passwdauth1 = $passwdauth1;
        $this->passwdauth2 = $passwdauth2;
        $this->passwdauth3 = $passwdauth3;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_knl_usuario);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['knl_usuario_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_id_knl_grupo() {
        return $this->id_knl_grupo;
     }

     public function get_login() {
        return $this->login;
     }

     public function get_senha() {
        return $this->senha;
     }

     public function get_script_ini() {
        return $this->script_ini;
     }

     public function get_home() {
        return $this->home;
     }
     
	 public function get_passwdauth1() {
        settype($this->passwdauth1,"integer");
	 	return $this->passwdauth1;
     }
     
	 public function get_passwdauth2() {
        settype($this->passwdauth2,"integer");
	 	return $this->passwdauth2;
     }
     
	 public function get_passwdauth3() {
        settype($this->passwdauth3,"integer");
	 	return $this->passwdauth3;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_knl_grupo($id_knl_grupo) {
        $this->id_knl_grupo = $id_knl_grupo;
     }

     public function set_login($login) {
        $this->login = $login;
     }

     public function set_senha($senha) {
        $this->senha = $senha;
     }

     public function set_script_ini($script_ini) {
        $this->script_ini = $script_ini;
     }

     public function set_home($home) {
        $this->home = $home;
     }
     
	 public function set_passwdauth1($passwdauth1) {
        $this->passwdauth1 = $passwdauth1;
     }
     
	 public function set_passwdauth2($passwdauth2) {
        $this->passwdauth2 = $passwdauth2;
     }
     
	 public function set_passwdauth3($passwdauth3) {
        $this->passwdauth3 = $passwdauth3;
     }

}
?>
