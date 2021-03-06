<?php
class knl_extensions_dcotcompra_criteria extends knl_lib_daoext_Convert {
	private static $instance;
	private $sql;
	private $ArrayBind = array();
	private $innerJoin;
	private $orderBy = array();
	private $groupBy;
	private $arrayFiltroOut = array();
	
	private function __construct(){}
  
	public static function getInstance(){
  		if (!isset(self::$instance)){
  			self::$instance = new self();
  		}
  		return self::$instance;
	}
	
	public function montaSql($arrayFiltro){
		$this->sql = "";
		$this->innerJoin .= " LEFT JOIN d_cot_compra ON (tb.id = d_cot_compra.id_doc) ";
    	$this->orderBy = array("tb.numero");
    	
	    $this->innerJoin .= " LEFT JOIN d_cotacao_cli ON (d_cotacao_cli.id = d_cot_compra.id_fornecedor) ";
	    $this->orderBy = array("d_cotacao_cli.nome","tb.numero");
	    if (!empty($arrayFiltro['cotacao_cli'])){
	        $this->sql .= " AND d_cotacao_cli.nome = ? ";
	        $this->ArrayBind[] = $arrayFiltro['cotacao_cli'];
	    }
	}
	
	public function getSql(){
		return $this->sql;
	}
	
	public function getInnerJoin(){
		return $this->innerJoin;
	}
	
	public function getOrderBy(){
		return $this->orderBy;
	}
	
	public function getArrayFiltroOut(){
		return $this->arrayFiltroOut;
	}
	
	public function getArrayBind(){
		return $this->ArrayBind;
	}
}
?>