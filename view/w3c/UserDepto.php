<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
<link rel="stylesheet" href="view/w3c/css/lista.css" type="text/css">
<link rel="stylesheet" href="./view/w3c/css/menu.css" type="text/css">
<script type="text/javascript" src="./view/w3c/js/main_menu.js"></script>
<link href="./view/w3c/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./view/w3c/js/jquery.min.js"></script>
<script type="text/javascript" src="./view/w3c/js/jquery-ui.min.js"></script>
</head>
<body>
<?php include('./view/w3c/menu.php'); ?>
<?php
$listadeptos = $knl_helper->getVar("deptos");
$usuario = $knl_helper->getVar("usuario");
?>
  <h1>Departamentos do Usuario</h1>
<?php
//print_r($listausuarios);
echo $usuario->get_Login()."<br><br>";
echo "<form method=\"post\" action=\"index.php?domain=Users&action=savedepto\">
<input type=\"hidden\" name=\"id_usu\" value=\"".$usuario->get_Id()."\">
<table border=\"1\">";
foreach($listadeptos as $v){
    echo "<tr><td>".
    $v->get_Descricao().
    "</td><td><input type=\"checkbox\" name=\"deptos[]\" value=\"".
    $v->get_Id().
    "\"></td></tr>\n";
}
echo "<tr><td colspan=\"2\"><input type=\"submit\" value=\"Salvar\"></td></tr>";
echo "</table></form>";
?>

</body>
</html>