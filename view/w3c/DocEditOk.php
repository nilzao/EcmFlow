<?php
// retirar os caracteres # da string 
// parent.document.URL
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>
</title>
<script>
<?php
$id = $knl_helper->getVar('id');
echo "parent.document.location = \"index.php?domain=Doc&action=DocShow&id=$id\"";
?>
</script>
</head>
<body>
</body>
</html>