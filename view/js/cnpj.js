var HttpReq = null;

  function mask_cnpj(Campo, TeclaPres) 
  { 
    var tecla = TeclaPres.keyCode; 
    var strCampo; 
    var vr; 
    var tam; 
    var TamanhoMaximo = 14;
	strCampo = document.getElementById(Campo);
  //eval("strCampo = document." + Formulario + "." + Campo); 
//    eval("strCampo = document.getElementById('"+ Campo +"')"); 
  
    vr = document.getElementById(Campo).value;
    vr = vr.replace("/", ""); 
    vr = vr.replace("/", ""); 
    vr = vr.replace("/", ""); 
    vr = vr.replace(",", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    tam = vr.length; 

    if (tam < TamanhoMaximo && tecla != 8) 
    { 
      tam = vr.length + 1; 
    } 

    if (tecla == 8) 
    { 
      tam = tam - 1; 
    } 

    if (tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105) 
    { 
      if (tam <= 2) 
      { 
        strCampo.value = vr; 
      } 
       if ((tam > 2) && (tam <= 6)) 
       { 
         strCampo.value = vr.substr(0, tam - 2) + '-' + vr.substr(tam - 2, tam); 
       } 
       if ((tam >= 7) && (tam <= 9)) 
       { 
         strCampo.value = vr.substr(0, tam - 6) + '/' + vr.substr(tam - 6, 4) + '-' + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 10) && (tam <= 12)) 
       { 
         strCampo.value = vr.substr(0, tam - 9) + '.' + vr.substr(tam - 9, 3) + '/' + vr.substr(tam - 6, 4) + '-' + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 13) && (tam <= 14)) 
       { 
         strCampo.value = vr.substr(0, tam - 12) + '.' + vr.substr(tam - 12, 3) + '.' + vr.substr(tam - 9, 3) + '/' + vr.substr(tam - 6, 4) + '-' + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 15) && (tam <= 17)) 
       { 
         strCampo.value = vr.substr(0, tam - 14) + '.' + vr.substr(tam - 14, 3) + '.' + vr.substr(tam - 11, 3) + '.' + vr.substr(tam - 8, 3) + '.' + vr.substr(tam - 5, 3) + '-' + vr.substr(tam - 2, tam); 
      } 
    } 
  } 
  
  
  function ajaxFormFull(url,indice){
    if (document.getElementById) {
    url = url + indice;
        if (window.XMLHttpRequest) {
            HttpReq = new XMLHttpRequest();
            HttpReq.onreadystatechange = XMLHttpRequestChangez;
            HttpReq.open("GET", url, true);
            HttpReq.send(null);
        } else if (window.ActiveXObject) {
            HttpReq = new ActiveXObject("Microsoft.XMLHTTP");
            if (HttpReq) {
                HttpReq.onreadystatechange = XMLHttpRequestChangez;
                HttpReq.open("GET", url, true);
                HttpReq.send();
            }
        }
    }
 }

 function XMLHttpRequestChangez() {
    if (HttpReq.readyState == 4 && HttpReq.status == 200){
        var result = HttpReq.responseXML;
        var opcoes = result.getElementsByTagName("nome");
        for (var i = 0; i < opcoes.length; i++) {
         idcampo = opcoes[i].getAttribute("id");
         valores = opcoes[i].childNodes[0].data;
         document.getElementById(idcampo).value = valores;
        }
    }
 }