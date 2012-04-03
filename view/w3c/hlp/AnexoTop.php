<?php
class knl_view_hlp_AnexoTop {
	private static $instance;
	private $Origem = "";

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_Origem ($anexoTop) {
    	if (empty($anexoTop['doc_anexo'])) {
    		$doc_anexo = 1;
    		$origem = "Anteriores";
    	} else {
    		$doc_anexo = 0;
    		$origem = "Futuros";
    	}
    	$this->Origem .= "<a href=\"index.php?domain=Doc&action=AnexoList&metodo=ListaAnexo&doc_id={$anexoTop['doc_id']}&doc_anexo={$doc_anexo}&pag={$anexoTop['pag']}\">Alternar</a> ";
    	$this->Origem .= "Listando: $origem";
    }
    
    public function html_Origem(){
    	return $this->Origem;
    }
}
?>