<?php
 $helperAnexoCab = knl_view_hlp_AnexoCab::getInstance();
 $documento = $knl_helper->getVar("doc");
 $cabecalho = $knl_helper->getVar("cabecalho");

?>
O seguinte documento foi anexo:
<pre>
   <?php
   print_r($documento);
   
   $helperAnexoCab->monta_Cabecalho($cabecalho);
   echo $helperAnexoCab->html_Cabecalho();
    ?>
 </pre>
