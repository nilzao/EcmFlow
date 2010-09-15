<?php
class knl_view_hlp_Paginacao {
	private static $instance;
	private $Paginacao = "";
	private $ProximaPag = "Próxima";
	private $PagAnterior = "Anterior";
	private $Atualiza = "";
	/*
	private $PagAtual = "";
	private $PagLimit = "";
	private $TotalPagAtual = "";
	private $TotalReg = "";
	private $MaxPag = "";
    */

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function monta_Paginacao ($paginacao,$urlAdd) {
    	$this->Paginacao = "<table border=\"1\"><tr><td>";
    	$arrayFiltro = $paginacao->get_arrayFiltro();
    	$arrUrl = array();
    	foreach($urlAdd as $k=>$v){
    		$arrUrl[] = "$k=$v";
    	}
    	$url = implode("&",$arrUrl);
   	
    	$arrayFiltro['pag'] = ($paginacao->get_pagatual() == 1) ? 0 : ($paginacao->get_pagatual() - 2);
    	$urlAnt = $url.$this->montaUrl($arrayFiltro);
    	
    	$arrayFiltro['pag'] = ($paginacao->get_pagatual() == $paginacao->get_maxpag()) ? ($paginacao->get_pagatual()-1) : ($paginacao->get_pagatual());
    	$urlProx = $url.$this->montaUrl($arrayFiltro);
    	if($paginacao->get_pagatual() != 1) {
    		$this->PagAnterior = "<a href=\"index.php?{$urlAnt}\">$this->PagAnterior</a>";
    	}
    	if ($paginacao->get_pagatual() != $paginacao->get_maxpag() and $paginacao->get_totalreg() != 0){
    		$this->ProximaPag = "<a href=\"index.php?{$urlProx}\">$this->ProximaPag</a>";
    	}
    	if ($paginacao->get_totalreg() != 0){
    		$this->Paginacao .= $this->PagAnterior."</td><td>Total: {$paginacao->get_totalreg()} Pag {$paginacao->get_pagatual()} de {$paginacao->get_maxpag()} Mostrando: {$paginacao->get_totalpagatual()}</td><td>".$this->ProximaPag."</td></tr>";
    	} else {
    		$this->Paginacao = "";
    	  }
    	
    }
    
    public function monta_Atualiza($paginacao,$urlAdd){
    	$arrayFiltro = $paginacao->get_arrayFiltro();
    	$arrUrl = array();
    	foreach($urlAdd as $k=>$v){
    		$arrUrl[] = "$k=$v";
    	}
    	$url = implode("&",$arrUrl).$this->montaUrl($arrayFiltro);
    	$this->Atualiza .= "<a id=\"atualiza\" href=\"index.php?{$url}\">Atualizar</a>";
    }
    
    private function montaUrl($arrayFiltro){
    	$url = "";
    	foreach ($arrayFiltro as $k=>$v){
    		$url .= "&".$k."=".$v;
    	}
    	return $url;
    }
    
    public function html_Paginacao (){
    	return $this->Paginacao;
    }
    
    public function html_Atualiza () {
    	return $this->Atualiza;
    }
}
?>