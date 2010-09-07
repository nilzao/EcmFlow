<?php
$id_doc = $knl_helper->getVar('id_doc');
?>
<form action="index.php?domain=Doc&action=ObsAdd&id=<?php echo $id_doc; ?>" method="post">
<textarea name="obs" rows="6" cols="70"></textarea><br>
<input type="submit" value="Adicionar">
</form>
