<?php
$caixa = $knl_helper->getVar('cabecalho');
//print_r($caixa);die();
$helperShowDiv = knl_view_hlp_ShowDiv::getInstance();

$htmldiv = "<div id=\"docH\">";
$helperShowDiv->set_html_Div($htmldiv);
$vars['d_extrato_title;Documento:'] = $caixa['docSubTipo']->get_descricao();
$vars['d_extrato_data_ini;Data Inicial:'] = $caixa['dextrato']->get_data_ini();
$vars['d_extrato_data_fim;Data Final:'] = $caixa['dextrato']->get_data_fim();
$vars['d_extrato_conta;Conta:'] = $caixa['dextratoFull']['d_extrato_conta']->get_numero();
$vars['d_extrato_agencia;Agência:'] = $caixa['dextratoFull']['d_extrato_agencia']->get_numero();
$vars['d_extrato_banco;Banco:'] = $caixa['dextratoFull']['d_extrato_banco']->get_nome();
$helperShowDiv->monta_Div($vars);
$htmldiv = "</div>";
$helperShowDiv->set_html_Div($htmldiv);
$css = "<link rel=\"stylesheet\" href=\"extensions/dextrato/cabshow.css\" type=\"text/css\">";
$helperShowDiv->set_css_Div($css);
//print_r($nfentrada);
?>
