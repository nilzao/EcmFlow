<?php
$nfservp = $knl_helper->getVar('cabecalho');
$helperShowDiv = knl_view_hlp_ShowDiv::getInstance();

$htmldiv = "<div id=\"docH\">";
$helperShowDiv->set_html_Div($htmldiv);
$vars['d_nf_servprest_title;Documento:'] = "NF de Serv. Prestados";
$vars['d_nf_servprest;Data da saída:'] = $nfservp['dnfservprest']->get_datasai();
$vars['d_nf_servprestFull_forn_cnpj;Cnpj:'] = $nfservp['dnfservprestFull']['forn']->get_cnpj();
$vars['d_nf_servprestFull_forn_razao;Razão social:'] = $nfservp['dnfservprestFull']['forn']->get_razao();
$vars['d_nf_servprestFull_forn_ie;Inscrição estadual:'] = $nfservp['dnfservprestFull']['forn']->get_ie();
$vars['d_nf_servprestFull_forn_estado;Estado:'] = $nfservp['dnfservprestFull']['forn']->get_estado();
$helperShowDiv->monta_Div($vars);
$htmldiv = "</div>";
$helperShowDiv->set_html_Div($htmldiv);
$css = "<link rel=\"stylesheet\" href=\"extensions/dnfservprest/cabshow.css\" type=\"text/css\">";
$helperShowDiv->set_css_Div($css);
//print_r($nfservp);
?>
