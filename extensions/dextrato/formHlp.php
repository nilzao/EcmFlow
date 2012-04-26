<?php
class knl_extensions_dextrato_formHlp extends knl_view_w3c_hlp_FormEdit{
	private static $instance;
	private $ExtratoBancoCombo;
	private $ExtratoAgenciaCombo;
	private $ExtratoContaCombo;
	
	private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
	public function monta_ExtratoBancoCombo () {
    	$mExtratoBanco = knl_extensions_dextrato_daoExtratoBanco::getInstance()->selectAll();
    	$this->ExtratoBancoCombo = "Banco: <select name=\"id_banco\">";
    	$this->ExtratoBancoCombo .= "<option value=\"0\">Todos</option>";
    	foreach($mExtratoBanco as $v) {
    		$this->ExtratoBancoCombo .= "<option value=\"{$v->get_id()}\">{$v->get_nome()}</option>";
    	}
    	$this->ExtratoBancoCombo .="</select>";
    }
    
	public function monta_ExtratoAgenciaCombo () {
    	$mExtratoAgencia = knl_extensions_dextrato_daoExtratoAgencia::getInstance()->selectAll();
    	$this->ExtratoAgenciaCombo = "Agência: <select name=\"id_agencia\">";
    	$this->ExtratoAgenciaCombo .= "<option value=\"0\">Todas</option>";
    	foreach($mExtratoAgencia as $v) {
    		$this->ExtratoAgenciaCombo .= "<option value=\"{$v->get_id()}\">{$v->get_numero()}</option>";
    	}
    	$this->ExtratoAgenciaCombo .="</select>";
    }
    
	public function monta_ExtratoContaCombo () {
    	$mExtratoConta = knl_extensions_dextrato_daoExtratoConta::getInstance()->selectAll();
    	$this->ExtratoContaCombo = "Conta: <select name=\"id_conta\">";
    	$this->ExtratoContaCombo .= "<option value=\"0\">Todas</option>";
    	foreach($mExtratoConta as $v) {
    		$this->ExtratoContaCombo .= "<option value=\"{$v->get_id()}\">{$v->get_numero()}</option>";
    	}
    	$this->ExtratoContaCombo .="</select>";
    }
    
	public function monta_ComboExtratoConta ($id_conta){
		$Conta = knl_extensions_dextrato_daoExtratoContaVw::getInstance();
		$mConta = $Conta->selectAll2Form();
    	$this->Contas .= "<select name=\"id_conta\">\n";
    	foreach ($mConta as $v) {
    		$selected = ($v->get_id() == $id_conta) ? " selected" : "";
    		$this->Contas .= "<option{$selected} value=\"{$v->get_id()}\">{$v->get_nome_banco()} {$v->get_num_agencia()} {$v->get_num_conta()} {$v->get_nome_empresa()}</option>\n";
    	}
    	$this->Contas .= "</select>\n";
    }
    
    public function html_ExtratoBancoCombo() {
    	return $this->ExtratoBancoCombo;
    }
    
	public function html_ExtratoAgenciaCombo() {
    	return $this->ExtratoAgenciaCombo;
    }
    
	public function html_ExtratoContaCombo() {
    	return $this->ExtratoContaCombo;
    }
    
	public function html_ComboExtratoConta (){
    	return $this->Contas;
    }
}
?>