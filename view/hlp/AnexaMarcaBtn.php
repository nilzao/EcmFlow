<?php
class knl_view_hlp_AnexaMarcaBtn {
	private static $instance;
	private $AnexaMarcaBtn = "X";

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_AnexaMarcaBtn ($array_full) {
    	//$this->AnexaMarcaBtn = "<center>".$doc_anexo->get_id()."</center>";
    	//$this->AnexaMarcaBtn = "<center><img src=\"./img/icones/anexo.png\" onclick=\"parent.set_follow('anx_".$array_full["doc_anexo"]->get_id()."','./img/icones/anexo.png','','".$array_full["doc_anexo"]->get_id()."','AnexoSetxy');\"></center>\n";
    	
        if (key_exists("desanexar",$array_full['docActions']) and empty($array_full['anexoTop']['doc_anexo'])){
    	   //$vl = knl_view_Loader::getInstance();
           //$vl->setVar("anexoTop",$arrayFull['anexoTop']);
           //$vl->setVar("id",$arrayFull['doc']->get_id());
           $this->AnexaMarcaBtn = "<center><img src=\"./img/icones/anexo.png\" onclick=\"parent.set_follow('anx_".$array_full["doc_anexo"]->get_id()."','./img/icones/anexo.png','','".$array_full["doc_anexo"]->get_id()."','AnexoSetxy');\"></center>\n";
       	}
    }
    
    public function html_AnexaMarcaBtn(){
    	return $this->AnexaMarcaBtn;
    }
}
?>