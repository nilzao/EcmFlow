<?php
$nfsaida = $knl_helper->getVar('cabecalho');
$helperShowDiv = knl_view_hlp_ShowDiv::getInstance();

$htmldiv = "<div id=\"docH\">";
$helperShowDiv->set_html_Div($htmldiv);
$vars['d_nf_saida_title;Documento:'] = "Nota fiscal de saída";
$vars['d_nf_saida;Data de saída:'] = $nfsaida['dnfsaida']->get_datasai();
$vars['d_nf_saidaFull_forn_cnpj;Cnpj:'] = $nfsaida['dnfsaidaFull']['forn']->get_cnpj();
$vars['d_nf_saidaFull_forn_razao;Razão social:'] = $nfsaida['dnfsaidaFull']['forn']->get_razao();
$vars['d_nf_saidaFull_forn_ie;Inscrição estadual:'] = $nfsaida['dnfsaidaFull']['forn']->get_ie();
$vars['d_nf_saidaFull_forn_estado;Estado:'] = $nfsaida['dnfsaidaFull']['forn']->get_estado();
$helperShowDiv->monta_Div($vars);
$htmldiv = "</div>";
$helperShowDiv->set_html_Div($htmldiv);
$css = "<link rel=\"stylesheet\" href=\"extensions/dnfsaida/cabshow.css\" type=\"text/css\">";
$helperShowDiv->set_css_Div($css);
//print_r($nfsaida);
?>