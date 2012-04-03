<?php
 $documento = $knl_helper->getVar("doc");
 $cabecalho = $knl_helper->getVar("cabecalho");
 $empresas = $knl_helper->getVar("empresas");
 $helperFormEdit = knl_view_hlp_FormEdit::getInstance();

 $helperFormEdit->monta_CampoData($documento->get_data_doc(),"data_doc");
 $helperFormEdit->monta_ComboEmpresa($empresas,$documento->get_id_empresa());
 $helperFormEdit->monta_FormSpec($cabecalho);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Edição</title>
<?php

echo $helperFormEdit->js_Js();
echo $helperFormEdit->js_Add();

if($knl_helper->isSetVar("head")){
	echo $knl_helper->getVar("head");
}
?>
<link rel="stylesheet" href="view/css/formedit.css" type="text/css">
</head>
<body bgcolor="#FFFFFF">
<form action="index.php?domain=Doc&action=DocEdit" method="POST">
<table border="0" class="tb_form" cellspacing="0">
<?php
echo $helperFormEdit->html_FormSpec();
?>
<tr>
  <td align="right">Data Emissao: </td><td><?php echo $helperFormEdit->html_CampoData('data_doc'); ?></td>
  <td align="right">Numero: </td><td><input type="text" name="numero" onFocus="this.select();" value="<?php echo $documento->get_numero(); ?>"></td>
</tr>
<tr>
  <td align="right">Empresa: </td><td colspan="3">
  <?php
  echo $helperFormEdit->html_ComboEmpresa();
  ?>
  </td>
</tr>
</table>
<input type="hidden" name="id" value="<?php echo $documento->get_id(); ?>">
<input type="hidden" name="id_doc_tipo" value="<?php echo $documento->get_id_doc_tipo(); ?>">
<input type="hidden" name="id_doc_sub_tipo" value="<?php echo $documento->get_id_doc_sub_tipo(); ?>">
<input type="submit"value="Salvar">
</form>
</body>
</html>