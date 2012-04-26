<?php
$id_doc = $knl_helper->getVar('id_doc');
$tipos = $knl_helper->getVar("tipos");
$subTipos = $knl_helper->getVar("subTipos");
$helperForm = knl_view_w3c_hlp_FormFind::getInstance();
/*
<a href="index.php?domain=Doc&action=newAnexoList&id=<Xphp echo $id_doc; X> ">AnexoList</a>
*/
?>
<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
$helperForm->monta_FormsSpec($tipos);
echo $helperForm->js_FormsSpec();
?>
  <title>
   Anexar Documento
  </title>
<link rel="stylesheet" href="view/w3c/css/formfind.css" type="text/css">
 </head>
 <body>
  <h1>Anexar Documento</h1>
  <form action="index.php">
  <input type="hidden" name="domain" value="Doc"/>
  <input type="hidden" name="action" value="newAnexoList"/>
  <input type="hidden" name="id" value="<?php echo $id_doc; ?>"/>

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


