function checkall(form, prefix) {
	for(var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if(e.name != 'chkall' && (!prefix || (prefix && e.name.match(prefix)))) {
			e.checked = form.chkall.checked;
		}
	}
}

function browserDetect(){
	var sUA = navigator.userAgent.toLowerCase();
	var sIE = sUA.indexOf("msie");
	var dzswera = sUA.indexOf("opera");
	var sMoz = sUA.indexOf("gecko");
	if (dzswera != -1) return "opera";
	if (sIE != -1){
		nIeVer = parseFloat(sUA.substr(sIE + 5));
		if (nIeVer >= 6) return "ie6";
		else if (nIeVer >= 5.5) return "ie55";
		else if (nIeVer >= 5 ) return "ie5";
	}
	if (sMoz != -1)	return "moz";
	return "other";
}

function browserNotice(){
	document.open();
	document.writeln('<table  border="0" cellspacing="1" cellpadding="4" width="100%" class="tablebordercolor">'); 
	document.writeln('<tr><td>NOTE: Now your browser is not IE, You will can not use WYWSING Editor.'); 
	document.writeln('</td></tr>'); 
	document.writeln('</table>'); 
	document.close();
}
