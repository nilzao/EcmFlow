<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php

$helperLista = knl_view_hlp_Lista::getInstance();
//$helperLista->monta_ListaJs();
//echo $helperLista->js_ListaJs();

?>
<script>
function setCnpj(cnpj){
	window.opener.document.getElementById('cnpj').value = cnpj;
	window.opener.document.getElementById('cnpj').focus();
	window.close();
}
</script>
</head>
<body bgcolor="FFFFFF" onload="document.getElementById('razao').focus();">
<?php

$helperPag = knl_view_hlp_Paginacao::getInstance();

$lista = $knl_helper->getVar("lista");
$paginacao = $knl_helper->getVar("paginacao");
$urlAdd = $knl_helper->getVar("urlAdd");
?>
  <h1>Fornecedores</h1>
  <br>
<form action="index.php">
<input type="hidden" name="extdm" value="cadastronf">
<input type="hidden" name="action" value="FornList">
<input type="text" name="razao" id="razao">
<input type="submit" value="Pesquisa">
</form>
<?php
$helperPag->monta_Paginacao($paginacao,$urlAdd);
echo $helperPag->html_Paginacao();

$cab = array("Cnpj","Razão Social");
$valores = array("get_cnpj"=>"d_cad_nf","get_razao"=>"d_cad_nf");
//print_r($lista);die();
$onclick = array("***"=>"setCnpj('***')","get_cnpj"=>"d_cad_nf");
$helperLista->monta_Lista($lista,$cab,$valores,$onclick);
echo $helperLista->html_Lista();
?>
</body>
</html>