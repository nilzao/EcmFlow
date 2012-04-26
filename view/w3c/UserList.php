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
$listausuarios = $knl_helper->getVar("users");
?>
  <h1>Usuários</h1>
<?php
//print_r($listausuarios);
foreach($listausuarios as $v){
    echo "<a href=\"index.php?domain=Users&action=lstdepto&id_usu=".
    $v->get_Id().
    "\">".$v->get_Login()."</a><br>";
}
?>
</body>
</html>