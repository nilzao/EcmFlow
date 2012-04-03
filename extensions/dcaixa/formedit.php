<?php
$helperFormEdit = knl_view_w3c_hlp_FormEdit::getInstance();
$caixa = $knl_helper->getVar('cabecalho');
//print_r($caixa);die();
$helperFormEdit->monta_CampoData($caixa['dcaixa']->get_data_ini(),"data_ini");
$helperFormEdit->monta_CampoData($caixa['dcaixa']->get_data_fim(),"data_fim");
//print_r($nfentrada);
?>
<td>Data Inicial: </td><td><?php echo $helperFormEdit->html_CampoData('data_ini'); ?></td>
<td>Data Final: </td><td><?php echo $helperFormEdit->html_CampoData('data_fim'); ?></td>
