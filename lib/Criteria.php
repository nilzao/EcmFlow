<?php
class knl_lib_Criteria extends knl_lib_daoext_Convert{
  private static $instance;
  private $sql;
  private $ArrayBind = array();
  private $pagina = 0;
  private $innerJoin;
  private $orderBy = array();
  private $groupBy;
  private $arrayFiltroOut = array();
  /*
   * no futuro, exigir estas variaveis no construct, e utilizar dentro da classe normalmente
   * sem ter que ficar passando de um metodo pro outro.
  private $arrayFiltro;
  private $arrayGrupos;
  private $id_usuario;
  private $id_grupo;
  private $pagina;
   */  
  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }
  
  public function montaSqlCred($id_usuario,$id_grupo,$arrayGrupos,$arrayFiltro = array()){
  	$this->sql = " AND ((cr.id_knl_usuario = ? AND cr.perm_usuario & 1)
     	    OR (cr.id_knl_grupo = ? AND cr.perm_grupo & 1)";
  	foreach ($arrayGrupos as $grupo){
  		$this->sql .= " OR (cr.id_knl_grupo = ? AND cr.perm_grupo & 1)";
  	}
     $this->sql .= " OR (cr.perm_outros & 1)) ";
     $this->ArrayBind = array_merge(array($id_usuario,$id_grupo),$arrayGrupos);
  }
  
  public function montaSqlListaDoc($id_usuario,$id_grupo,$arrayGrupos,$arrayFiltro){
  	$this->arrayFiltroOut = $arrayFiltro;
  	unset ($this->arrayFiltroOut['id_empresa']);
  	$this->montaSqlCred($id_usuario,$id_grupo,$arrayGrupos);
  	$this->innerJoin .= " LEFT JOIN doc_cred cr ON (cr.id_doc = tb.id) ";
  	$this->orderBy = array("tb.data_doc","tb.id_doc_tipo","tb.numero");
  	//$arrayFiltro['data_ini'] = (!empty($arrayFiltro['data_ini'])) ? $arrayFiltro['data_ini'] : "0000-00-00" ;
  	if (!empty($arrayFiltro['doc_num'])){
  	   $this->sql .= " AND tb.numero = ? ";
  	   $this->ArrayBind[] = $arrayFiltro['doc_num'];
  	}
    if (!empty($arrayFiltro['data_fim'])){
  	   $this->sql .= " AND data_doc <= ? ";
  	   $this->ArrayBind[] = $arrayFiltro['data_fim'];
  	   $this->arrayFiltroOut['data_fim'] = $this->data_mysql_to_br($this->arrayFiltroOut['data_fim'],"-");
    }
    if (!empty($arrayFiltro['data_ini']))
  	{
  	   $this->sql .= " AND tb.data_doc >= ? ";
  	   $this->ArrayBind[] = $arrayFiltro['data_ini'];
  	   $this->arrayFiltroOut['data_ini'] = $this->data_mysql_to_br($this->arrayFiltroOut['data_ini'],"-");
    }
    
    if (!empty($arrayFiltro['doc_tipo'])){
        $this->sql .= " AND tb.id_doc_tipo = ? ";
  	    $this->ArrayBind[] = $arrayFiltro['doc_tipo'];
    }
    if (!empty($arrayFiltro['doc_sub_tipo'])){
    	$this->sql .= " AND tb.id_doc_sub_tipo = ? ";
  	    $this->ArrayBind[] = $arrayFiltro['doc_sub_tipo'];
    }
    
    if (!empty($arrayFiltro['doc_sub_tipo'])){
    	$this->sql .= " AND tb.id_doc_sub_tipo = ? ";
  	    $this->ArrayBind[] = $arrayFiltro['doc_sub_tipo'];
    }
    
    if (!empty($arrayFiltro['id_empresa'])){
    	$this->sql .= " AND tb.id_empresa = ? ";
  	    $this->ArrayBind[] = $arrayFiltro['id_empresa'];
    }
    
  	$this->pagina = $arrayFiltro['pag'];
  	
  	if(!empty($arrayFiltro['tipoClasse'])){
  		//throw new Exception("depurando");
  		$criteriaext = call_user_func("knl_extensions_{$arrayFiltro['tipoClasse']}_criteria::getInstance");
  		$criteriaext->montaSql($arrayFiltro);
  		$this->sql .= $criteriaext->getSql();
  		$this->innerJoin .= $criteriaext->getInnerJoin();
  		$this->orderBy = array_merge($this->orderBy,$criteriaext->getOrderBy());
  		$this->arrayFiltroOut = array_merge($this->arrayFiltroOut,$criteriaext->getArrayFiltroOut()) ;
  		$this->ArrayBind = array_merge($this->ArrayBind,$criteriaext->getArrayBind());
  	}
  	
    if (!empty($arrayFiltro['metodo'])){
  		$metodo = "montaSql".$arrayFiltro['metodo'];
  		$this->$metodo($id_usuario,$id_grupo,$arrayGrupos,$arrayFiltro);
  	}
  }
  
  public function montaSqlListaPendencia($id_usuario,$id_grupo,$arrayGrupos){
  	$this->innerJoin .= " LEFT JOIN doc_pendencia dp ON (dp.id_doc = tb.id) ";
  	$this->sql .= " AND ((dp.id_knl_usuario = ? OR ";
    foreach ($arrayGrupos as $grupo){
  		$this->sql .= " dp.id_knl_grupo = ? OR ";
  	}
  	$this->sql .= " dp.id_knl_grupo = ?)) ";
  	$this->ArrayBind = array_merge($this->ArrayBind,array($id_usuario),$arrayGrupos,array($id_grupo));
  	$this->groupBy = " GROUP BY tb.id ";
  }


  public function montaSqlListaAnexo($id_usuario,$id_grupo,$arrayGrupos,$arrayFiltro){
  	$this->sql .= ($arrayFiltro['doc_anexo'] == 0) ? " AND da.id_doc2 = ? " : " AND da.id_doc1 = ? ";
  	$this->ArrayBind[] = $arrayFiltro['doc_id'];
  }
  
  public function montaSqlListaNewAnexo($id_usuario,$id_grupo,$arrayGrupos,$arrayFiltro = array()){
  	$sql = " AND (id_knl_usuario = ? AND perm_usuario & 64)
     	    OR (id_knl_grupo = ? AND perm_grupo & 64)";
  	foreach ($arrayGrupos as $grupo){
  		$sql .= " OR (id_knl_grupo = ? AND perm_grupo & 64)";
  	}
     $sql .= " OR (perm_outros & 64) ";
     $this->sql = $sql;
     $this->ArrayBind = array_merge(array($id_usuario,$id_grupo),$arrayGrupos);
  }
  
