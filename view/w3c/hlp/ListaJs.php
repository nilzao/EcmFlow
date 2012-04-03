<?php
class knl_view_w3c_hlp_ListaJs {
	private static $instance;
	private $ListaJs = "";

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_ListaJs () {
    	$this->ListaJs = "<script>\n";
    	$this->ListaJs .= "// abre janela maximizada
    	function abreM(url,janela){
    	  W = eval(screen.width)-10;
    	  H = eval(screen.height)-54;
    	  window.open(url,janela,\"toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,copyhistory=0,width=\"+W+\",height=\"+H+\",top=0,left=0\");
        }\n";
    	$this->ListaJs .= "</script>\n";
		$this->ListaJs .= "<link rel=\"stylesheet\" href=\"./view/w3c/css/lista.css\" type=\"text/css\">";
    }
    
    public function set_ListaJs($js){
    	$this->ListaJs = $js."\n";
    }
    
    public function js_ListaJs(){
	    return $this->ListaJs;
    }
}
?>