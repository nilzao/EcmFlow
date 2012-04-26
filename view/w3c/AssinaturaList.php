<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Assinaturas</title>
 </head>
 <body>
<?php
$lista = $knl_helper->getVar("lista");
$id_doc = $knl_helper->getVar("id_doc");
?>
  <h1>Assinaturas</h1>
   <?php
    echo "<a href=\"index.php?domain=Doc&action=AssinaturaAdd&id={$id_doc}&atp=1\">Assinar</a> ";
    echo "<a href=\"index.php?domain=Doc&action=AssinaturaAdd&id={$id_doc}&atp=4\">Lançar</a><br>";
    
foreach ($lista as $v) {
	echo "{$v['doc_assinatura_tipo']->get_descricao()} por {$v['knl_usuario']->get_login()} em {$v['doc_assinatura']->get_data_assinatura()}<br>\n";
}
    
    ?>
  
 </body>
</html>