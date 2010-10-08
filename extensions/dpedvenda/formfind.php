<div id="dpedvenda">
Pedido de venda:<br>
<?php
$head = "";
if($knl_helper->isSetVar("head")){
	$head = $knl_helper->getVar("head");	
}
$knl_helper->setVar("head",$head.'<script type="text/javascript" src="./extensions/cadastronf/cadastronf.js"></script>');
?>
Cnpj/Cpf: <input type="text" name="cnpj" id="cnpj"><a href="#" onclick="popAchaForn();">Achar CNPJ por Razão</a><br>
<br>
Data de entrega De: <input type="text" name="data1"> Até <input type="text" name="data2">
</div>