<?php
class knl_extensions_dcotcompra_shell {
	private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
	public function gravaNoBanco($valores) {
    	$newmDocH = new knl_extensions_dcotcompra_model(0,$valores['id_doc'],-1);
    	$newDocH = knl_extensions_dcotcompra_dao::getInstance();
    	$newDocH->upsert($newmDocH);
    }
}
?>
