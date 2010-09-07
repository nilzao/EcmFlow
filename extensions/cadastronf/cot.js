function ajaxCotacaoCli(str_parte){
    if (document.getElementById) {
    document.getElementById("div_find_cotacao_cli").innerHTML="";
    document.getElementById("div_find_cotacao_cli").style.display="block";
    url = "index.php?extdm=cadastronf&action=FornFindChar&nome=" + str_parte;
        if (window.XMLHttpRequest) {
            HttpReq = new XMLHttpRequest();
            HttpReq.onreadystatechange = ListaCotacaoCliRequest;
            HttpReq.open("GET", url, true);
            HttpReq.send(null);
        } else if (window.ActiveXObject) {
            HttpReq = new ActiveXObject("Microsoft.XMLHTTP");
            if (HttpReq) {
                HttpReq.onreadystatechange = ListaCotacaoCliRequest;
                HttpReq.open("GET", url, true);
                HttpReq.send();
            }
        }
    }
 }

 function ListaCotacaoCliRequest() {
    if (HttpReq.readyState == 4 && HttpReq.status == 200){
        var result = HttpReq.responseXML;
        var opcoes = result.getElementsByTagName("opcao");
        for (var i = 0; i < opcoes.length; i++) {
            var nome = opcoes[i].getElementsByTagName("nome");
            if (nome[0].childNodes[0] !=null){
                var divfilho = document.createElement("div");
                divfilho.innerHTML = nome[0].childNodes[0].data;
                divfilho.setAttribute("onclick", "setTexto(this.innerHTML);");
                divfilho.setAttribute("style", "cursor:pointer;");
                document.getElementById("div_find_cotacao_cli").appendChild(divfilho);
            }
        }
        var divfecha = document.createElement("div");
        divfecha.setAttribute("onclick", "fechaDivFindCli();");
        divfecha.setAttribute("style", "cursor:pointer;");
        divfecha.innerHTML = "<b>fechar</b>";
        document.getElementById("div_find_cotacao_cli").appendChild(divfecha);
    }
 }

 function setTexto(str_nome){
     document.getElementById("cotacao_cli").value=str_nome;
     fechaDivFindCli();
 }

 function fechaDivFindCli(){
     document.getElementById("div_find_cotacao_cli").style.display="none";
     document.getElementById("cotacao_cli").focus();
 }

 