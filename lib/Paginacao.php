<?php
/*
 * pagina atual, limite de paginas, total de registros, 
 * regitro de, registro até,
 * array com parametros usados na pesquisa fornecidos pelo usuario, com chave do $_REQUEST e valor. 
 */  
class knl_lib_Paginacao {
  private static $instance;
  private $pagatual;
  private $paglimit;
  private $totalpagatual;
  private $totalreg;
  private $maxpag;
  private $arrayFiltro = array();
  
  private function __construct($totalreg,$totalpagatual,$arrayFiltro,$paglimit){
  	$this->pagatual = $arrayFiltro['pag']+1;
  	$this->paglimit = $paglimit;
  	$this->totalpagatual = $totalpagatual;
  	$this->totalreg = $totalreg;
  	$this->maxpag = ceil($totalreg/$paglimit);
  	$this->arrayFiltro = $arrayFiltro;
  }
  
  public static function getInstance($totalreg,$totalpagatual,$arrayFiltro,$paglimit = 20){
  	if (!isset(self::$instance)){
  		self::$instance = new self($totalreg,$totalpagatual,$arrayFiltro,$paglimit);
  	}
  	return self::$instance;
  }
  
  public function get_pagatual(){
  	return $this->pagatual;
  }
  
  public function get_paglimit(){
  	return $this->paglimit;
  }
  
  public function get_totalreg(){
  	return $this->totalreg;
  }
  
public function get_totalpagatual(){
  	return $this->totalpagatual;
  }
  
  public function get_requestl(){
  	return $this->request;
  }
  
  public function get_arrayFiltro(){
  	return $this->arrayFiltro;
  }
  
  public function get_maxpag(){
  	return $this->maxpag;
  }
}
?>