<?php
class knl_domain_Index {
    private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
	}

	public function handle(){
		$vl = knl_view_Loader::getInstance();
		$menu = knl_lib_perm_Menu::getInstance()->montaMenu();
		$vl->setVar("menu",$menu);
		$vl->display("index");
	}

}
