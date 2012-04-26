<?php
$helperFormEdit = knl_view_w3c_hlp_FormEdit::getInstance();
$obj = $knl_helper->getVar('recursos');

if ($obj == "x"){
	$dataentrega = "00/00/0000";
}
else {
	$dataentrega = $obj->get_dataentrega();
}
$helperFormEdit->monta_CampoData($dataentrega,"dataentrega[]");
echo $helperFormEdit->html_CampoData('dataentrega[]');
?>
