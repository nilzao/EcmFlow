<?php
$cotacao_cli = $knl_helper->getVar('cotacao_cli');
?>
<tr><td align="right">Razão Social: </td><td colspan="3">
        <input type="text" name="razao" id="cotacao_cli" size="90" maxlength="100"
               value="<?php echo $cotacao_cli->get_nome();?>"
               onFocus="this.select();" <?php
               //só pra suprimir erro w3c do eclipse
               echo  "autocomplete=\"off\" ";
               ?>onkeyup="ajaxCotacaoCli(this.value);">
        <div style="border-style:solid;border-width:1px;
             position:fixed;background-color:white;display:none;"
             id="div_find_cotacao_cli"></div>
    </td>
</tr>