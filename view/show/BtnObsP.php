<?php
$documento = $knl_helper->getVar("doc");
$pag = $knl_helper->getVar("pag");
?>
<a href="#"><img alt="Observações" title="Observações" src="./img/icones/botobservacaop.jpg" border="0" onclick="iframeSet('index.php?domain=Doc&action=ObsList&id=<?php echo $documento->get_id(); ?>&pag=<?php echo $pag; ?>')"></a><img src="./img/docshow/entrebotoes.jpg">