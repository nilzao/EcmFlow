<?php
$dsolcompra = $knl_helper->getVar('cabecalho');
$helperShowDiv = knl_view_w3c_hlp_ShowDiv::getInstance();

$htmldiv = "<div id=\"docH\">";
$helperShowDiv->set_html_Div($htmldiv);
$vars['d_sol_compra_title;Documento:'] = $dsolcompra['docSubTipo']->get_descricao();
//$vars['d_sol_compra_data_ini;Data Inicial:'] = $dsolcompra['d_sol_compra']->get_data_ini();
//$vars['d_sol_compra_data_fim;Data Final:'] = $dsolcompra['d_sol_compra']->get_data_fim();
$helperShowDiv->monta_Div($vars);
$htmldiv = "</div>";
$helperShowDiv->set_html_Div($htmldiv);
$css = "<link rel=\"stylesheet\" href=\"extensions/dsolcompra/cabshow.css\" type=\"text/css\">";
$helperShowDiv->set_css_Div($css);
?>
