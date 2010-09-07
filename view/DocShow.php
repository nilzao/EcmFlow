<?php
 $documento = $knl_helper->getVar("doc");
 $cabecalho = $knl_helper->getVar("cabecalho");
 $pag = $knl_helper->getVar("pag");
 $obsCount = $knl_helper->getVar("obsCount");
 $helperShowBtn = knl_view_hlp_ShowBtn::getInstance();
 $helperShowCab = knl_view_hlp_ShowCab::getInstance();
 $helperShowDiv = knl_view_hlp_ShowDiv::getInstance();
 $helperShowPag = knl_view_hlp_ShowPag::getInstance();
 
 $actions = $cabecalho['docActions'];
 $helperShowBtn->monta_Actions($actions,$obsCount);

 $vars['doc_data;Data de emissão:'] = $documento->get_data_doc();
 $vars['doc_numero;Número:'] = $documento->get_numero();
 
 $htmldiv ="<div id=\"doc\">\n";
 $helperShowDiv->set_html_Div($htmldiv);
 $helperShowDiv->monta_Div($vars);
 $htmldiv ="</div>\n\n";
 $helperShowDiv->set_html_Div($htmldiv);
 
 //$vars['doc_pag;Paginas:'] = $documento->get_pag();
 $helperShowPag->monta_Paginas($documento->get_id(),$documento->get_pag(),$pag);
   
 $helperShowCab->monta_Cabecalho($cabecalho);
?>

<html>
 <head>
  <title>
   Documento
  </title>
  <?php
    echo $helperShowBtn->js_Editar();
    echo $helperShowDiv->js_Div(); 
    echo $helperShowPag->js_Paginas();
    echo $helperShowDiv->css_Div(); 
    echo $helperShowPag->css_Paginas();
  ?>

 <script language="JavaScript" type="text/javascript" src="./view/js/ajxmarca.js"></script>
 <script language="JavaScript" type="text/javascript" src="./view/js/addparent.js"></script>
 
 <!--script language="JavaScript" type="text/javascript" src="./view/js/jquery.js"></script-->
<link href="./view/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./view/js/jquery.min.js"></script>
<script type="text/javascript" src="./view/js/jquery-ui.min.js"></script>

 <script language="JavaScript" type="text/javascript" src="./view/js/ferramentas.js"></script>
 <script language="JavaScript" type="text/javascript" src="./view/js/segue.js"></script>
 <script src="./view/js/jquery.easing.1.3.js" type="text/javascript"></script>
 <script src="./view/js/sexylightbox.v2.3.jquery.js" type="text/javascript"></script>
 <link rel="stylesheet" href="./view/css/sexylightbox.css" type="text/css" media="all" />
 
 <script language="JavaScript" type="text/javascript">
var _pag_js = <?php echo $pag ; ?>;
var _id_doc_js = <?php echo $documento->get_id(); ?>;
 
  function iframeSet(url){
   document.getElementById('iframebox').src=url;
   document.getElementById('divbox').style.display='block';
  }
  function iframeClose()
  {document.getElementById('divbox').style.display='none';}
 </script>
 <script>
 function confirmar(msg){
 	if (confirm(msg)) {
 		return true;
 	}
 	return false;
 }
 </script>
 <script language="JavaScript" type="text/javascript">

var LastPosY = 0;

function move_DIV() {
	var y = document.body.scrollTop;
	if (y!=LastPosY) {
		if (document.layers) {
			document.layers['div_fix'].top=y;
		}
		else if (document.all) {
			document.all['div_fix'].style.pixelTop=y;
		}
		LastPosY=y;
	}
	if (TimeScroll)	window.setTimeout('move_DIV()','500');
}

var TimeScroll = true;

function IeScroll() {
	ie_pos = (document.body && typeof document.body.scrollTop!='undefined');
	window.onscroll=function(){window.onscroll=move_DIV;TimeScroll=false;};
	if (ie_pos) move_DIV();
}

