<?php
$id = $knl_helper->getVar("id");
$anexoTop = $knl_helper->getVar("anexoTop");
echo "<a href=\"index.php?domain=Doc&action=AnexoDel&id={$id}&doc_id={$anexoTop['doc_id']}&doc_anexo={$anexoTop['doc_anexo']}\"><img src=\"./view/w3c/img/icones/exclui.png\" alt=\"Desanexar\" title=\"Desanexar\" border=\"0\"></a>";
?>