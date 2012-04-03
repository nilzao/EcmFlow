<?php
class knl_view_w3c_hlp_FormFind extends knl_view_hlp_FormFindJs {
	private static $instance;
	private $FormsSpec;
	private $DocTipoCombo;
	private $DocSubTipoCombo;
	private $DocTipoDiv;
    private $AchaCotacaoCli;
	

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_DocTipoCombo ($tipos) {
    	$this->DocTipoCombo = "<select name=\"doc_tipo\" onchange=\"mostraFormpp(this.value);\">
        <option value=\"0\">Todos</option>";
    	foreach($tipos as $v){
           	$this->DocTipoCombo .= "<option value=\"{$v->get_id()}\" >{$v->get_descricao()}</option>\n";
        }
        $this->DocTipoCombo .= "</select>";
    }
    
    public function html_DocTipoCombo(){
    	return $this->DocTipoCombo;
    }
    
    public function monta_DocTipoDiv($tipos){
    	$vl = knl_view_Loader::getInstance();
    	$this->DocTipoDiv = "";
    	foreach($tipos as $v){
    		$this->DocTipoDiv .= $vl->display($v->get_classe()."/formfind",false,true);
    	}
    }
    
    public function html_DocTipoDiv(){
    	return $this->DocTipoDiv;
    }
    
    public function monta_DocSubTipoCombo ($subtipos) {
    	$this->DocSubTipoCombo = "<select name=\"doc_sub_tipo\">
        <option value=\"0\">Todos</option>";
    	foreach($subtipos as $v){
           	$this->DocSubTipoCombo .= "<option value=\"{$v->get_id()}\">{$v->get_descricao()}</option>\n";
        }
        $this->DocSubTipoCombo .= "</select>";
    }
    
    public function html_DocSubTipoCombo(){
    	return $this->DocSubTipoCombo;
    }
}
?>