<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
</head>
<body bgcolor="FFFFFF">
<?php
$listapendtipo = $knl_helper->getVar("pendtipo");
$listagrupos = $knl_helper->getVar("grupos");
$listadocsubtipo = $knl_helper->getVar("docsubtipo");
?>
  <h1>Regras de Credenciais</h1>
  <form action="index.php?domain=RegCred&action=add" method="post">
  <table><tr>
  <td><select name="addrem">
  <option value="A">Adicionar</option>
  <option value="R">Remover</option>
  </select></td>
  <td><select name="pendtipo">
<?php
foreach($listapendtipo as $v){
?>
	<option value="<?php echo $v->get_id(); ?>">
	<?php echo $v->get_descricao()?>
	</option>
<?php 
}
?>
</select>
</td>
<td><select name="docsubtipo">
<?php
foreach($listadocsubtipo as $v){
?>
	<option value="<?php echo $v->get_id(); ?>">
	<?php echo $v->get_descricao(); ?>
	</option>
<?php
}
?>
</select>
</td>
</tr>
<tr><td colspan="3">
<?php
foreach($listagrupos as $v){
?>
	<input type="checkbox" name="grupos[]" value="<?php echo $v->get_id(); ?>"/>
	<?php echo $v->get_nome(); ?><br/>
<?php
}
?>
<br/>
<input type="submit" value="salvar"/>
</td>
</tr>
</table>
</form>
</body>
</html>