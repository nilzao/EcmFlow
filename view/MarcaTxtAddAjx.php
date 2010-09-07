<?php
header("Content-type: text/xml; charset=ISO-8859-1");
header("pragma: no-cache");
header("cache-control: no-cache");
print '<?xml version="1.0" encoding="ISO-8859-1"?>';
$marca_texto = $knl_helper->getVar("marcatexto");
echo "<marca_texto>";
echo $marca_texto->get_id();
echo "</marca_texto>";
?>