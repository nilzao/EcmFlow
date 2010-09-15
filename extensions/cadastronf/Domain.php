<?php
class knl_extensions_cadastronf_Domain {
	private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
	
	public function handle() {
		$request = knl_lib_Registry::getRequestObj()->getInstance();
		$metodo = $request->getGet('action');
		$this->$metodo();
	}
	
	public function FornList () {		
		$request = knl_lib_Registry::getRequestObj();
		
		$razao = $request->getGet('razao');

		$razao = (empty($razao)) ? "XXX" : $razao ;
		$lista = knl_extensions_cadastronf_caddao::getInstance()->selectListagemByRazao($razao);
		$paginacao = $lista['detalhes'];
		unset($lista['detalhes']);
        $vl = knl_view_Loader::getInstance();
        $vl->setVar("lista",$lista);
        $vl->setVar("paginacao",$paginacao);
        $vl->setVar("urlAdd",array('domain'=>'Fornecedor','action'=>'FornList'));
        $vl->display("cadastronf/CadVwList",true,true);
	}
	
	public function FornFind () {
		$request = knl_lib_Registry::getRequestObj();
		$cnpj = $request->getGet('cnpj');
		$fornecedor = knl_extensions_cadastronf_caddao::getInstance()->selectByCnpj($cnpj);
			$vl = knl_view_Loader::getInstance();
			$vl->setVar("fornecedor",$fornecedor);
			$vl->display("cadastronf/CadVwAjx",true,true);
	}

	public function FornFindChar() {
		$request = knl_lib_Registry::getRequestObj();
		$str_parte = $request->getGet('nome');
		$cotacao_cli = knl_extensions_cadastronf_cotDao::getInstance()->selectByParteNome($str_parte);
		$vl = knl_view_Loader::getInstance();
		$vl->setVar("cotacao_cli",$cotacao_cli);
		$vl->display("cadastronf/CotVwAjx",true,true);
	}
}
?>