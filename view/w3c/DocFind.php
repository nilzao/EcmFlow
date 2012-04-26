<?php
$tipos = $knl_helper->getVar("tipos");
$subTipos = $knl_helper->getVar("subTipos");
$helperForm = knl_view_w3c_hlp_FormFind::getInstance();

$helperForm->monta_DocTipoCombo($tipos);
$helperForm->monta_DocSubTipoCombo($subTipos);
$helperForm->monta_DocTipoDiv($tipos);

?>
<html>
 <head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
$helperForm->monta_FormsSpec($tipos);
echo $helperForm->js_FormsSpec();

if($knl_helper->isSetVar("head")){
	$head = $knl_helper->getVar("head");
	foreach($head as $v){
		echo $v."\n";
	}
}
?>
<link rel="stylesheet" href="./view/w3c/css/menu.css" type="text/css">
<script type="text/javascript" src="./view/w3c/js/main_menu.js"></script>
<link href="./view/w3c/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./view/w3c/js/jquery.min.js"></script>
<script type="text/javascript" src="./view/w3c/js/jquery-ui.min.js"></script>
  <title>
   Documento
  </title>
<link rel="stylesheet" href="view/w3c/css/formfind.css" type="text/css">
<script type="text/javascript" src="./view/w3c/js/jquery.min.js"></script>
</head>
 <body>
<?php include('./view/w3c/menu.php'); ?>
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