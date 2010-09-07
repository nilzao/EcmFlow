<?php
class knl_extensions_cadastronf_cadedit {
  private static $instance;

  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance; 
  }
  
  public function gravaNoBanco(){
  	$request = knl_lib_Registry::getRequest();
  	
  	$Forn = knl_extensions_cadastronf_caddao::getInstance();
  	$mForn = $Forn->selectByCnpj($request->getpost('cnpj'));
  	if ($mForn->get_id() == 0){
  	    $mForn->set_razao($request->getpost('razao'));
  	    $mForn->set_estado($request->getpost('estado'));
  	    $mForn->set_ie($request->getpost('ie'));
  	    
  	    $Forn->upsert($mForn);
  	}
  	return $mForn;
  }
  
}
?>