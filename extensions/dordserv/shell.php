<?php
class knl_extensions_dordserv_shell {
	private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
	public function gravaNoBanco($valores) {
    	$newmDocH = new knl_extensions_dordserv_model(0,$valores['id_doc'],-1,0,0);
    	$newDocH = knl_extensions_dordserv_dao::getInstance();
    	$newDocH->upsert($newmDocH);
    }
}
?>
