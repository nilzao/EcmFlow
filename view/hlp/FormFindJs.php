<?php
class knl_view_hlp_FormFindJs {
	private static $instance;
	private $FormsSpec;
    private $AchaCotacaoCliJs = 0;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_FormsSpec ($tipos) {
    	$vl = knl_view_Loader::getInstance();
    	$js_show = "";
    	foreach($tipos as $v){
        	$this->FormSpec .= "";
        	$js_show .= "		case '".$v->get_id()."':\n";
        	$js_show .='			$("#'.$v->get_classe().'").clone().appendTo("#formpp");';
        	$js_show .= "		break;\n";
        }
        $this->FormsSpec .= '
<script>
function mostraFormpp(formppName){
	$("#formpp > div").remove();
	switch(formppName){
'.$js_show.'
	}
}
</script>
';
    }
    
    public function set_js_FormSpec($js){
    	$this->FormsSpec .= $js."\n";
    }
    
    public function js_FormsSpec(){
    	return $this->FormsSpec;
    }

    /* Inicio Limpeza */
    public function monta_AchaCotacaoCliJs(){
        if ($this->AchaCotacaoCliJs == 0){
            $this->FormsSpec .= "\n<script type=\"text/javascript\" src=\"./view/js/cotacao_cli.js\"></script>\n";
            $this->AchaCotacaoCliJs = 1;
        }
    }
    /* Fim limpeza */
}
?>