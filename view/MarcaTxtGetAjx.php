<?php
header("Content-type: text/xml; charset=ISO-8859-1");
header("pragma: no-cache");
header("cache-control: no-cache");
print '<?xml version="1.0" encoding="ISO-8859-1"?>';
$lista = $knl_helper->getVar("marcatexto");
echo "<lista>";
foreach($lista as $v){
echo '<marca_texto x="'.$v->get_x().'" '.
	 'y="'.$v->get_y().'" '.
	 'width="'.$v->get_width().'" '.
	 'height="'.$v->get_height().'">'.$v->get_id().'</marca_texto>';	
}
echo "</lista>";
?>