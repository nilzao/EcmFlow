<?php
$pedc = $knl_helper->getVar('cabecalho');
$helperShowDiv = knl_view_w3c_hlp_ShowDiv::getInstance();

$vars['d_ped_compra_title;Documento:'] = "Pedido de compra";

$htmldiv = "<div id=\"docH\">";
$helperShowDiv->set_html_Div($htmldiv);
$vars['d_ped_compraFull_forn_cnpj;Cnpj:'] = $pedc['dpedcompraFull']['forn']->get_cnpj();
$vars['d_ped_compraFull_forn_razao;Razão social:'] = $pedc['dpedcompraFull']['forn']->get_razao();
$vars['d_ped_compraFull_forn_ie;Inscrição estadual:'] = $pedc['dpedcompraFull']['forn']->get_ie();
$vars['d_ped_compraFull_forn_estado;Estado:'] = $pedc['dpedcompraFull']['forn']->get_estado();

$select = "<select id=\"d_ped_compraFull_dataentrega_combo\" size=\"3\">\n";
foreach ($pedc['dpedcompraFull']['dataentrega'] as $v){
	$select .= "<option>{$v->get_dataentrega()}</option>\n";
}
$select .= "</select>\n";
$vars['d_ped_compraFull_dataentrega;Datas de Entrega:'] = $select;

$helperShowDiv->monta_Div($vars);
$htmldiv = "</div>";
$helperShowDiv->set_html_Div($htmldiv);
$css = "<link rel=\"stylesheet\" href=\"extensions/dpedcompra/cabshow.css\" type=\"text/css\">";
$helperShowDiv->set_css_Div($css);
?>
