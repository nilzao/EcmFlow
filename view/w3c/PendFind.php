<?php 
$tipos = $knl_helper->getVar("tipos");
$subTipos = $knl_helper->getVar("subTipos");
$helperForm = knl_view_hlp_FormFind::getInstance();
?>
<html>
 <head>
  <title>Pendências - ECMFLOW = Ecm + Workflow + Ged</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <?php
echo $helperForm->js_FormsSpec();
?>
 </head>
 <body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
No Frames!
 <pre><?php include('menu.php'); ?></pre>
 

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