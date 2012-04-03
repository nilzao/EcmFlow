var _x = 0;
var _y = 0;
var _pag = 0;
var _id_obj = null;
var _id_db = null;
var _action = null;

function getURLVar(urlVarName) {
	//divide the URL in half at the '?'
	var urlHalves = String(document.location).split('?');
	var urlVarValue = '';
	if(urlHalves[1]){
		//load all the name/value pairs into an array
		var urlVars = urlHalves[1].split('&');
		//loop over the list, and find the specified url variable
		for(i=0; i<=(urlVars.length); i++){
			if(urlVars[i]){
				//load the name/value pair into an array
				var urlVarPair = urlVars[i].split('=');
				if (urlVarPair[0] && urlVarPair[0] == urlVarName) {
				//I found a variable that matches, load it's value into the return variable
				urlVarValue = urlVarPair[1];
				}
			}
		}
	}
	urlVarValue = urlVarValue.replace("#", "");
	return urlVarValue;   
}

function ativa_setXY(){
	document.getElementById('doc_img').onmouseup = setXY;
}

function setXY(e) {
	if(_id_obj != null){
		_x = (window.Event) ? e.layerX : event.offsetX;
		_y = (window.Event) ? e.layerY - 7 : event.offsetY - 7;
		set_follow(_id_obj,'','',_id_bd,_action);
		_id_obj = null;
		_action = null;
		seguemouse = false;
	}
}

function ajaxMarca(id_marca,action){
	url = "index.php?domain=Doc&action="+action+"&id_marca="+id_marca+"&x=" + _x + "&y=" + _y + "&pag=" + _pag;
    if (window.XMLHttpRequest) {
        HttpReq = new XMLHttpRequest();
        HttpReq.open("GET", url, true);
        HttpReq.send(null);
    } else if (window.ActiveXObject) {
        HttpReq = new ActiveXObject("Microsoft.XMLHTTP");
        if (HttpReq) {
            HttpReq.open("GET", url, true);
            HttpReq.send();
        }
    }
}