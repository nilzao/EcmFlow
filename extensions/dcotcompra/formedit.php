<?php
$helperFormEdit = knl_view_hlp_FormEdit::getInstance();
$cotacao = $knl_helper->getVar('cabecalho');
//print_r($cotacao);
$knl_helper->setVar("head","<script type=\"text/javascript\" src=\"./extensions/cadastronf/cot.js\"></script>\n");
?>
<?php
$vl = knl_view_Loader::getInstance();
    	$vl->setVar('cotacao_cli',$cotacao["dcotcompraFull"]["d_cotacao_forn"]);
echo $vl->display("cadastronf/cotEditForm",false,true);
?>
