<?php
 $menu = $knl_helper->getVar("menu");
?>
       <link rel="StyleSheet" href="javascript/dtree.css" type="text/css"></link>
       <script type="text/javascript" src="javascript/dtree.js"></script>
        <div class="dtree">
	      <script type="text/javascript">
		    d = new dTree('d');
		    d.add(0,-1,'Documentos');
<?php
//		    d.add(2,0,'Pesquisa Geral','index.php?domain=Documento&action=documento_pesquisa','Listagem de documentos','conteudo');
foreach($menu as $menu) {
	echo "d.add({$menu->get_id()},0,'{$menu->get_titulo()}','index.php?domain={$menu->get_domain()}&action={$menu->get_action()}','{$menu->get_label()}','{$menu->get_target()}');";
}
?>   
			 document.write(d);
		   </script>
	     </div>
