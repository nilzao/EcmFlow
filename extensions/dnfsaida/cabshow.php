<?php
$nfsaida = $knl_helper->getVar('cabecalho');
$helperShowDiv = knl_view_hlp_ShowDiv::getInstance();

$htmldiv = "<div id=\"docH\">";
$helperShowDiv->set_html_Div($htmldiv);
$vars['d_nf_saida_title;Documento:'] = "Nota fiscal de sa�da";
$vars['d_nf_saida;Data de sa�da:'] = $nfsaida['dnfsaida']->get_datasai();
$vars['d_nf_saidaFull_forn_cnpj;Cnpj:'] = $nfsaida['dnfsaidaFull']['forn']->get_cnpj();
$vars['d_nf_saidaFull_forn_razao;Raz�o social:'] = $nfsaida['dnfsaidaFull']['forn']->get_razao();
$vars['d_nf_saidaFull_forn_ie;Inscri��o estadual:'] = $nfsaida['dnfsaidaFull']['forn']->get_ie();
$vars['d_nf_saidaFull_forn_estado;Estado:'] = $nfsaida['dnfsaidaFull']['forn']->get_estado();
$helperShowDiv->monta_Div($vars);
$htmldiv = "</div>";
$helperShowDiv->set_html_Div($htmldiv);
$css = "<link rel=\"stylesheet\" href=\"extensions/dnfsaida/cabshow.css\" type=\"text/css\">";
$helperShowDiv->set_css_Div($css);
//print_r($nfsaida);
?>