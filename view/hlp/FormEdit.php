<?php
class knl_view_hlp_FormEdit extends knl_view_hlp_FormEditJs {
	private static $instance;
	private $FormSpec = "";
	private $Fornecedor = "";
	private $FornecedorCnpj = "";
	private $Carimbos = "";
	private $Empresas = "";
    private $CotacaoCli = "";
	private $CampoData = array();
	private $CampoValor = array();

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_FormSpec ($cabecalho) {
    	$vl = knl_view_Loader::getInstance();
    	$this->FormSpec .= $vl->display($cabecalho['docTipo']->get_classe()."/formedit", false,true);
    }
    
    public function html_FormSpec(){
    	return $this->FormSpec;
    }
    
    public function monta_Carimbo ($carimbos,$doc_carimbos){
    	if (empty($doc_carimbos)){
    		$doc_carimbos= array("x");
    	}
    	$this->Carimbos .= "<select name=\"carimbo[]\">\n";
    	$this->Carimbos .= "<option value=\"0\">Selecione</option>\n";
    	foreach ($doc_carimbos as $doccarimbo) {
    		foreach ($carimbos as $v) {
    			$iddoccarimbo = ($doccarimbo == "x") ? 0 : $doccarimbo->get_id_carimbo();
    			$selected = ($v->get_id() == $iddoccarimbo) ? " selected" : "";
    			$this->Carimbos .= "<option{$selected} value=\"{$v->get_id()}\">{$v->get_descricao()}</option>\n";
    		}
    	}
    	
    	$this->Carimbos .= "</select>\n";
    }
    
    public function html_Carimbo () {
    	return $this->Carimbos;
    }

    public function monta_ComboEmpresa ($empresas,$id_empresa){
    	$this->Empresas .= "<select name=\"id_empresa\">\n";
    	foreach ($empresas as $v) {
    		$selected = ($v->get_id() == $id_empresa) ? " selected" : "";
    		$this->Empresas .= "<option{$selected} value=\"{$v->get_id()}\">{$v->get_fantasia()}</option>\n";
    	}
    	$this->Empresas .= "</select>\n";
    }
    
    public function monta_CampoData ($valor,$nome) {
    	$this->CampoData[$nome] = "<input type=\"text\" id=\"$nome\" name=\"$nome\" value=\"$valor\" size=\"10\"  maxlength=\"10\" onFocus=\"this.select();\" onKeyPress=\"return(so_numero(event));\" onKeyUp=\"mask_data(this,event)\">";
    	$this->monta_CampoDataJs();
    }
    
    public function monta_CampoValor ($valor,$nome) {
    	$this->CampoValor[$nome] = "<input type=\"text\" id=\"$nome\" name=\"$nome\" value=\"$valor\" onFocus=\"this.select();\" size=\"11\">";
    	$this->monta_CampoValorJs();
    }
    
	public function html_ComboEmpresa (){
    	return $this->Empresas;
    }

	public function html_CampoData ($nome){
    	return $this->CampoData[$nome];
    }
    
	public function html_CampoValor ($nome){
    	return $this->CampoValor[$nome];
    }
}
?>