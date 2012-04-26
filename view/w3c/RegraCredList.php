<html>
 <head>
  <title>ECMFLOW = Ecm + Workflow + Ged</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="./view/w3c/css/menu.css" type="text/css">
<script type="text/javascript" src="./view/w3c/js/main_menu.js"></script>
<link href="./view/w3c/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./view/w3c/js/jquery.min.js"></script>
<script type="text/javascript" src="./view/w3c/js/jquery-ui.min.js"></script>
 </head>
 <body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php include('menu.php'); ?>
<p><a href="index.php?domain=RegCred&action=formadd">Adicionar</a></p>
<?php
$lista = $knl_helper->getVar("lista");
foreach($lista as $v){
	print_r($v);
}
?>
 </body>
</html>

