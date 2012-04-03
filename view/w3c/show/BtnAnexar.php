Novo Anexo: <?php
$documento = $knl_helper->getVar("doc");
echo "<a href=\"index.php?domain=Doc&action=newAnexoFind&id={$documento->get_id()}\"><img src=\"./img/icones/anexo.png\" alt=\"Anexar\" title=\"Anexar\" border=\"0\"></a> ";
?><br>