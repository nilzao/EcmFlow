<?php
$helperFormEdit = knl_view_hlp_FormEdit::getInstance();
$nfsaida = $knl_helper->getVar('cabecalho');
$fornecedor = $nfsaida['dnfsaidaFull']['forn'];
$knl_helper->setVar("head","<script type=\"text/javascript\" src=\"./extensions/cadastronf/cadcnpj.js\"></script>\n");
$helperFormEdit->monta_CampoData($nfsaida['dnfsaida']->get_datasai(),"datasai");
//print_r($nfsaida);
?>
<td>Data Sa�da: </td><td><?php echo $helperFormEdit->html_CampoData('datasai'); ?></td>
<?php
$vl = knl_view_Loader::getInstance();
    	$vl->setVar('fornecedor',$fornecedor);
    	$vl->setVar('cnpj',$fornecedor->get_cnpj());
echo $vl->display('cadastronf/cadeditcnpjform',false,true);
echo $vl->display("cadastronf/cadeditform",false,true);
?>