$(document).ready(function(){
	IeScroll();ativa_setXY();
	SexyLightbox.initialize({dir: './img/sexylightbox/'});

	$("#lixeira_caneta").droppable({
		drop: function(event, ui) { del_caneta(ui.draggable); }
	});
	
	$("#doc_img_div").droppable({
		drop: function(event, ui) { set_caneta(ui.draggable); }
	});
	
	$("#regua").draggable({ axis: 'y', containment: 'parent'});
});

function displayAuthResultOk(){
	//$("#resultado").show();
	SexyLightbox.close();
	location.reload(true);
}

function displayAuthResultFail(){
	SexyLightbox.refresh();
	SexyLightbox.shake();
}

function load_url(url){
	$.ajax({
		type: "GET",
		   url: url,
		   dataType: "html",
		   success: function(html){
				load_div(html);
		   }
	});
}

function load_div(html){
	$("#conteudo").attr("innerHTML","");
	$("#conteudo").append(html);	
}

</script>
 
 <style>
   body{
   margin:0px;
   }
   
   #div_fix {
   position:absolute;
   top:0px;
   left:0px;
   z-index:98;
   }
   
   #div_ferramentas {
   position:fixed;
   top:0px;
   left:605px;
   width:100px;
   height:184px;
   z-index:80;
   background-color:#fff;
   border: solid 1px;
   display:none;
   }
   
   .divbox {
	position: fixed;
	top: 0px;
	left: 0px;
	width:600px;
	height:200px;

	background-color:#DDDDDD;
	display:none;
	z-index:99;
	}
	.iframebox {
	width:100%;
	height:100%;
	}
	
	#doc_show {
	height:186px;
	padding:0px;
	background-image: url("./img/docshow/barra.jpg");
	min-width:1000px;
	z-index:0;
	}
	
	#doc {
	position:relative;
	font-size: 16px;
	font-family: Arial;
	font-style: normal;
	font-weight: lighter;
	color: #FFFFFF;
	height:43px;
	padding:0px;
	}
	
	#div_fix_width {
    position:relative;
    height: 0px;
    width:1000px;
    z-index:0;
    }

	#doc_numero_label{
	position:absolute;
	height:14px;
	width:100px;
	padding:0px;
	top:25px;
	left:10px;
	}

	#doc_numero{
	position:absolute;
	font-weight: bold;
	height:14px;
	width:100px;
	padding:0px;
	top:25px;
	left:110px;
	}

	#doc_data_label{
	letter-spacing: 0px;
	position:absolute;
	font-weight: lighter;
	height:14px;
	width:180px;
	padding:0px;
	top:25px;
	left:300px;
	}

	#doc_data{
	position:absolute;
	letter-spacing: 0px;
	font-weight: bold;
	height:14px;
	width:100px;
	padding:0px;
	top:25px;
	left:430px;
	}
	
	#doc_show_botoes {
	position: relative;
	height:44px;
	width:100%;
	padding:0px;
	background-color:#FFFFFF;
	}
	
	#doc_sombra {
	position: absolute;
	top: 0;
	left: 0; 
	width:100%;
	height: 28px;
	padding:0px;
	background-image: url("./img/docshow/barrasombra.jpg");
	background-repeat:repeat-x;
	background-color: #000000;
	}
	
	#doc_botoes {
	position: absolute;
	top:0;
	right:20;
	padding:0px;
	}
	
	#doc_msg {
	position:absolute;
	font-size: 12px;
	font-family: Arial;
	font-style: italic;
	font-weight: lighter;
	color: #FFFFFF;
	top: 173px;
	right:10px;
	}
	
	#tb_close {
	}
	
	.caneta {
	background-color:#ff0;
	width:100px;
	height:30px;
	filter:alpha(opacity=40);
	-moz-opacity:0.4;
	-khtml-opacity: 0.4;
	opacity: 0.4;
	display: none;
	position: absolute;
	top: 0px;
	left: 0px;
	z-index: 90;
	}
	
	#regua{
	background-color:#ff0;
	width:990px;
	height:80px;
	filter:alpha(opacity=60);
	-moz-opacity:0.6;
	-khtml-opacity: 0.6;
	opacity: 0.6;
	display: none;
	position: absolute;
	top: 0px;
	left: 0px;
	z-index: 75;
	border: solid 2px;
	}
	
	#lixeira_caneta {
	width:50px;
	height:50px;
	background-color: #f00;
	border: solid 1px;
	}
	
 </style>
 </head>
 <body>
 
