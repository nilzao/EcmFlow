function show_ferramentas(id_doc,pag){
	$("#div_ferramentas").toggle();
}

function add_caneta(){
	var url="index.php?domain=Doc&action=MarcaTxtAdd&id_doc="+_id_doc_js+"&y="+$(window).scrollTop()+"&pag="+_pag_js;
	$.ajax({
		type: "GET",
		   url: url,
		   dataType: "xml",
		   success: function(xml){
				show_caneta(xml);
		   }
	});
}

function get_canetas(){
	var url="index.php?domain=Doc&action=MarcaTxtGetXml"+
	 "&id_doc="+_id_doc_js+
	 "&pag="+_pag_js;
	$.ajax({
		type: "GET",
		url: url,
		dataType: "xml",
		success: function(xml){
			draw_canetas(xml);
		}
	});
}

function draw_canetas(xml){
	var i_caneta;
	$(xml).find('marca_texto').each(function(){
		i_caneta = $(this).text();
		draw_caneta(i_caneta,
					$(this).attr("x"),
					$(this).attr("y"),
					$(this).attr("width"),
					$(this).attr("height"));
	});
}

function draw_caneta(i_caneta,x,y,width,height){
	$("#caneta").clone().appendTo("#doc_img_div").attr("id","caneta_"+i_caneta);
	$("#caneta_"+i_caneta).draggable();//{containment: 'parent'}
	$("#caneta_"+i_caneta).resizable({
		stop: function(event, ui) {set_caneta(ui.helper); }
	});
	$("#caneta_"+i_caneta).show();
	$("#caneta_"+i_caneta).css("left", (x + "px"));
	$("#caneta_"+i_caneta).css("top", (y + "px"));
	$("#caneta_"+i_caneta).css("width", (width + "px"));
	$("#caneta_"+i_caneta).css("height", (height + "px"));
}

function set_caneta(obj){
	if (obj.attr("id") != "regua"){
		var url="index.php?domain=Doc&action=MarcaTxtSetxywh&id_marcatxt="+
				 obj.attr("id").substr(7)+"&id_doc="+_id_doc_js+
				 "&x="+obj.css("left")+"&y="+obj.css("top")+
				 "&width="+obj.css("width")+"&height="+obj.css("height")+
				 "&pag="+_pag_js;
		$.ajax({
			type: "GET",
			   url: url,
			   success: function(){
				//alert("url ok:\n"+url);
			   }
		});
	}	
}

function del_caneta(obj){
	if (obj.attr("id") != "regua"){
		var url="index.php?domain=Doc&action=MarcaTxtDel&id_marcatxt="+
		 obj.attr("id").substr(7);
		$.ajax({
			type: "GET",
			url: url,
			success: function(){
				obj.remove();
				alert("excluido!");
			}
		});
		
	}
}

function show_caneta(xml){
	var i_caneta='';
	$(xml).find('marca_texto').each(function(){
		i_caneta = $(this).text();
	});
	draw_caneta(i_caneta,0,$(window).scrollTop(),100,30);
}

function toggle_regua(){
	$("#regua").css("top", ($(window).scrollTop() + "px"));
	$("#regua").toggle();
}
