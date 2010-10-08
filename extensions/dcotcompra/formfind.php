<?php
$head = array('dcotcompra'=>'<script type="text/javascript">alert("HELL!");</script>');
if($knl_helper->isSetVar("head")){
	$head = array_merge($head,$knl_helper->getVar("head")); 
}
$knl_helper->setVar("head",$head);
?>
<div id="dcotcompra" style="display:block">
Cotação de Compra:<br>
<br>
</div>
