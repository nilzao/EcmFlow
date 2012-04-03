<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
$helperLista = knl_view_w3c_hlp_Lista::getInstance();
$helperLista->monta_ListaJs();
$pag = $knl_helper->getVar("pag");
echo $helperLista->js_ListaJs();
?>
<script type="text/javascript" language="JavaScript">
var img_obj=null;
<?php
$lista = $knl_helper->getVar("lista");
//print_r($lista);die();

foreach($lista as $doc) {
	if(($doc['doc_anexo']->get_x()!=0) AND 
		$doc['doc_anexo']->get_y()!=0 AND 
		$doc['doc_anexo']->get_pag() == $pag AND
		empty($doc['MarcaAnexo']['anexoTop']['doc_anexo'])){
		/*
		$msg = strip_tags($obs->get_obs());
		$msg = str_replace("&nbsp;"," ",$msg);
		$msg = str_replace("'","`",$msg);
		$msg = str_replace('"','``',$msg);
		$msg = str_replace("\x0A",'',$msg);
		$msg = str_replace("\x0B",'',$msg);
		$msg = str_replace("\x0C",'',$msg);
		$msg = str_replace("\x0D",'',$msg);
		$msg = str_replace("\x0E",'',$msg);*/
		$msg = "";
	?>
		 img_obj = parent.make_obj('<?php
		 echo "anx_".$doc['doc_anexo']->get_id();?>','<?php
		 echo "./view/w3c/img/icones/anexo.png";?>','<?php
		 echo $msg;?>','<?php
		 echo $doc['doc_anexo']->get_id();?>','<?php
		 echo $doc['doc_anexo']->get_x();?>','<?php 
		 echo $doc['doc_anexo']->get_y();?>','AnexoSetxy');
		 img_obj.setAttribute('onmouseup',"abreM('index.php?domain=Doc&action=DocShow&id=<?php
		 echo $doc["doc"]->get_id();
		 ?>','');");
		 img_obj.style.cursor="pointer";
		 parent.add_pure_obj(img_obj);
<?php
	}
}

?>
</script>
<link rel="stylesheet" href="view/w3c/css/lista.css" type="text/css">
 </head>
 <body bgcolor="FFFFFF" style="margin-top:0px;margin-bottom:0px;">
<?php
//$helperPag = knl_view_w3c_hlp_Paginacao::getInstance();
$helperAnexoTop = knl_view_w3c_hlp_AnexoTop::getInstance();
$helperShowBtn = knl_view_w3c_hlp_ShowBtn::getInstance();


//$paginacao = $knl_helper->getVar("paginacao");
$urlAdd = $knl_helper->getVar("urlAdd");
$anexoTop = $knl_helper->getVar("anexoTop");
$actions = $knl_helper->getVar("actions");

$helperShowBtn->monta_Actions($actions);
?>
<?php
$helperAnexoTop->monta_Origem($anexoTop);
echo $helperAnexoTop->html_Origem();
echo " &nbsp; ";
echo $helperShowBtn->html_Action("Anexar");
//echo "<br><br>";

$cab = array("Id","Tipo","Emissão","Número","Desanexar","Marcar");
$valores = array("get_id"=>"doc","get_descricao"=>"docTipo","get_data_doc"=>"doc","get_numero"=>"doc",";#DesanexaBtn"=>"Desanexa",";#AnexaMarcaBtn"=>"MarcaAnexo");
//print_r($lista);die();
$helperLista->monta_Lista($lista,$cab,$valores);
echo $helperLista->html_Lista();

//$helperPag->monta_Paginacao($paginacao,$urlAdd);
//echo $helperPag->html_Paginacao();
?>
<?php
//$helperShowBtn->monta_Desanexar($actions,$doc[0]->get_id(),$anexoTop);
?>
  
 </body>
</html>