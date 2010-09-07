<html>
<head>
<?php
$helperLista = knl_view_hlp_Lista::getInstance();
$helperLista->monta_ListaJs();
echo $helperLista->js_ListaJs();
?>
<link rel="stylesheet" href="view/css/lista.css" type="text/css">
 </head>
 <body bgcolor="FFFFFF">
<?php
$helperPag = knl_view_hlp_Paginacao::getInstance();
$lista = $knl_helper->getVar("lista");
$paginacao = $knl_helper->getVar("paginacao");
$domainAction = $knl_helper->getVar("domainAction");
?>
  <h1>Notas fiscais de saida</h1>
<?php
$helperPag->monta_Paginacao($paginacao,$domainAction);
echo $helperPag->html_Paginacao();

$cab = array("Id","Razão Social","Saída","Emissão","Número");
$valores = array("get_id"=>"doc","get_razao"=>"dnfsaidaFull,forn","get_datasai"=>"dnfsaida","get_data_doc"=>"doc","get_numero"=>"doc");
//print_r($lista);
$helperLista->monta_Lista($lista,$cab,$valores);
echo $helperLista->html_Lista();
?>
</body>
</html>