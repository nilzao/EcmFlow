<div id="dnfservtoma" style="display:block">
Nota fiscal de serviço tomado:<br>
<?php
$head = array('cadastronf'=>'<script type="text/javascript" src="./extensions/cadastronf/cadastronf.js"></script>');
if($knl_helper->isSetVar("head")){
	$head = array_merge($head,$knl_helper->getVar("head")); 
}
$knl_helper->setVar("head",$head);
?>
Cnpj/Cpf: <input type="text" name="cnpj" id="cnpj"><a href="#" onclick="popAchaForn();">Achar CNPJ por Razão</a><br>
<br>
Data de entrada De: <input type="text" name="data1"> Até <input type="text" name="data2">
</div>
