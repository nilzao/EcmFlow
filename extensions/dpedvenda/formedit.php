<?php
$helperFormEdit = knl_view_hlp_FormEdit::getInstance();
$pedvenda = $knl_helper->getVar('cabecalho');
$fornecedor = $pedvenda['dpedvendaFull']['forn'];
$knl_helper->setVar("head","<script type=\"text/javascript\" src=\"./extensions/cadastronf/cadcnpj.js\"></script>\n");
$helperFormEdit->monta_Add('dpedvenda/formAddDataEntrega','Add',$pedvenda['dpedvendaFull']['dataentrega']);
?>
<td valign="top" align="right">Data entrega:<br><?php echo $helperFormEdit->html_btn_Add('Add'); ?></td><td valign="top"><?php echo $helperFormEdit->html_Add('Add'); ?></td>
<?php 
$vl = knl_view_Loader::getInstance();
    	$vl->setVar('fornecedor',$fornecedor);
    	$vl->setVar('cnpj',$fornecedor->get_cnpj());
echo $vl->display('cadastronf/cadeditcnpjform',false,true);
echo $vl->display("cadastronf/cadeditform",false,true);
?>
