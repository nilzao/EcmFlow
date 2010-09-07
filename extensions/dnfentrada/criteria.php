<?php
class knl_extensions_dnfentrada_criteria extends knl_lib_daoext_Convert {
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
		$this->innerJoin = " LEFT JOIN d_nf_entrada nfe ON (tb.id = nfe.id_doc) ";
	    $this->innerJoin .= " LEFT JOIN d_cad_nf nfeforn ON (nfeforn.id = nfe.id_fornecedor) ";
	    $this->orderBy = array("nfe.dataent","nfeforn.razao","tb.numero");
	  	if (!empty($arrayFiltro['data2'])){
	  	   $this->sql .= " AND nfe.dataent <= ? ";
	  	   $this->ArrayBind[] = $arrayFiltro['data2'];
		   $this->arrayFiltroOut['data2'] = $this->data_mysql_to_br($this->arrayFiltroOut['data2'],"-");
	    }
	  	if (!empty($arrayFiltro['data1'])){
	  	   $this->sql .= " AND nfe.dataent >= ? ";
	  	   $this->ArrayBind[] = $arrayFiltro['data1'];
		   $this->arrayFiltroOut['data1'] = $this->data_mysql_to_br($this->arrayFiltroOut['data1'],"-");
	    }
	    if (!empty($arrayFiltro['cnpj'])){
	    	$this->sql .= " AND nfeforn.cnpj = ? ";
	    	$arrayFiltro['cnpj'] = $this->limpacnpj($arrayFiltro['cnpj']);
	    	$this->ArrayBind[] = $arrayFiltro['cnpj'];
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