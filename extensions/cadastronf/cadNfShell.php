<?php
class knl_extensions_cadastronf_cadNfShell {
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
		$model = "knl_extensions_".$valores['classe']."_model";
    	$newmDocH = new $model(0,$valores['id_doc'],0,$valores['data']);
    	$newDocH = call_user_func("knl_extensions_".$valores['classe']."_dao::getInstance");
    	$newDocH->upsert($newmDocH);
    }
}
?>