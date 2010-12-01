<?php
$head = array('cotacao'=>'<script type="text/javascript" src="./extensions/cadastronf/cot.js"></script>');
if($knl_helper->isSetVar("head")){
	$head = array_merge($head,$knl_helper->getVar("head")); 
}
$knl_helper->setVar("head",$head);
?>
<div id="dordserv" style="display:block">
Cotação de Compra:<br>
<br>
<div>Cliente:<input type="text" id="cotacao_cli" name="cotacao_cli" autocomplete="off"
        onKeyUp="ajaxCotacaoCli(this.value);">
        <div style="border-style:solid;border-width:1px;
             position:fixed;background-color:white;display:none;"
             id="div_find_cotacao_cli"></div></div>
Malha: <input type="text" name="malha"><br/>
Fio: <input type="text" name="fio">
</div>
