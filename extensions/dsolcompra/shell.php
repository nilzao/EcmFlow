<?php
class knl_extensions_dsolcompra_shell {
	private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
	public function gravaNoBanco($valores) {
    	$newmDocH = new knl_extensions_dsolcompra_model(0,$valores['id_doc']);
    	$newDocH = knl_extensions_dsolcompra_dao::getInstance();
    	$newDocH->upsert($newmDocH);
    }
}
?>
