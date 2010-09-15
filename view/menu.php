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
foreach($menu as $v) {
	echo "d.add({$v->get_id()},0,'{$v->get_titulo()}','index.php?domain={$v->get_domain()}&action={$v->get_action()}','{$v->get_label()}','{$v->get_target()}');";
}
?>   
			 document.write(d);
		   </script>
	     </div>