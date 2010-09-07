<?php
$fornecedor = $knl_helper->getVar('fornecedor');
?>
<tr><td align="right">Razão Social: </td><td colspan="3"><input type="text" name="razao" id="razao" size="50" maxlength="100" value="<?php echo $fornecedor->get_razao();?>" onFocus="this.select();"></td>
</tr>
<tr>
<td align="right">Estado: </td><td><input type="text" maxlength="2" size="2" name="estado" id="estado" value="<?php echo $fornecedor->get_estado(); ?>" onFocus="this.select();"></td>
<td align="right">Insc Estad: </td><td><input type="text" name="ie" id="ie" value="<?php echo $fornecedor->get_ie(); ?>" onFocus="this.select();"></td></tr>

