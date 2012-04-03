<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="view/css/lista.css" type="text/css">
</head>
 <body bgcolor="FFFFFF">
<?php
$lista = $knl_helper->getVar("lista");
$empresa_ativa = $knl_helper->getVar("empresa_ativa");
?>
  <h1>Empresas</h1>
<?php
echo "Empresa ativa: {$empresa_ativa->get_fantasia()}";
?>
<br>
<br>
<table border="1">
<tr><td>Empresas:</td><td>&nbsp;</td></tr>
<?php
foreach($lista as $empresa) {
	if($empresa->get_id() != $empresa_ativa->get_id()){
	echo "<tr><td>{$empresa->get_fantasia()}</td>\n";
	echo "<td><a href=\"index.php?domain=Empresa&action=set&id={$empresa->get_id()}\">Ativar</a></td></tr>";
	}
}

?>
</table>  
 </body>
</html>