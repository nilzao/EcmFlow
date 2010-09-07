<?php
// retirar os caracteres # da string 
// parent.document.URL
?>
<html>
<head>
<title>
</title>
<script>
//alert("Documento Alterado!");
<?php
$id = $knl_helper->getVar('id');
//echo "alert(\"index.php?domain=Doc&action=DocShow&id=$id\");";
echo "parent.document.location = \"index.php?domain=Doc&action=DocShow&id=$id\"";
//parent.document.location = parent.document.URL.replace(/#/, "");
?>
</script>
</head>
<body>
</body>
</html>