<div id="doc_show">
 <div id="div_fix">
  <div class="divbox" id="divbox"><iframe class="iframebox" id="iframebox"></iframe>
  <table width="100%" border="0" id="tb_close"><tr><td align="right"><a style="background-color:#000000;color:#FFFFFF;" onclick="iframeClose();"><strong>Fechar</strong></a></td></tr></table>
   </div>
 </div><div id="div_ferramentas"><input type="button" onclick="add_caneta();" value="Add">
 <br><input type="button" onclick="get_canetas();" value="Show"><br>
 <input type="button" onclick="toggle_regua();" value="Régua"><br><br>
 <div id="lixeira_caneta">DEL</div>
 </div>
<?php
echo $helperShowPag->html_Paginas();
?>

<?php
   echo $helperShowDiv->html_Div();
?>
<div id="div_fix_width"></div>
</div>
<div id="doc_msg">"Antes de imprimir, pense na responsabilidade com o meio ambiente".</div>
<div id="doc_show_botoes">
<div id="doc_sombra">
<div id="doc_botoes">
<img src="./img/docshow/esq.jpg"><!-- a href="#"><img alt="Enviar por email" title="Enviar por email" src="./img/icones/botemail.jpg" border="0" onclick="iframeSet('index.php?domain=Doc&action=MailForm&doc_id=<?php echo $documento->get_id(); ?>')"></a><img src="./img/docshow/entrebotoes.jpg"--><a href="#"><img alt="Ferramentas" title="Ferramentas" src="./img/icones/botanexo.jpg" border="0" onclick="show_ferramentas('<?php echo $documento->get_id(); ?>','<?php echo $pag; ?>');"></a><img src="./img/docshow/entrebotoes.jpg"><a href="#"><img alt="Anexos" title="Anexos" src="./img/icones/botanexo.jpg" border="0" onclick="iframeSet('index.php?domain=Doc&action=AnexoList&doc_id=<?php echo $documento->get_id(); ?>&pag=<?php echo $pag; ?>')"></a><img src="./img/docshow/entrebotoes.jpg"><a href="#"><img alt="Assinaturas" title="Assinaturas" src="./img/icones/botassina.jpg" border="0" onclick="iframeSet('index.php?domain=Doc&action=AssinaturaList&id=<?php echo $documento->get_id(); ?>')"></a><img src="./img/docshow/entrebotoes.jpg"><!--a href="#">< img alt="Carimbos" title="Carimbos" src="./img/icones/botcarimbo.jpg" border="0" onclick="iframeSet('index.php?domain=Doc&action=CarimboList&id=<?php echo $documento->get_id(); ?>')"></a><img src="./img/docshow/entrebotoes.jpg"--><?php
	echo $helperShowBtn->html_Action('Obs');
	echo $helperShowBtn->html_Action('Excluir');
    //echo $helperShowBtn->html_Action('Anexar');
   echo $helperShowBtn->html_Action('Aprovar');
   echo $helperShowBtn->html_Action('Editar');
?><img src="./img/docshow/dir.jpg">
</div>
</div>
</div>
<center>
<div id="doc_img_div" style="position:relative;width:1000px">
<div id="regua" class="regua"></div>
   <img id="doc_img" style="position:relative;z-index:0;" src="img/doc/<?php echo "{$documento->get_id()}_{$pag}"; ?>.jpg" />
</div>

<div id="caneta" class="caneta"></div>
<div id="div_insert" style="position:absolute;top:0px;left:0px;"></div>
</center>
 </body>
</html>
