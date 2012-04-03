<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
<link rel="stylesheet" href="view/w3c/css/lista.css" type="text/css">
</head>
<body bgcolor="FFFFFF">
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