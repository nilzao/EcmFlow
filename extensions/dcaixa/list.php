<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
$helperLista = knl_view_w3c_hlp_Lista::getInstance();
$helperLista->monta_ListaJs();
echo $helperLista->js_ListaJs();
?>
<link rel="stylesheet" href="view/w3c/css/lista.css" type="text/css">
 </head>
 <body bgcolor="FFFFFF">
<?php
$helperPag = knl_view_w3c_hlp_Paginacao::getInstance();
$lista = $knl_helper->getVar("lista");
$paginacao = $knl_helper->getVar("paginacao");
$domainAction = $knl_helper->getVar("domainAction");
?>
  <h1>Caixas</h1>
<?php
$helperPag->monta_Paginacao($paginacao,$domainAction);
echo $helperPag->html_Paginacao();

$cab = array("Id","Origem","Inicio","Fim","Emissão","Número");
$valores = array("get_id"=>"doc","get_descricao"=>"docSubTipo","get_data_ini"=>"dcaixa","get_data_fim"=>"dcaixa","get_data_doc"=>"doc","get_numero"=>"doc");
//print_r($lista);die();
$helperLista->monta_Lista($lista,$cab,$valores);
echo $helperLista->html_Lista();
?>
</body>
</html>