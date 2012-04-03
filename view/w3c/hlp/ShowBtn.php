<?php
class knl_view_hlp_ShowBtn {
	private static $instance;
	private $BtnAnexar = "";
	private $BtnExcluir = "";
	private $BtnAprovar = "";
	private $BtnEditar = "";
	private $BtnDesanexar = "";
	private $BtnObs = "";
	private $BtnEditarJs = "<script>
// abre janela
    	function abreW(url,janela){
    	  W = 400;
    	  H = 300;
    	  window.open(url,janela,\"toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,copyhistory=0,width=\"+W+\",height=\"+H+\",top=0,left=0\");
        }
</script>\n";

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_Actions ($actions,$obsCount = 0) {
    	$vl = knl_view_Loader::getInstance();
        if (key_exists("excluir",$actions)){
           $this->BtnExcluir = $vl->display('show/BtnExcluir', false);
       	}
       	
        $this->BtnAnexar = $vl->display('show/BtnAnexar', false);
       	
       	if ($obsCount == 0){
       		$this->BtnObs = $vl->display('show/BtnObs',false);
       	} else{
       		$this->BtnObs = $vl->display('show/BtnObsP',false);
       	}
       	
        if (key_exists("aprovar",$actions)){
           $this->BtnAprovar = $vl->display('show/BtnAprovar', false);
       	}
       	
        if (key_exists("editar",$actions)){
           $this->BtnEditar = $vl->display('show/BtnEditar', false);
       	}
    }
    
    public function monta_Desanexar ($actions,$id,$anexoTop){
    	if (key_exists("desanexar",$actions)){
    	   $vl = knl_view_Loader::getInstance();
           $vl->setVar("anexoTop",$anexoTop);
           $vl->setVar("id",$id);
           $this->BtnDesanexar = $vl->display('show/BtnDesanexar', false);
       	}
    }
    
    public function html_Action($BtnNome){
    	$atrib = "Btn".$BtnNome;
    	return $this->$atrib;
    }
    
    public function js_Editar(){
    	return $this->BtnEditarJs;
    }
}
?>