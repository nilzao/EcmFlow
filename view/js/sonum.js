function so_numeroarg(e,args)
{		
	if (document.all){var evt=event.keyCode;} // caso seja IE
	else{var evt = e.charCode;}	// do contr�rio deve ser Mozilla
	var valid_chars = '0123456789'+args;	// criando a lista de teclas permitidas
	var chr= String.fromCharCode(evt);	// pegando a tecla digitada
	if (valid_chars.indexOf(chr)>-1 ){return true;}	// se a tecla estiver na lista de permiss�o permite-a
	// para permitir teclas como <BACKSPACE> adicionamos uma permiss�o para 
	// c�digos de tecla menores que 09 por exemplo (geralmente uso menores que 20)
	if (valid_chars.indexOf(chr)>-1 || evt < 9){return true;}	// se a tecla estiver na lista de permiss�o permite-a
	return false;	// do contr�rio nega
}

function so_numero(e)
{		
	if (document.all){var evt=event.keyCode;} // caso seja IE
	else{var evt = e.charCode;}	// do contr�rio deve ser Mozilla
	var valid_chars = '0123456789';	// criando a lista de teclas permitidas
	var chr= String.fromCharCode(evt);	// pegando a tecla digitada
	if (valid_chars.indexOf(chr)>-1 ){return true;}	// se a tecla estiver na lista de permiss�o permite-a
	// para permitir teclas como <BACKSPACE> adicionamos uma permiss�o para 
	// c�digos de tecla menores que 09 por exemplo (geralmente uso menores que 20)
	if (valid_chars.indexOf(chr)>-1 || evt < 9){return true;}	// se a tecla estiver na lista de permiss�o permite-a
	return false;	// do contr�rio nega
}
