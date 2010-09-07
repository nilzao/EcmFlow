<html>
<head>
 </head>
 <body bgcolor="FFFFFF">
  <h1>Carimbos</h1>
<?php
$lista = $knl_helper->getVar("lista");
foreach ($lista as $v){
	echo "{$v['carimbo']->get_descricao()}<br>\n";
}
?>
 </body>
</html>