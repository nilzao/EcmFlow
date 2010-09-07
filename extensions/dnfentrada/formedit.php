<?php
$helperFormEdit = knl_view_hlp_FormEdit::getInstance();
$nfentrada = $knl_helper->getVar('cabecalho');
$fornecedor = $nfentrada['dnfentradaFull']['forn'];
$knl_helper->setVar("head","<script type=\"text/javascript\" src=\"./extensions/cadastronf/cadcnpj.js\"></script>\n");
$helperFormEdit->monta_CampoData($nfentrada['dnfentrada']->get_dataent(),"dataent");
//print_r($nfentrada);die();
$carimbos = $knl_helper->getVar('carimbos');
$docCarimbos = $knl_helper->getVar('docCarimbo');
$helperFormEdit->monta_Carimbo($carimbos,$docCarimbos);

?>
<td>Data Entrada: </td><td><?php echo $helperFormEdit->html_CampoData('dataent'); ?></td>
<?php
$vl = knl_view_Loader::getInstance();
    	$vl->setVar('fornecedor',$fornecedor);
    	$vl->setVar('cnpj',$fornecedor->get_cnpj());
echo $vl->display('cadastronf/cadeditcnpjform',false,true);
echo $vl->display("cadastronf/cadeditform",false,true);
?>
<td>Carimbo: </td><td colspan="3">
<?php echo $helperFormEdit->html_Carimbo();?>
</td>

