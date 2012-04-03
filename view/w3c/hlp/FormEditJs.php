<?php
class knl_view_hlp_FormEditjs {
	private static $instance;
	private $FormEditJs = "";
	private $FormEditHtml = array();
	private $FormEditBtn = array();
	private $SoNumJs = "";
	private $CampoDataJs = "";
	private $CampoValorJs = "";
	private $CnpjJs = "";
        private $AchaCotacaoCliJs=0;
	
    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_Add ($view,$nomespace,array $arrValues) {
    	$nome = str_replace(" ","",$nomespace);
    	$vl = knl_view_Loader::getInstance();
    	$id_ini = 1;
    	$delHtml = "<a onclick=\"del_div{$nome}(***);\">Del</a>";
    	
    	$this->FormEditHtml[$nome] = "<div id=\"div_add{$nome}\">";
    	foreach ($arrValues as $v){
    		$vl->setVar("recursos",$v);
    		$delHtmlDiv = str_replace("***","'$id_ini'",$delHtml);
    		$this->FormEditHtml[$nome] .= "<div id=\"div_add{$nome}{$id_ini}\">".$vl->display($view,false,true).$delHtmlDiv."</div>\n\n";
    		$id_ini++;
    	}
    	$vl->setVar("recursos","x");
    	$delHtmlDiv = str_replace("***","'$id_ini'",$delHtml);
    	$this->FormEditHtml[$nome] .= "<div id=\"div_add{$nome}{$id_ini}\">".$vl->display($view,false,true).$delHtmlDiv."</div>\n\n";
    	$id_ini++;
    	
    	$html = $vl->display($view,false,true);
    	$html = str_replace("\"","\\\"",$html);
    		$stringlimpa = $html;
    		$stringlimpa = str_replace("\x0A"," ",$stringlimpa);
    		$stringlimpa = str_replace("\x0B"," ",$stringlimpa);
    		$stringlimpa = str_replace("\x0C"," ",$stringlimpa);
    		$stringlimpa = str_replace("\x0D"," ",$stringlimpa);
    		$stringlimpa = str_replace("\x0E"," ",$stringlimpa); 
    		$html = $stringlimpa;
    		$del = str_replace("\"","\\\"",$delHtml);
    		$del = str_replace("***","\"+id{$nome} +\"",$del);
    		$this->FormEditJs .= "
<script>
var id{$nome} = {$id_ini};

function del_div{$nome} (id) {
    filho = document.getElementById('div_add{$nome}' + id);
	document.getElementById('div_add{$nome}').removeChild(filho);
}

function add_div{$nome} () {
	var html = \"{$html}\";
    var del = \"{$del}\";
    var div_add = document.createElement('div');
    div_add.setAttribute('id','div_add{$nome}' + id{$nome});
	document.getElementById('div_add{$nome}').appendChild(div_add);
	document.getElementById('div_add{$nome}' + id{$nome}).innerHTML = html + del ;
	return id{$nome}++;
}
</script>";
		$this->FormEditHtml[$nome] .="</div>\n\n";
		$this->FormEditBtn[$nome] = "<input type=\"button\" onclick=\"add_div{$nome}();\" value=\"{$nomespace}\">\n\n";
    }
    
    public function js_Add(){
    	return $this->FormEditJs;
    }
    
    public function html_Add($nome){
    	return $this->FormEditHtml[$nome];
    }
    
	public function html_btn_Add($nome){
    	return $this->FormEditBtn[$nome];
    }
	
	public function monta_SoNumJs() {
		$this->SoNumJs = "<script type=\"text/javascript\" src=\"./view/js/sonum.js\"></script>\n";
	}
    
    public function monta_CampoDataJs() {
		$this->CampoDataJs = "<script type=\"text/javascript\" src=\"./view/js/data.js\"></script>\n";
    }

    public function monta_CampoValorJs() {
		$this->CampoValorJs = "
<script>
// aqui vai uma vez só o arquivo de javascript pro campo valor
</script>
";
    }

	public function js_Js () {
		$this->monta_SoNumJs();
		$this->Js .= $this->SoNumJs;
		$this->Js .= $this->CampoDataJs;
		$this->Js .= $this->CampoValorJs;
    	return $this->Js;
    }
}
?>