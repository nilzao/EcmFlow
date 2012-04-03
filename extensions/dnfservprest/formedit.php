<?php
$helperFormEdit = knl_view_w3c_hlp_FormEdit::getInstance();
$nfservprest= $knl_helper->getVar('cabecalho');
$fornecedor = $nfservprest['dnfservprestFull']['forn'];
$knl_helper->setVar("head","<script type=\"text/javascript\" src=\"./extensions/cadastronf/cadcnpj.js\"></script>\n");
$helperFormEdit->monta_CampoData($nfservprest['dnfservprest']->get_datasai(),"datasai");
//print_r($nfservprest);
?>
<td>Data Entrada: </td><td><?php echo $helperFormEdit->html_CampoData('datasai'); ?></td>
<?php
$vl = knl_view_Loader::getInstance();
    	$vl->setVar('fornecedor',$fornecedor);
    	$vl->setVar('cnpj',$fornecedor->get_cnpj());
echo $vl->display('cadastronf/cadeditcnpjform',false,true);
echo $vl->display("cadastronf/cadeditform",false,true);
?>