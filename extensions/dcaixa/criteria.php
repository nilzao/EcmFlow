<?php
class knl_extensions_dcaixa_criteria extends knl_lib_daoext_Convert {
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
		$this->innerJoin .= " LEFT JOIN d_caixa ON (tb.id = d_caixa.id_doc) ";
		$this->orderBy = array("d_caixa.data_ini","tb.numero");
	  	if(!empty($arrayFiltro['data1'])){
	  		$this->sql .= " AND ((d_caixa.data_ini >= ?) OR d_caixa.data_fim >= ?) ";
	  		$this->ArrayBind[] = $arrayFiltro['data1'];
	  		$this->ArrayBind[] = $arrayFiltro['data1'];
	  		$this->arrayFiltroOut['data1'] = $this->data_mysql_to_br($this->arrayFiltroOut['data1'],"-");
	  	}
	  	if(!empty($arrayFiltro['data2'])){
	  		$this->sql .= " AND ((d_caixa.data_ini <= ?) OR d_caixa.data_fim <= ?) ";
	  		$this->ArrayBind[] = $arrayFiltro['data2'];
	  		$this->ArrayBind[] = $arrayFiltro['data2'];
	  		$this->arrayFiltroOut['data2'] = $this->data_mysql_to_br($this->arrayFiltroOut['data2'],"-");
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