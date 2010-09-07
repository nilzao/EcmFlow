<?php

class knl_lib_perm_Menu {
    private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
  public function montaMenu(){
  	    $session = knl_lib_Registry::getSession();
        $menu = knl_dao_knl_menu::getInstance()->selectByUserGroup($session->get_id_usuario(),$session->get_id_grupo(),$session->get_grupos());
        return $menu;
  }
}
?>
