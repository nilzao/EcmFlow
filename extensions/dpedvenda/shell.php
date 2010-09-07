<?php
class knl_extensions_dpedvenda_shell {
	private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
	public function gravaNoBanco($valores) {
		//print_r($valores);
    	$newmDocH = new knl_extensions_dpedvenda_model(0,$valores['id_doc'],0);
    	$newDocH = knl_extensions_dpedvenda_dao::getInstance();
    	$newDocH->upsert($newmDocH);
    }
}
?>