<?php
class knl_view_w3c_hlp_AnexaBtn {
	private static $instance;
	private $AnexaBtn = "X";

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_AnexaBtn ($arrayFull) {
    	$this->AnexaBtn = "X";
        if (key_exists("anexar",$arrayFull['docActions'])){
    	   $vl = knl_view_Loader::getInstance();
           $vl->setVar("id",$arrayFull['id']);
           $vl->setVar("doc_id",$arrayFull['doc']->get_id());
           $vl->setVar("doc_anexo",$arrayFull['doc_anexo']);
           $this->AnexaBtn = "<center>".$vl->display('show/BtnNewAnexar', false)."</center>";
       	}
    }
    
    public function html_AnexaBtn(){
    	return $this->AnexaBtn;
    }
}
?>