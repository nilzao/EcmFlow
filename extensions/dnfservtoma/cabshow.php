<?php
$nfservt = $knl_helper->getVar('cabecalho');
$helperShowDiv = knl_view_hlp_ShowDiv::getInstance();

$htmldiv = "<div id=\"docH\">";
$helperShowDiv->set_html_Div($htmldiv);
$vars['d_nf_servtoma_title;Documento:'] = "NF de Serv. Tomados";
$vars['d_nf_servtoma;Data de entrada:'] = $nfservt['dnfservtoma']->get_dataent();
$vars['d_nf_servtomaFull_forn_cnpj;Cnpj:'] = $nfservt['dnfservtomaFull']['forn']->get_cnpj();
$vars['d_nf_servtomaFull_forn_razao;Razão social:'] = $nfservt['dnfservtomaFull']['forn']->get_razao();
$vars['d_nf_servtomaFull_forn_ie;Inscrição estadual:'] = $nfservt['dnfservtomaFull']['forn']->get_ie();
$vars['d_nf_servtomaFull_forn_estado;Estado:'] = $nfservt['dnfservtomaFull']['forn']->get_estado();
$helperShowDiv->monta_Div($vars);
$htmldiv = "</div>";
$helperShowDiv->set_html_Div($htmldiv);
$css = "<link rel=\"stylesheet\" href=\"extensions/dnfservtoma/cabshow.css\" type=\"text/css\">";
$helperShowDiv->set_css_Div($css);
?>