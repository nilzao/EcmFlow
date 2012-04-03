<?php
class knl_view_hlp_PendBtn {
	private static $instance;
    private $PendBtnHtml = "";
    private $PendBtnJs = "";

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_PendBtn ($pendencias) {
    	$vl = knl_view_Loader::getInstance();
    	$PendTipo = knl_dao_doc_pendencia_tipo::getInstance();
    	$this->PendBtnHtml = "";
        foreach ($pendencias as $p){
        	$mPendTipo = $PendTipo->selectById($p->get_id_doc_pendencia_tipo());
            $this->PendBtnHtml .= $vl->display("pendlist/Btn".$mPendTipo->get_descricao(),false);
    	}
    }
    
    public function html_PendBtn(){
    	return $this->PendBtnHtml;
    }
    
    public function js_PendBtn(){
    	return $this->PendBtnJs;
    }
}
?>