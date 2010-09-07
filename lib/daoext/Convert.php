<?php
class knl_lib_daoext_Convert {
  private static $instance;
 
  private function construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }

  public function data_mysql_to_br($data,$divisao = "/") {
  	if (!empty($data)){
  		if ($data != "0000-00-00"){
  			$data = new DateTime($data);
  		    $data = $data->format("d{$divisao}m{$divisao}Y");
  		} else {
  			list($ano,$mes,$dia) = split('[/.-]',$data);
  		    $data= $dia.'/'.$mes.'/'.$ano;
  		}
   	}
  	return $data;
  }
  
  public function datatime_mysql_to_br($data) {
  	if (!empty($data)){
  		if ($data != "0000-00-00 00:00:00"){
  			$data = new DateTime($data);
  		    $data = $data->format("d/m/Y  H:i:s");
  		}
   	}
  	return $data;
  }
  
  public function data_br_to_mysql($data) {
  	if (!empty($data)){
 		list($dia,$mes,$ano) = split('[/.-]',$data);
  		$data= $ano.'-'.$mes.'-'.$dia;
   	}
  	return $data;
  }
  
  public function datatime_br_to_mysql($data) {
  	if (!empty($data)){
  		if ($data != "00-00-0000 00:00:00"){
  			$data = new DateTime($data);
  		    $data = $data->format("Y-m-d H:i:s");
  		    echo $data;die();
  		}
   	}
  	return $data;
  }
  
  public function pontuacnpj($cnpjpuro) {
	//-------CNPJ---------
	$showcnpj="";
	if (strlen($cnpjpuro) == 14){
		$teco=substr($cnpjpuro,0,2);
		$showcnpj = $teco.".";
		$teco=substr($cnpjpuro,2,3);
		$showcnpj .= $teco.".";
		$teco=substr($cnpjpuro,5,3);
		$showcnpj .= $teco."/";
		$teco=substr($cnpjpuro,8,4);
		$showcnpj .= $teco."-";
		$teco=substr($cnpjpuro,12,2);
		$showcnpj .= $teco;
	}
	//-------CPF---------
	if (strlen($cnpjpuro) == 11) { 
		$teco=substr($cnpjpuro,0,3);
		$showcnpj = $teco.".";
		$teco=substr($cnpjpuro,3,3);
		$showcnpj .= $teco.".";
		$teco=substr($cnpjpuro,6,3);
		$showcnpj .= $teco."-";
		$teco=substr($cnpjpuro,9,2);
		$showcnpj .= $teco;
	}
	return $showcnpj;
  }
  
  public function limpacnpj($cnpjsujo){
  	$cnpjlimpo = str_replace(".","",$cnpjsujo);
  	$cnpjlimpo = str_replace("/","",$cnpjlimpo);
  	$cnpjlimpo = str_replace("-","",$cnpjlimpo);
  	return $cnpjlimpo;
  }
}
?>