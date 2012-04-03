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
  <h1>Anexar documento</h1>
<?php
$helperPag = knl_view_w3c_hlp_Paginacao::getInstance();

$lista = $knl_helper->getVar("lista");
$paginacao = $knl_helper->getVar("paginacao");
$urlAdd = $knl_helper->getVar("urlAdd");

$id_doc = $knl_helper->getVar("id_doc");
$doc_anexo = $knl_helper->getVar("doc_anexo");

$helperPag->monta_Paginacao($paginacao,$urlAdd);
echo $helperPag->html_Paginacao();

$cab = array("Id","Tipo","Emissão","Número","Anexar");
$valores = array("get_id"=>"doc","get_descricao"=>"docTipo","get_data_doc"=>"doc","get_numero"=>"doc",";#AnexaBtn"=>"Anexa");
//print_r($lista);die();
$helperLista->monta_Lista($lista,$cab,$valores);
echo $helperLista->html_Lista();
?>
 </body>
</html>
