<?php
class knl_view_hlp_ShowDiv {
	private static $instance;
	private $DivCss= "";
	private $DivJs = "";
	private $DivHtml = "";

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_Div ($vars) {
    	foreach($vars as $k=>$v){
    		if (substr_count($k,";") == 0){$k = "$k;$k";}
    		$arr = explode(";",$k);
    		$this->DivHtml .= "<div id=\"{$arr[0]}_label\">{$arr[1]}</div><div id=\"{$arr[0]}\">$v</div>\n";
    	}
    }
    
    public function set_css_Div($css){
    	$this->DivCss .= $css."\n";
    }
    
    public function set_js_Div($js){
    	$this->DivJs .= $js."\n";
    }
    
    public function set_html_Div($html){
    	$this->DivHtml .= $html;
    }
    
    public function html_Div(){
    	return $this->DivHtml;
    }
    
    public function css_Div(){
    	return $this->DivCss;
    }
    
    public function js_Div(){
    	return $this->DivJs;
    }
}
?>