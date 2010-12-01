<?php
$helperFormEdit = knl_view_hlp_FormEdit::getInstance();
$ordserv = $knl_helper->getVar('cabecalho');
//print_r($ordserv);
$knl_helper->setVar("head","<script type=\"text/javascript\" src=\"./extensions/cadastronf/cot.js\"></script>\n");
$helperFormEdit->monta_CampoValor($ordserv['dordserv']->get_malha(),"malha");
$helperFormEdit->monta_CampoValor($ordserv['dordserv']->get_fio(),"fio");
?>
<?php
$vl = knl_view_Loader::getInstance();
    	$vl->setVar('cotacao_cli',$ordserv["dordservFull"]["d_ord_serv_cli"]);
echo $vl->display("cadastronf/cotEditForm",false,true);
?>
<td>Malha: </td><td><?php echo $helperFormEdit->html_CampoValor('malha'); ?></td>
<td>Fio: </td><td><?php echo $helperFormEdit->html_CampoValor('fio'); ?></td>
