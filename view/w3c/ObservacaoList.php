<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
$lista = $knl_helper->getVar("lista");
$id_doc = $knl_helper->getVar("id_doc");
$pag = $knl_helper->getVar("pag");
?>
<script type="text/javascript">
<?php

foreach($lista as $obs) {
	if(($obs->get_x()!=0) AND ($obs->get_y()!=0) AND ($obs->get_pag() == $pag)){
		$msg = strip_tags($obs->get_obs());
		$msg = str_replace("&nbsp;"," ",$msg);
		$msg = str_replace("'","`",$msg);
		$msg = str_replace('"','``',$msg);
		$msg = str_replace("\x0A",'',$msg);
		$msg = str_replace("\x0B",'',$msg);
		$msg = str_replace("\x0C",'',$msg);
		$msg = str_replace("\x0D",'',$msg);
		$msg = str_replace("\x0E",'',$msg);
	?>
		parent.add_obj('<?php
		 echo "obs_".$obs->get_id();?>','<?php
		 echo "./view/w3c/img/icones/note.png";?>','<?php
		 echo $msg;?>','<?php
		 echo $obs->get_id();?>','<?php
		 echo $obs->get_x();?>','<?php 
		 echo $obs->get_y();?>','ObsSetxy');
<?php
	}
}
?>
</script>
 </head>
 <body>

<h3>Observacoes</h3>
<a href="index.php?domain=Doc&action=ObsAddForm&id=<?php echo $id_doc; ?>">Adicionar</a><hr>
<?php
foreach($lista as $obs) {
	$msg = strip_tags($obs->get_obs());
	$msg = str_replace("&nbsp;"," ",$msg);
	$msg = str_replace("'","`",$msg);
	$msg = str_replace('"','``',$msg);
	$msg = str_replace("\x0A",'',$msg);
	$msg = str_replace("\x0B",'',$msg);
	$msg = str_replace("\x0C",'',$msg);
	$msg = str_replace("\x0D",'',$msg);
	$msg = str_replace("\x0E",'',$msg);
	echo "<img src=\"./view/w3c/img/icones/note.png\" onclick=\"parent.set_follow('obs_".$obs->get_id()."','./view/w3c/img/icones/note.png','".$msg."','".$obs->get_id()."','ObsSetxy');\">\n";
	echo $obs->get_obs();
}
?>
 </body>
</html>