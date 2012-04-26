<?php
class knl_view_w3c_hlp_DesanexaBtn {
	private static $instance;
	private $DesanexaBtn = "X";

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_DesanexaBtn ($arrayFull) {
    	$this->DesanexaBtn = "X";
        if (key_exists("desanexar",$arrayFull['docActions'])){
    	   $vl = knl_view_Loader::getInstance();
           $vl->setVar("anexoTop",$arrayFull['anexoTop']);
           $vl->setVar("id",$arrayFull['doc']->get_id());
           $this->DesanexaBtn = "<center>".$vl->display('show/BtnDesanexar', false)."</center>";
       	}
    }
    
    public function html_DesanexaBtn(){
    	return $this->DesanexaBtn;
    }
}
?>