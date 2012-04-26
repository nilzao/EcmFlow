<?php
class knl_view_w3c_hlp_ShowPag {
	private static $instance;
	private $Paginas = "";
	private $PaginasCss = "<link rel=\"stylesheet\" href=\"view/w3c/css/paginas.css\" type=\"text/css\">\n";
	private $PaginasJs = "
	<script>
	  function loadPag (id_doc,pag){
	      document.location = 'index.php?domain=Doc&action=DocShow&id='+id_doc+'&pag='+pag;
	  }
	</script>\n";

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_Paginas ($id_doc,$pags = 1,$pagatual = 1) {
    	if($pags > 1){
    		$this->Paginas = "<div id=\"doc_show_paginas_label\">Páginas:</div>\n";
    		$this->Paginas .= "<div id=\"doc_show_paginas_div\">\n";
    		$this->Paginas .= "<select id=\"doc_show_paginas_select\" onchange=\"loadPag($id_doc,this.value)\">";
    		for ($i=1;$i<=$pags;$i++) {
    			$selected = ($pagatual == $i) ? " selected" : "";
    			$this->Paginas .= "<option value=\"{$i}\"{$selected}>$i</option>\n";
    		}
    		$this->Paginas .= "</select>\n</div>";
    	}
    }
    
    public function html_Paginas(){
    	return $this->Paginas;
    }
    
    public function js_Paginas(){
    	return $this->PaginasJs;
    }
    
    public function css_Paginas(){
    	return $this->PaginasCss;
    }
}
?>