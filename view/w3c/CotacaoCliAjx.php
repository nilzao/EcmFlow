<?php
header("Content-type: text/xml; charset=UTF-8");
header("pragma: no-cache");
header("cache-control: no-cache");
print '<?xml version="1.0" encoding="UTF-8"?>';
$cotacao_cli = $knl_helper->getVar("cotacao_cli");
echo "<cotacao_cli>";
foreach($cotacao_cli as $v) {
    echo "
    <opcao>
    <nome id=\"razao\">{$v->get_nome()}</nome>
    <nome id=\"id_cli\">{$v->get_id()}</nome>
    </opcao>\n";
}
echo "</cotacao_cli>";
?>