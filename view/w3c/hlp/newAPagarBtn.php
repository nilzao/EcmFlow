<?php
class knl_view_w3c_hlp_newAPagarBtn {
	private static $instance;
	private $AnexaBtn = "X";

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_newAPagarBtn ($doc) {
           $this->AnexaBtn = "<center><a href=\"index.php?domain=CtlAPagar&action=FormAPagarEdit&id={$doc->get_id()}\">CAP</a></center>";
    }
    
    public function html_newAPagarBtn(){
    	return $this->AnexaBtn;
    }
}
?>