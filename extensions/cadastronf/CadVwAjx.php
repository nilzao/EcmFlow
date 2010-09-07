<?php
header("Content-type: text/xml; charset=ISO-8859-1");
header("pragma: no-cache");
header("cache-control: no-cache");
print '<?xml version="1.0" encoding="ISO-8859-1"?>';
$fornecedor = $knl_helper->getVar("fornecedor");

echo "<opcao>
<nome id=\"razao\">{$fornecedor->get_razao()}</nome>
<nome id=\"estado\">{$fornecedor->get_estado()}</nome>
<nome id=\"ie\">{$fornecedor->get_ie()}</nome>
</opcao>";
?>