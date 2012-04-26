/*
Simple Image Trail script- By JavaScriptKit.com
Visit http://www.javascriptkit.com for this script and more
This notice must stay intact
*/

var seguemouse = false;
var obj_follow;
var trailimage=["test.gif", 31, 22]; //image path, plus width and height
var offsetfrommouse=[-11,-25]; //image x,y offsets from cursor position in pixels. Enter 0,0 for no offset
var displayduration=0; //duration in seconds image should remain visible. 0 for always.

function gettrailobj(){
		return obj_follow.style;
}

function truebody(){
	return (!window.opera && document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body;
}

function hidetrail(){
	gettrailobj().visibility="hidden";
	document.onmousemove="";
}

function followmouse(e){
	if (seguemouse == true){
		var xcoord=offsetfrommouse[0];
		var ycoord=offsetfrommouse[1];
		if (typeof e != "undefined"){
			xcoord+=e.pageX;
			ycoord+=e.pageY;
		}
		else if (typeof window.event !="undefined"){
			xcoord+=truebody().scrollLeft+event.clientX;
			ycoord+=truebody().scrollTop+event.clientY;
		}
		var docwidth=document.all? truebody().scrollLeft+truebody().clientWidth : pageXOffset+window.innerWidth-15;
		var docheight=document.all? Math.max(truebody().scrollHeight, truebody().clientHeight) : Math.max(document.body.offsetHeight, window.innerHeight);
		if (xcoord+trailimage[1]+3>docwidth || ycoord+trailimage[2]> docheight){
			gettrailobj().display="none";
		}
		else {
			gettrailobj().display="";
			gettrailobj().left=xcoord+"px";
			gettrailobj().top=ycoord+"px";
		}
	}
}

function set_follow(id_obj,img_src,msg,id_bd,action){
	if (document.getElementById(id_obj)!=null &&
			document.getElementById(id_obj).parentNode == document.getElementById("doc_img_div")){
		obj_filho = document.getElementById(id_obj);
		document.getElementById('doc_img_div').removeChild(obj_filho);
	}
	_id_obj = id_obj;
	_id_bd = id_bd;
	_action = action;
	if (document.getElementById(id_obj) != null){
		obj_follow = document.getElementById(id_obj);
	} else {
		imagem = document.createElement('img');
		imagem.setAttribute('src',img_src);
		imagem.setAttribute('id',id_obj);
		imagem.setAttribute('alt',msg);
		imagem.setAttribute('title',msg);
		imagem.setAttribute('onmouseup',"set_follow('"+id_obj+"','"+img_src+"','"+msg+"','"+ id_bd +"','"+action+"');");
		document.getElementById("div_insert").appendChild(imagem);
		document.getElementById(id_obj).style.position="absolute";
		obj_follow = document.getElementById(id_obj);
	}

	if(seguemouse == true){
		seguemouse = false;
		_pag = (getURLVar("pag") == "") ? 1 : getURLVar("pag") ;
		ajaxMarca(id_bd,action);
	} else{
		seguemouse = true;
	}
}


document.onmousemove=followmouse;

if (displayduration>0){
	setTimeout("hidetrail()", displayduration*1000);
}

function add_obj(id_obj,img_src,msg,id_bd,x,y,action){
	var obj = make_obj(id_obj,img_src,msg,id_bd,x,y,action);
	add_pure_obj(obj);
}

function make_obj(id_obj,img_src,msg,id_bd,x,y,action){
	if (document.getElementById(id_obj) == null){
		imagem = document.createElement('img');
		imagem.setAttribute('src',img_src);
		imagem.setAttribute('id',id_obj);
		imagem.setAttribute('alt',msg);
		imagem.setAttribute('title',msg);
		imagem.style.position="absolute";
		imagem.style.left=x+"px";
		imagem.style.top=y+"px";
		imagem.setAttribute('onmouseup',"set_follow('"+id_obj+"','"+img_src+"','"+msg+"','"+ id_bd +"','"+action+"');");
	}
	return imagem;
}

function add_pure_obj(objeto){
	document.getElementById("doc_img_div").appendChild(objeto);
}

//abre janela maximizada
function abreM(url,janela){
  W = eval(screen.width)-10;
  H = eval(screen.height)-54;
  window.open(url,janela,"toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,copyhistory=0,width="+W+",height="+H+",top=0,left=0");
}
