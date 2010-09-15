<div id="dextrato" style="display:block">
Extrato:<br>
<?php
$helperForm = knl_extensions_dextrato_formHlp::getInstance();
$helperForm->monta_ExtratoBancoCombo ();
$helperForm->monta_ExtratoAgenciaCombo ();
$helperForm->monta_ExtratoContaCombo ();
echo $helperForm->html_ExtratoBancoCombo();
echo $helperForm->html_ExtratoAgenciaCombo();
echo $helperForm->html_ExtratoContaCombo();
?><br>
Movimento De: <input type="text" name="data1"> Até <input type="text" name="data2">
</div>