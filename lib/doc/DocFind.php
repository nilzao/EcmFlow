<?php

class knl_lib_doc_DocFind {
  private static $instance;
  
  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }
  
  public function montaTipos(){
  	$DocFind = knl_lib_perm_DocTipo::getInstance();
  	$tipos = $DocFind->montaTipos();
  	return $tipos;
  }
  
  public function montaSubTipos(){
  	$DocFind = knl_lib_perm_DocSubTipo::getInstance();
  	$subTipos = $DocFind->montaSubTipos();
  	return $subTipos;
  }
}
?>
