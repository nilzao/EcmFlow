<?php
$dcotvenda = $knl_helper->getVar('cabecalho');
$helperShowDiv = knl_view_hlp_ShowDiv::getInstance();

$htmldiv = "<div id=\"docH\">";
$helperShowDiv->set_html_Div($htmldiv);
$vars['d_cot_venda_title;Documento:'] = $dcotvenda['docSubTipo']->get_descricao();
$vars['d_cot_vendaFull_d_cotacao_cli;Fornecedor:'] = $dcotvenda['dcotvendaFull']['d_cotacao_cli']->get_nome();
//$vars['d_cot_venda_data_ini;Data Inicial:'] = $dcotvenda['d_cot_venda']->get_data_ini();
//$vars['d_cot_venda_data_fim;Data Final:'] = $dcotvenda['d_cot_venda']->get_data_fim();

$helperShowDiv->monta_Div($vars);
$htmldiv = "</div>";
$helperShowDiv->set_html_Div($htmldiv);
$css = "<link rel=\"stylesheet\" href=\"extensions/dcotvenda/cabshow.css\" type=\"text/css\">";
$helperShowDiv->set_css_Div($css);
?>
