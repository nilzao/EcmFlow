<?php
$documento = $knl_helper->getVar("doc");
echo "<a onclick='return confirmar(\"O documento será excluído!\\n Confirmar exclusão?\");' href=\"index.php?domain=Doc&action=DocDel&id={$documento->get_id()}\"><img src=\"./view/w3c/img/icones/botaox.jpg\" alt=\"Excluir\" title=\"Excluir\" border=\"0\"></a><img src=\"./view/w3c/img/docshow/entrebotoes.jpg\">";
?>