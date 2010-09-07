<?php
$helperFormEdit = knl_extensions_dextrato_formHlp::getInstance();
$extrato = $knl_helper->getVar('cabecalho');
//print_r($extrato);die();
$helperFormEdit->monta_ComboExtratoConta($extrato['dextrato']->get_id_conta());
$helperFormEdit->monta_CampoData($extrato['dextrato']->get_data_ini(),"data_ini");
$helperFormEdit->monta_CampoData($extrato['dextrato']->get_data_fim(),"data_fim");
//print_r($nfentrada);
?>
<td>Data Inicial: </td><td><?php echo $helperFormEdit->html_CampoData('data_ini'); ?></td>
<td>Data Final: </td><td><?php echo $helperFormEdit->html_CampoData('data_fim'); ?></td>
<tr>
<td>Conta: </td><td colspan="3"><?php echo $helperFormEdit->html_ComboExtratoConta('id_conta'); ?>