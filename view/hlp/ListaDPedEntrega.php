<?php
class knl_view_hlp_ListaDPedEntrega {
	private static $instance;
	private $DataEntrega = "";

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_ListaDPedEntrega ($datas) {
    	$this->DataEntrega = "";
    	foreach($datas as $v){
    		$this->DataEntrega .= $v->get_dataentrega()."<br>\n";
    	}
    }
    
    public function html_ListaDPedEntrega (){
    	return $this->DataEntrega;
    }
}
?>