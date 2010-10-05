<?php
class knl_extensions_dctapagar_shell {
	private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
	public function gravaNoBanco($valores) {
    	$newmDocH = new knl_extensions_dctapagar_model(0,$valores['id_doc'],-1,'0000-00-00');
    	$newDocH = knl_extensions_dctapagar_dao::getInstance();
    	$newDocH->upsert($newmDocH);
    }
}
?>