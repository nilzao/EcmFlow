function mask_data(strCampo, TeclaPres) {
	var tecla = TeclaPres.keyCode;
	var vr;
	var tam;
	vr = strCampo.value;
	vr = vr.replace(/\//gi, "");
	tam = vr.length;
	if (tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105) {
		if (tam <= 2) {
			strCampo.value = vr;
		}
		if ((tam > 2) && (tam <= 4)) {
			strCampo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2);
		}
		if ((tam > 4) && (tam <= 6)) {
			strCampo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/'
					+ vr.substr(4, 2);
		}
		if ((tam > 6)) {
			strCampo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/'
					+ vr.substr(4, 4);
		}
	}
}