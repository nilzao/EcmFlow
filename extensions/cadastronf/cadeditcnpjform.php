<?php
$cnpj = $knl_helper->getVar('cnpj');
?>
<td valign="top" align="right">Cnpj:</td><td valign="top"><input type="text" name="cnpj" id="cnpj" onKeyPress="return(so_numero(event));" onFocus="this.select();" onKeyUp="mask_cnpj('cnpj', event);" OnBlur="ajaxFormFull('index.php?extdm=cadastronf&action=FornFind&cnpj=',this.value);"  value="<?php echo $cnpj; ?>" maxlength="18">
</td>

