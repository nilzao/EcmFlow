<?php
$documento = $knl_helper->getVar("doc");
$cabecalho = $knl_helper->getVar("cabecalho");
//print_r($documento);
//print_r($cabecalho);
?>
<form action="index.php?domain=Doc&action=MailSend" method="post">
<input type="hidden" name="doc_id" value="<?php echo $documento->get_id();?>">
<table>
<tr>
<td>Destinatário:</td>
<td><input type="text" name="destinatario" size="50"></td>
</tr>
<tr>
<td>Mensagem:</td>
<td><textarea name="corpo" cols="50" rows="5"></textarea></td>
</tr>
<tr>
<td colspan="2">
<input type="submit" value="Enviar">
</td>
</tr>
</table>
</form>