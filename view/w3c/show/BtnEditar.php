<?php
$documento = $knl_helper->getVar("doc");
echo "<a href=\"#\" onclick=\"iframeSet('index.php?domain=Doc&action=DocEditForm&id={$documento->get_id()}');\"><img src=\"./view/w3c/img/icones/botedit.jpg\" alt=\"Editar\" title=\"Editar\" border=\"0\"></a>";
?>