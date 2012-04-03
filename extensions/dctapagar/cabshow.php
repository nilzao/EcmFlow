<?php
$ctapagar = $knl_helper->getVar('cabecalho');
$ctapagar = $knl_helper->getVar('cabecalho');
$helperShowDiv = knl_view_w3c_hlp_ShowDiv::getInstance();

$htmldiv = "<div id=\"docH\">";
$helperShowDiv->set_html_Div($htmldiv);
$vars['d_cta_pagar_title;Documento:'] = "Nota fiscal de entrada";
$vars['d_cta_pagar;Data vencimento:'] = $ctapagar['dctapagar']->get_data_vencimento();
$vars['d_cta_pagarFull_forn_cnpj;Cnpj:'] = $ctapagar['dctapagarFull']['forn']->get_cnpj();
$vars['d_cta_pagarFull_forn_razao;Razão social:'] = $ctapagar['dctapagarFull']['forn']->get_razao();
$vars['d_cta_pagarFull_forn_ie;Inscrição estadual:'] = $ctapagar['dctapagarFull']['forn']->get_ie();
$vars['d_cta_pagarFull_forn_estado;Estado:'] = $ctapagar['dctapagarFull']['forn']->get_estado();
/*	
$select = "<select id=\"d_cta_pagarFull_carimbos_combo\" size=\"3\">\n";
foreach ($ctapagar['dctapagarFull']['carimbos'] as $v){
	$select .= "<option>{$v['carimbo']->get_descricao()}</option>\n";
}
$select .= "</select>\n";
$vars['d_cta_pagarFull_carimbos;Classificações:'] = $select;
*/

$helperShowDiv->monta_Div($vars);
$htmldiv = "</div>";
$helperShowDiv->set_html_Div($htmldiv);
$css = "<link rel=\"stylesheet\" href=\"extensions/dctapagar/cabshow.css\" type=\"text/css\">";
$helperShowDiv->set_css_Div($css);
//print_r($ctapagar);die();
?>