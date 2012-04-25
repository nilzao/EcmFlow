<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
</head>
<body bgcolor="FFFFFF">
<pre><?php include('menu.php'); ?></pre>
<?php
$listadoctipo = $knl_helper->getVar("doctipo");
$listagrupos = $knl_helper->getVar("grupos");
?>
  <h1>Doc Tipo Credenciais</h1>
  <form action="index.php?domain=DocTpCred&action=add" method="post">
  <table><tr>
  <td><select name="doctipo">
<?php
foreach($listadoctipo as $v){
?>
	<option value="<?php echo $v->get_id(); ?>">
	<?php echo $v->get_descricao()?>
	</option>
<?php 
}
?>
</select>
</td>

</tr>
<tr><td>
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