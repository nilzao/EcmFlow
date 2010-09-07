<?php
class knl_extensions_dextrato_shell {
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
		$Conta = knl_extensions_dextrato_daoExtratoConta::getInstance();
		$mConta = $Conta->selectByNumConta($valores['num_doc']);
		
		$Doc = knl_dao_doc::getInstance();
		$mDoc = $Doc->selectById($valores['id_doc']);
			$mDoc->set_id_empresa($mConta->get_id_empresa());
			$mDoc->set_numero(date("dmY"));
		$Doc->upsert($mDoc);

    	$newmDocH = new knl_extensions_dextrato_model(0,$valores['id_doc'],$mConta->get_id(),$valores['data'],$valores['data']);
    	$newDocH = knl_extensions_dextrato_dao::getInstance();
    	$newDocH->upsert($newmDocH);
    }
}
?>