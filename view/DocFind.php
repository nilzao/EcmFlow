<?php
$tipos = $knl_helper->getVar("tipos");
$subTipos = $knl_helper->getVar("subTipos");
$helperForm = knl_view_hlp_FormFind::getInstance();

$helperForm->monta_DocTipoCombo($tipos);
$helperForm->monta_DocSubTipoCombo($subTipos);
$helperForm->monta_DocTipoDiv($tipos);

?>
<html>
 <head>
<?php
$helperForm->monta_FormsSpec($tipos);
echo $helperForm->js_FormsSpec();

if($knl_helper->isSetVar("head")){
	echo $knl_helper->getVar("head");
}
?>

  <title>
   Documento
  </title>
<link rel="stylesheet" href="view/css/formfind.css" type="text/css">
<script type="text/javascript" src="./view/js/jquery.min.js"></script>
</head>
 <body bgcolor="#FFFFFF">
  <h1>Documento</h1>
  <form action="index.php">
  <input type="hidden" name="domain" value="Doc"/>
  <input type="hidden" name="action" value="DocList"/>

  Documento: <input type="text" name="doc_num" /><br/>
  Data Emissão De: <input type="text" name="data_ini" /> 
  Até: <input type="text" name="data_fim" /><br/><br>
  Tipo: 
<?php
echo $helperForm->html_DocTipoCombo();
?>
       <br>
  SubTipo:
<?php
echo $helperForm->html_DocSubTipoCombo();
?>
<br><br>
<div id="formpp"></div>
<br>
  <input type="submit" value="Pesquisar" />
  </form>
<div id="formhid" style="display:none;">
<?php
echo $helperForm->html_DocTipoDiv();
?>
</div>
 </body>
</html>