<?php

class knl_extensions_cadastronf_CadParent {
  public function getFullData($mDocH){
  	//var_dump($params);
  	$id_forn =  $mDocH->get_id_fornecedor();
  	//var_dump($params);
  	//echo $id_forn;
  	$NfForn = knl_extensions_cadastronf_caddao::getInstance();
  	$mNfForn['forn'] = $NfForn->selectById($id_forn);
  	return $mNfForn;
  }

}
?>
