<?php
$documento = $knl_helper->getVar("doc");
echo "<a onclick='return confirmar(\"O documento ser� exclu�do!\\n Confirmar exclus�o?\");' href=\"index.php?domain=Doc&action=DocDel&id={$documento->get_id()}\"><img src=\"./img/icones/botaox.jpg\" alt=\"Excluir\" title=\"Excluir\" border=\"0\"></a><img src=\"./img/docshow/entrebotoes.jpg\">";
?>