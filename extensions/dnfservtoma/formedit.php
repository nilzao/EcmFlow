<?php
$helperFormEdit = knl_view_hlp_FormEdit::getInstance();
$nfservtoma = $knl_helper->getVar('cabecalho');
$fornecedor = $nfservtoma['dnfservtomaFull']['forn'];
$knl_helper->setVar("head","<script type=\"text/javascript\" src=\"./extensions/cadastronf/cadcnpj.js\"></script>\n");
$helperFormEdit->monta_CampoData($nfservtoma['dnfservtoma']->get_dataent(),"dataent");
//print_r($nfservtoma);
?>
<td>Data Entrada: </td><td><?php echo $helperFormEdit->html_CampoData('dataent'); ?></td>
<?php
$vl = knl_view_Loader::getInstance();
    	$vl->setVar('fornecedor',$fornecedor);
    	$vl->setVar('cnpj',$fornecedor->get_cnpj());
echo $vl->display('cadastronf/cadeditcnpjform',false,true);
echo $vl->display("cadastronf/cadeditform",false,true);
?>
