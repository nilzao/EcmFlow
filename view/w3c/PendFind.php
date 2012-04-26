<?php 
$tipos = $knl_helper->getVar("tipos");
$subTipos = $knl_helper->getVar("subTipos");
$helperForm = knl_view_w3c_hlp_FormFind::getInstance();
?>
<html>
 <head>
  <title>Pendências - ECMFLOW = Ecm + Workflow + Ged</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
echo $helperForm->js_FormsSpec();
?>
<link rel="stylesheet" href="./view/w3c/css/menu.css" type="text/css">
<script type="text/javascript" src="./view/w3c/js/main_menu.js"></script>
<link href="./view/w3c/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./view/w3c/js/jquery.min.js"></script>
<script type="text/javascript" src="./view/w3c/js/jquery-ui.min.js"></script>
</head>
<body>
<?php include('menu.php'); ?>
<h1>Pendencias</h1>
  <form action="index.php">
  <input type="hidden" name="domain" value="Doc"/>
  <input type="hidden" name="action" value="PendenciaList"/>

  Documento: <input type="text" name="doc_num" /><br/>
  Data Emissão De: <input type="text" name="data_ini" /> 
  Até: <input type="text" name="data_fim" /><br/><br>
  Tipo: 
<?php
$helperForm->monta_DocTipoCombo($tipos);
echo $helperForm->html_DocTipoCombo();
?>
       <br>
  SubTipo:
<?php
$helperForm->monta_DocSubTipoCombo($subTipos);
echo $helperForm->html_DocSubTipoCombo();
?>
<br><br>
<div id="formpp"></div>
<br>
  <input type="submit" value="Pesquisar" />
  </form>
 </body>
</html>