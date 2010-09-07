<?php
$dcotcompra = $knl_helper->getVar('cabecalho');
$helperShowDiv = knl_view_hlp_ShowDiv::getInstance();

$htmldiv = "<div id=\"docH\">";
$helperShowDiv->set_html_Div($htmldiv);
$vars['d_cot_compra_title;Documento:'] = $dcotcompra['docSubTipo']->get_descricao();
$vars['d_cot_compraFull_d_cotacao_cli;Fornecedor:'] = $dcotcompra['dcotcompraFull']['d_cotacao_forn']->get_nome();
//$vars['d_cot_compra_data_ini;Data Inicial:'] = $dcotcompra['d_cot_compra']->get_data_ini();
//$vars['d_cot_compra_data_fim;Data Final:'] = $dcotcompra['d_cot_compra']->get_data_fim();
$helperShowDiv->monta_Div($vars);
$htmldiv = "</div>";
$helperShowDiv->set_html_Div($htmldiv);
$css = "<link rel=\"stylesheet\" href=\"extensions/dcotcompra/cabshow.css\" type=\"text/css\">";
$helperShowDiv->set_css_Div($css);
?>
