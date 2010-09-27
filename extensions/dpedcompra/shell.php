<?php
class knl_extensions_dpedcompra_shell {
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
    	$newmDocH = new knl_extensions_dpedcompra_model(0,$valores['id_doc'],-1);
    	$newDocH = knl_extensions_dpedcompra_dao::getInstance();
    	$newDocH->upsert($newmDocH);
    }
}
?>