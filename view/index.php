<?php
 $menu = $knl_helper->getVar("menu");
?>
<html>
 <head>
  <title>Administração de Documentos</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" href="temas/estilo.css" type="text/css"/>
  <script language="JavaScript" type="text/javascript" src="./view/js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
	  setInterval(ver_pendencia, 600000);
  });
  
function ver_pendencia(){
	$.ajax({
		type: "GET",
		   url: "index.php",
		   cache: false,
		   dataType: "xml",
		   data: "domain=Doc&action=PendenciaXml",
		   success: function(msgxml){
		   alerta_pendencia(msgxml);
		   }
	});
}

function alerta_pendencia(msgxml){
	//alert( "Nois: " + msg );
	//var msgdiv = $(msgxml).find('a');
	//var msgdiv = $(msgxml).find('a').text();
	//var msgdiv = $(msgxml).find('#nois').text();
	var msgdiv = $(msgxml).find('#totalpendencias').text();
	if(msgdiv != 0){
		alert("Você possui pendencias.");
	}
}
</script>  
 </head>
 <body bgcolor="#395886" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <table width="778" border="0" cellpadding="0" cellspacing="0">
   <tr align="right"> 
    <td height="40" align="center">
    
     <h2>
      <font color="#FFFFFF" face="Verdana">EcmFlow</font>
     </h2>
    </td>
   </tr>
   <tr> 
    <td width="180" height="449" valign="top"> 
     <table width="178" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr bgcolor="#990000"> 
       <td height="5" bgcolor="#4671A6" class="texto1">Administração</td>
      </tr>
      <tr  bgcolor="#CC0000"> 
       <td valign="top" bgcolor="#FFFFFF"> 
<?php
echo $menu;
?>
       </td>
      </tr>
      <tr  bgcolor="#CC0000">
       <td height="5" bgcolor="#4671A6" class="texto">Bem vindo</td>
      </tr>
     </table>
    </td>
    <td width="651" valign="top">
     <iframe src="index.php?domain=Entrada" name="conteudo" scrolling="auto"  frameborder="1" class="iframe" id="conteudo"></iframe>
    </td>
   </tr>
  </table>
 </body>
</html>