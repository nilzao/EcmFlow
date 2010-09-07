<?php
class knl_lib_doc_MontaDocList {
  private static $instance;

  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance; 
  }
  
  public function montaLista($lista){
  	$DocShow = knl_lib_doc_DocShow::getInstance();
  	$tudo = array();
    foreach($lista as $k=>$mDoc){
      if(is_int($k)){
      	$DocFull = $DocShow->getDocumentoFull($mDoc);
  	    $tudo[] = array_merge(array('doc'=>$mDoc),$DocFull);
      }
    }
    $tudo['detalhes'] = $lista['detalhes'] ;
    return $tudo;
  }
}
?>