<?php
$nfentrada = $knl_helper->getVar('cabecalho');
$nfentrada = $knl_helper->getVar('cabecalho');
$helperShowDiv = knl_view_hlp_ShowDiv::getInstance();

$htmldiv = "<div id=\"docH\">";
$helperShowDiv->set_html_Div($htmldiv);
$vars['d_nf_entrada_title;Documento:'] = "Nota fiscal de entrada";
$vars['d_nf_entrada;Data de entrada:'] = $nfentrada['dnfentrada']->get_dataent();
$vars['d_nf_entradaFull_forn_cnpj;Cnpj:'] = $nfentrada['dnfentradaFull']['forn']->get_cnpj();
$vars['d_nf_entradaFull_forn_razao;Razão social:'] = $nfentrada['dnfentradaFull']['forn']->get_razao();
$vars['d_nf_entradaFull_forn_ie;Inscrição estadual:'] = $nfentrada['dnfentradaFull']['forn']->get_ie();
$vars['d_nf_entradaFull_forn_estado;Estado:'] = $nfentrada['dnfentradaFull']['forn']->get_estado();

$select = "<select id=\"d_nf_entradaFull_carimbos_combo\" size=\"3\">\n";
foreach ($nfentrada['dnfentradaFull']['carimbos'] as $v){
	$select .= "<option>{$v['carimbo']->get_descricao()}</option>\n";
}
$select .= "</select>\n";
$vars['d_nf_entradaFull_carimbos;Classificações:'] = $select;

$helperShowDiv->monta_Div($vars);
$htmldiv = "</div>";
$helperShowDiv->set_html_Div($htmldiv);
$css = "<link rel=\"stylesheet\" href=\"extensions/dnfentrada/cabshow.css\" type=\"text/css\">";
$helperShowDiv->set_css_Div($css);
//print_r($nfentrada);die();
?>