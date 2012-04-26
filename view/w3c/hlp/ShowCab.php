<?php
class knl_view_w3c_hlp_ShowCab {
	private static $instance;
	private $Cabecalho = "";

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_Cabecalho ($cabecalho) {
    	$vl = knl_view_Loader::getInstance();
        $this->Cabecalho = $vl->display("".$cabecalho['docTipo']->get_classe()."/cabshow", false,true);
    }
    
    public function html_Cabecalho(){
    	return $this->Cabecalho;
    }
}
?>