<?php
$id = $knl_helper->getVar("id");
$doc_id = $knl_helper->getVar("doc_id");
$doc_anexo = $knl_helper->getVar("doc_anexo");
echo "<a href=\"index.php?domain=Doc&action=AnexoAdd&doc_id=$id&idanexo={$doc_id}&doc_anexo={$doc_anexo}\"><img src=\"./img/icones/anexo.png\" alt=\"Anexar\" title=\"Anexar\" border=\"0\"></a> ";
?><br>