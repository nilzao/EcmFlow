<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 </head>
 <body>
  <h1>Carimbos</h1>
<?php
$lista = $knl_helper->getVar("lista");
foreach ($lista as $v){
	echo "{$v['carimbo']->get_descricao()}<br>\n";
}
?>
 </body>
</html>