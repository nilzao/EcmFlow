<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
$helperLista = knl_view_w3c_hlp_Lista::getInstance();
$helperLista->monta_ListaJs();
echo $helperLista->js_ListaJs();
?>
<link rel="stylesheet" href="view/w3c/css/lista.css" type="text/css">
<link rel="stylesheet" href="./view/w3c/css/menu.css" type="text/css">
<script type="text/javascript" src="./view/w3c/js/main_menu.js"></script>
<link href="./view/w3c/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./view/w3c/js/jquery.min.js"></script>
<script type="text/javascript" src="./view/w3c/js/jquery-ui.min.js"></script>
 </head>
 <body>
<?php include('./view/w3c/menu.php');?>
<?php
$helperPag = knl_view_w3c_hlp_Paginacao::getInstance();
$lista = $knl_helper->getVar("lista");
$paginacao = $knl_helper->getVar("paginacao");
$domainAction = $knl_helper->getVar("domainAction");
?>
  <h1>Notas fiscais de serviços tomados</h1>
<?php
$helperPag->monta_Paginacao($paginacao,$domainAction);
echo $helperPag->html_Paginacao();

$cab = array("Id","Razão Social","Entrada","Emissão","Número");
$valores = array("get_id"=>"doc","get_razao"=>"dnfservtomaFull,forn","get_dataent"=>"dnfservtoma","get_data_doc"=>"doc","get_numero"=>"doc");
$helperLista->monta_Lista($lista,$cab,$valores);
echo $helperLista->html_Lista();
?>
 </body>
</html>