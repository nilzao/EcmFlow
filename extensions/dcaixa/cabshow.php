<?php
$caixa = $knl_helper->getVar('cabecalho');
$helperShowDiv = knl_view_hlp_ShowDiv::getInstance();


$htmldiv = "<div id=\"docH\">";
$helperShowDiv->set_html_Div($htmldiv);
$vars['d_caixa_title;Documento:'] = $caixa['docSubTipo']->get_descricao();
$vars['d_caixa_data_ini;Data Inicial:'] = $caixa['dcaixa']->get_data_ini();
$vars['d_caixa_data_fim;Data Final:'] = $caixa['dcaixa']->get_data_fim();
$helperShowDiv->monta_Div($vars);
$htmldiv = "</div>";
$helperShowDiv->set_html_Div($htmldiv);
$css = "<link rel=\"stylesheet\" href=\"extensions/dcaixa/cabshow.css\" type=\"text/css\">";
$helperShowDiv->set_css_Div($css);
//print_r($nfentrada);
?>