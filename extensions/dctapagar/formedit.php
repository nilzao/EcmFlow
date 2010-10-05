<?php
$helperFormEdit = knl_view_hlp_FormEdit::getInstance();
$ctapagar = $knl_helper->getVar('cabecalho');
$fornecedor = $ctapagar['dctapagarFull']['forn'];
$knl_helper->setVar("head","<script type=\"text/javascript\" src=\"./extensions/cadastronf/cadcnpj.js\"></script>\n");
$helperFormEdit->monta_CampoData($ctapagar['dctapagar']->get_data_vencimento(),"data_vencimento");
//print_r($ctapagar);die();
$carimbos = $knl_helper->getVar('carimbos');
$docCarimbos = $knl_helper->getVar('docCarimbo');
$helperFormEdit->monta_Carimbo($carimbos,$docCarimbos);

?>
<td>Data Vencimento: </td><td><?php echo $helperFormEdit->html_CampoData('data_vencimento'); ?></td>
<?php
$vl = knl_view_Loader::getInstance();
    	$vl->setVar('fornecedor',$fornecedor);
    	$vl->setVar('cnpj',$fornecedor->get_cnpj());
echo $vl->display('cadastronf/cadeditcnpjform',false,true);
echo $vl->display("cadastronf/cadeditform",false,true);
?>
