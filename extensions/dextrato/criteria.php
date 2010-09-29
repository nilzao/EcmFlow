<?php
class knl_extensions_dextrato_criteria extends knl_lib_daoext_Convert {
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
		$this->arrayFiltroOut = $arrayFiltro;
		$this->sql = "";
		$this->innerJoin .= " LEFT JOIN d_extrato ON (tb.id = d_extrato.id_doc) ";
	  	$this->innerJoin .= " LEFT JOIN d_extrato_conta ec ON (ec.id = d_extrato.id_conta) ";
	  	$this->innerJoin .= " LEFT JOIN d_extrato_agencia ea ON (ea.id = ec.id_agencia) ";
	  	$this->innerJoin .= " LEFT JOIN d_extrato_banco eb ON (eb.id = ea.id_banco) ";
		$this->orderBy = array("d_extrato.data_ini","ec.numero");
		
	  	if(!empty($arrayFiltro['data1'])){
	  		$this->sql .= " AND ((d_extrato.data_ini >= ?) OR d_extrato.data_fim >= ?) ";
	  		$this->ArrayBind[] = $arrayFiltro['data1'];
	  		$this->ArrayBind[] = $arrayFiltro['data1'];
	  		$this->arrayFiltroOut['data1'] = $this->data_mysql_to_br($this->arrayFiltroOut['data1'],"-");
	  	}
	  	if(!empty($arrayFiltro['data2'])){
	  		$this->sql .= " AND ((d_extrato.data_ini <= ?) OR d_extrato.data_fim <= ?) ";
	  		$this->ArrayBind[] = $arrayFiltro['data2'];
	  		$this->ArrayBind[] = $arrayFiltro['data2'];
	  		$this->arrayFiltroOut['data2'] = $this->data_mysql_to_br($this->arrayFiltroOut['data2'],"-");
	  	}
	
	  	if (!empty($arrayFiltro['id_conta'])) {
	  		$this->sql .= " AND (ec.id = ?) ";
	  		$this->ArrayBind[] = $arrayFiltro['id_conta'];
	  	}
	  	
	  	if (!empty($arrayFiltro['id_agencia'])) {
	  		$this->sql .= " AND (ea.id = ?) ";
	  		$this->ArrayBind[] = $arrayFiltro['id_agencia'];
	  	}
	  	
	  	if (!empty($arrayFiltro['id_banco'])) {
	  		$this->sql .= " AND (eb.id = ?) ";
	  		$this->ArrayBind[] = $arrayFiltro['id_banco'];
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