<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Departamentos</title>
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
//$lista = $knl_helper->getVar("deptos");
?>
  <h1>Departamentos</h1>
<form method="post" action="index.php?domain=Deptos&action=add">
<input type="text" name="nome"/>
<input type="submit" />
</form>
</body>
</html>