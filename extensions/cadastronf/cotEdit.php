<?php
class knl_extensions_cadastronf_cotEdit {
  private static $instance;

  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance; 
  }
  
  public function gravaNoBanco(){
  	$request = knl_lib_Registry::getRequestObj();

  	$CotacaoCli = knl_extensions_cadastronf_cotDao::getInstance();
  	$mCotacaoCli = $CotacaoCli->selectByNome($request->getpost('razao'));
  	if (count($mCotacaoCli) == 0){
  	    $mCotacaoCli[0] = new knl_extensions_cadastronf_cotModel(0, $request->getpost('razao'));
  	    $CotacaoCli->upsert($mCotacaoCli[0]);
  	}
  	return $mCotacaoCli[0];
  }
  
}
?>