<?php
$dordserv = $knl_helper->getVar('cabecalho');
$helperShowDiv = knl_view_w3c_hlp_ShowDiv::getInstance();
$htmldiv = "<div id=\"docH\">";
$helperShowDiv->set_html_Div($htmldiv);
$vars['d_ord_serv_title;Documento:'] = $dordserv['docSubTipo']->get_descricao();
$vars['d_ord_servFull_d_ord_serv_cli;Cliente:'] = $dordserv['dordservFull']['d_ord_serv_cli']->get_nome();
$vars['d_ord_serv_malha;Malha:'] = $dordserv['dordserv']->get_malha();
$vars['d_ord_serv_fio;Fio:'] = $dordserv['dordserv']->get_fio();
//$vars['d_cot_compra_data_ini;Data Inicial:'] = $dcotcompra['d_cot_compra']->get_data_ini();
//$vars['d_cot_compra_data_fim;Data Final:'] = $dcotcompra['d_cot_compra']->get_data_fim();
$helperShowDiv->monta_Div($vars);
$htmldiv = "</div>";
$helperShowDiv->set_html_Div($htmldiv);
$css = "<link rel=\"stylesheet\" href=\"extensions/dordserv/cabshow.css\" type=\"text/css\">";
$helperShowDiv->set_css_Div($css);
?>