/*  
 
  public function montaSql_d_cotacao($arrayFiltro){
    $this->innerJoin .= " LEFT JOIN d_cotacao ON (tb.id = d_cotacao.id_doc) ";
    $this->innerJoin .= " LEFT JOIN d_cotacao_cli ON (d_cotacao_cli.id = d_cotacao.id_fornecedor) ";
    $this->orderBy = array("d_cotacao_cli.nome","tb.numero");
    if (!empty($arrayFiltro['cotacao_cli'])){
        $this->sql .= " AND d_cotacao_cli.nome = ? ";
        //$arrayFiltro['cotacao_cli'] = $this->limpacnpj($arrayFiltro['cotacao_cli']);
        $this->ArrayBind[] = $arrayFiltro['cotacao_cli'];
    }
  }
*/
  public function montaSqlPendencias($id_usuario,$id_grupo,$arrayGrupos,$id_doc){
  	$this->sql = " AND (id_knl_usuario = ? OR id_knl_grupo = ? ";
  	$this->ArrayBind = array($id_usuario,$id_grupo);
  	foreach ($arrayGrupos as $grupo){
  		$this->sql .= " OR id_knl_grupo = ?";
  		$this->ArrayBind[] = $grupo;
  	}
  	$this->sql .= ") AND id_doc = ? ";
  	$this->ArrayBind[] = $id_doc;
  }
  
  public function get_sql(){
  	return $this->sql;
  }
  
  public function get_ArrayBind(){
  	return $this->ArrayBind;
  }
  
  public function get_pagina(){
  	return $this->pagina;
  }
  
  public function get_innerJoin(){
  	return $this->innerJoin;
  }
  
  public function get_orderBy(){
  	$orderBy = " ORDER BY ".implode(",",$this->orderBy);
  	return $orderBy;
  }
  
  public function get_groupBy(){
  	return $this->groupBy;
  }
  
  public function get_arrayFiltro(){
  	return $this->arrayFiltroOut;
  }
}
?>