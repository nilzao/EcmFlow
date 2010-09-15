<?php
$tipos = $knl_helper->getVar("tipos");
$subTipos = $knl_helper->getVar("subTipos");
$helperForm = knl_view_hlp_FormFind::getInstance();
?>
<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
//$helperForm->monta_FormsSpec($tipos);
echo $helperForm->js_FormsSpec();
?>
  <title>
   Pendencias
  </title>
<link rel="stylesheet" href="view/css/formfind.css" type="text/css">
</head>
 <body bgcolor="#FFFFFF">
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