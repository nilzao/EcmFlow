<?php
class knl_viewlz_GetMenu {
	private static $instance;
	
	private function __construct(){
	}
	public static function getInstance() {
		if(!isset(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function getMenu(){
		$menu = knl_lib_perm_Menu::getInstance()->montaMenu();
		return $menu;
	}
}
