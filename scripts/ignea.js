ujcso.sorszam = 1;
inithivas = false;
projektbetoltes = false;
projektklonozas = false;
var ehhezaproekthezkell;
var szamitas;

if (window.XMLHttpRequest) {
    xmlhttp_initprojekt = new XMLHttpRequest();
    xmlhttp_initfustjarat = new XMLHttpRequest();
    xmlhttp_projektek = new XMLHttpRequest();
    xmlhttp_fustjaratok = new XMLHttpRequest();
    xmlhttp_adattar = new XMLHttpRequest();
    xmlhttp_csakszamit = new XMLHttpRequest();
} else {
    xmlhttp_initprojekt = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp_initfustjarat = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp_projektek = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp_fustjaratok = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp_adattar = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp_csakszamit = new ActiveXObject("Microsoft.XMLHTTP");
}

function felugrik() {
    var lepedo = document.getElementById('lepedo');
    var felugro = document.getElementById('felugro');
    lepedo.style.visibility = "visible";
    felugro.style.visibility = "visible";
}

function eltunik() {
    var lepedo = document.getElementById('lepedo');
    var felugro = document.getElementById('felugro');
    lepedo.style.visibility = "hidden";
    felugro.style.visibility = "hidden";
}

function nyomtat() {
    window.open("print.php");
}

function projektlezaras() {
    
     kivanmindentoltve = true;
    
    if (document.getElementById("project_name").value.length == 0) { document.getElementById("project_name").style.background = 'yellow';  kivanmindentoltve = false; } else { project_name = document.getElementById("project_name").value; document.getElementById("project_name").style.background = 'white'; }
    cel = document.getElementById("cel").value;
    if (document.getElementById("ent_name").value.length == 0) { document.getElementById("ent_name").style.background = 'yellow'; kivanmindentoltve = false; } else { ent_name = document.getElementById("ent_name").value; document.getElementById("ent_name").style.background = 'white'; }
    if (document.getElementById("ent_addr_str").value.length == 0) { document.getElementById("ent_addr_str").style.background = 'yellow'; kivanmindentoltve = false; } else { ent_addr_str = document.getElementById("ent_addr_str").value; document.getElementById("ent_addr_str").style.background = 'white'; }
    if (document.getElementById("ent_addr_town").value.length == 0) { document.getElementById("ent_addr_town").style.background = 'yellow'; kivanmindentoltve = false; } else { ent_addr_town = document.getElementById("ent_addr_town").value; document.getElementById("ent_addr_town").style.background = 'white'; }
    if (document.getElementById("ent_addr_zip").value.length == 0) { document.getElementById("ent_addr_zip").style.background = 'yellow'; kivanmindentoltve = false; } else { ent_addr_zip = document.getElementById("ent_addr_zip").value; document.getElementById("ent_addr_zip").style.background = 'white'; }
    if (document.getElementById("ent_addr_country").value.length == 0) { document.getElementById("ent_addr_country").style.background = 'yellow'; kivanmindentoltve = false; } else { ent_addr_country = document.getElementById("ent_addr_country").value; document.getElementById("ent_addr_country").style.background = 'white'; }
    if (document.getElementById("ent_taxnum").value.length == 0) { document.getElementById("ent_taxnum").style.background = 'yellow'; kivanmindentoltve = false; } else { ent_taxnum = document.getElementById("ent_taxnum").value; document.getElementById("ent_taxnum").style.background = 'white'; }
    if (document.getElementById("cus_fullname").value.length == 0) { document.getElementById("cus_fullname").style.background = 'yellow'; kivanmindentoltve = false; } else { cus_fullname = document.getElementById("cus_fullname").value; document.getElementById("cus_fullname").style.background = 'white'; }
    if (document.getElementById("cus_phone_number").value.length == 0) { document.getElementById("cus_phone_number").style.background = 'yellow'; kivanmindentoltve = false; } else { cus_phone_number = document.getElementById("cus_phone_number").value; document.getElementById("cus_phone_number").style.background = 'white'; }
    if (document.getElementById("cus_addr_street").value.length == 0) { document.getElementById("cus_addr_street").style.background = 'yellow'; kivanmindentoltve = false; } else { cus_addr_street = document.getElementById("cus_addr_street").value; document.getElementById("cus_addr_street").style.background = 'white'; }
    if (document.getElementById("cus_addr_town").value.length == 0) { document.getElementById("cus_addr_town").style.background = 'yellow'; kivanmindentoltve = false; } else { cus_addr_town = document.getElementById("cus_addr_town").value; document.getElementById("cus_addr_town").style.background = 'white'; }
    if (document.getElementById("cus_addr_zip").value.length == 0) { document.getElementById("cus_addr_zip").style.background = 'yellow'; kivanmindentoltve = false; } else { cus_addr_zip = document.getElementById("cus_addr_zip").value; document.getElementById("cus_addr_zip").style.background = 'white'; }
    if (document.getElementById("cus_addr_country").value.length == 0) { document.getElementById("cus_addr_country").style.background = 'yellow'; kivanmindentoltve = false; } else { cus_addr_country = document.getElementById("cus_addr_country").value; document.getElementById("cus_addr_country").style.background = 'white'; }
    
    if (kivanmindentoltve) {
	xmlhttp_adattar.onreadystatechange = function() {
	    if (xmlhttp_adattar.readyState == 4 && xmlhttp_adattar.status == 200) {
		
		diplayprojektzaras = document.createTextNode(xmlhttp_adattar.responseText);
		while (adatstatusprojekt.hasChildNodes()) { adatstatusprojekt.removeChild(adatstatusprojekt.lastChild); }
		zold = document.createElement("div");
		zold.className = "zold";
		document.getElementById("adatstatusprojekt").appendChild(zold);
		zold.appendChild(diplayprojektzaras);
		
		document.location.reload(true);
	    }
	}
	var ezttaroldel =   "./kalyha.php?project_name=" + project_name +
			    "&cel=" + cel +
			    "&ent_name=" + ent_name +
			    "&ent_addr_str=" + ent_addr_str +
			    "&ent_addr_town=" + ent_addr_town +
			    "&ent_addr_zip=" + ent_addr_zip +
			    "&ent_addr_country=" + ent_addr_country +
			    "&ent_taxnum=" + ent_taxnum +
			    "&cus_fullname=" + cus_fullname +
			    "&cus_phone_number=" + cus_phone_number +
			    "&cus_addr_street=" + cus_addr_street +
			    "&cus_addr_town=" + cus_addr_town +
			    "&cus_addr_zip=" + cus_addr_zip +
			    "&cus_addr_country=" + cus_addr_country;
    
	xmlhttp_adattar.open("GET", ezttaroldel, true);
	xmlhttp_adattar.setRequestHeader('Content-Type', 'text/xml');
	xmlhttp_adattar.send(null);
	
	while (adatstatusprojekt.hasChildNodes()) { adatstatusprojekt.removeChild(adatstatusprojekt.lastChild); }
	szurke = document.createElement("div");
	szurke.className = "szurke";
	adattarolasprojektzaras = document.createTextNode("Closing project...");
	document.getElementById("adatstatusprojekt").appendChild(szurke);
	szurke.appendChild(adattarolasprojektzaras);
	
    }
}

function poti_yforg(fok) {
    controls.reset();
    foroghat = false;
    radian = fok * (Math.PI / 180);
    document.getElementById('szam_yforg').value = fok;
    camera.position.x = 8 * Math.cos(radian);
    camera.position.y = 1.75;
    camera.position.z = 8 * Math.sin(radian);
    var errenezz = new THREE.Vector3(0, 1.5, 0);
    camera.lookAt(errenezz);
    light.position = camera.position;
    renderer.render(scene, camera);
}

function szam_yforg(fok) {
    controls.reset();
    foroghat = false;
    radian = fok * (Math.PI / 180);
    document.getElementById('poti_yforg').value = fok;
    camera.position.x = 8 * Math.cos(radian);
    camera.position.y = 1.75;
    camera.position.z = 8 * Math.sin(radian);
    var errenezz = new THREE.Vector3(0, 1.5, 0);
    camera.lookAt(errenezz);
    light.position = camera.position;
    renderer.render(scene, camera);
}

function kapcs_drotrajz() {
    var melyik = document.getElementById('kapcs_drotrajz').value;
    if (melyik == 0) {
	materialtuzter.wireframe = materialcso.wireframe = false;
	for (i = 0; i < csomesh.length; i++) {
	    vonal[i].visible = false;
	    csomesh[i].visible = true;
	    vonaltukor[i].visible = false;
	    csomeshtukor[i].visible = true;
	}
	renderer.render(scene, camera);
    } else if (melyik == 1) {
	materialtuzter.wireframe = materialcso.wireframe = false;
	for (i = 0; i < csomesh.length; i++) {
	    vonal[i].visible = true;
	    csomesh[i].visible = false;
	    vonaltukor[i].visible = true;
	    csomeshtukor[i].visible = false;
	}
	renderer.render(scene, camera);
    } else {
	materialtuzter.wireframe = materialcso.wireframe = true;
	for (i = 0; i < csomesh.length; i++) {
	    vonal[i].visible = false;
	    csomesh[i].visible = true;
	    vonaltukor[i].visible = false;
	    csomeshtukor[i].visible = true;
	}
	renderer.render(scene, camera);
    }
}

function overkiir(melyiket) {
    eval("csomesh[" + melyiket + "]").visible = false;
    eval("csomeshover[" + melyiket + "]").visible = true;
    eval("csomeshtukor[" + melyiket + "]").visible = false;
    eval("csomeshovertukor[" + melyiket + "]").visible = true;
    renderer.render(scene, camera);
    eval("ujcsodiv" + melyiket).style.backgroundColor = '#6cf';
    
    if (dispable) {
	var balbal = document.getElementById("balbal");
	var baljobb = document.getElementById("baljobb");
	var jobbbal = document.getElementById("jobbbal");
	var jobbjobb = document.getElementById("jobbjobb");
	while (balbal.hasChildNodes()) { balbal.removeChild(balbal.lastChild); }
	while (baljobb.hasChildNodes()) { baljobb.removeChild(baljobb.lastChild); }
	while (jobbbal.hasChildNodes()) { jobbbal.removeChild(jobbbal.lastChild); }
	while (jobbjobb.hasChildNodes()) { jobbjobb.removeChild(jobbjobb.lastChild); }

	var szumnev = document.createTextNode("Effective height ");
	var szum = document.createTextNode(Math.round(h[melyiket] * Math.pow(10, 4)) / Math.pow(10, 4));
	var szumme = document.createTextNode(" m");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	balbal.appendChild(szumnev);
	baljobb.appendChild(szum);
	baljobb.appendChild(szumme);
	balbal.appendChild(brb);
	baljobb.appendChild(brj);

	var szumnev = document.createTextNode("Temp. at pipe start ");
	var szum = document.createTextNode(szamitas['szumszam']['tp'][melyiket]);
	var szumme = document.createTextNode(" °C");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	balbal.appendChild(szumnev);
	baljobb.appendChild(szum);
	baljobb.appendChild(szumme);
	balbal.appendChild(brb);
	baljobb.appendChild(brj);

	var szumnev = document.createTextNode("Temp. at mid pipe ");
	var szum = document.createTextNode(szamitas['szumszam']['ts'][melyiket]);
	var szumme = document.createTextNode(" °C");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	balbal.appendChild(szumnev);
	baljobb.appendChild(szum);
	baljobb.appendChild(szumme);
	balbal.appendChild(brb);
	baljobb.appendChild(brj);

	var szumnev = document.createTextNode("Dyn. pressure at pipe start ");
	var szum = document.createTextNode(szamitas['szumszam']['pdp'][melyiket]);
	var szumme = document.createTextNode(" Pa");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	balbal.appendChild(szumnev);
	baljobb.appendChild(szum);
	baljobb.appendChild(szumme);
	balbal.appendChild(brb);
	baljobb.appendChild(brj);

	var szumnev = document.createTextNode("Dyn. pressure at mid pipe ");
	var szum = document.createTextNode(szamitas['szumszam']['pds'][melyiket]);
	var szumme = document.createTextNode(" Pa");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	balbal.appendChild(szumnev);
	baljobb.appendChild(szum);
	baljobb.appendChild(szumme);
	balbal.appendChild(brb);
	baljobb.appendChild(brj);

	var szumnev = document.createTextNode("Zeta ζ ");
	var szum = document.createTextNode(szamitas['szumszam']['zeta'][melyiket]);
	var szumme = document.createTextNode("");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	balbal.appendChild(szumnev);
	baljobb.appendChild(szum);
	baljobb.appendChild(szumme);
	balbal.appendChild(brb);
	baljobb.appendChild(brj);

	var szumnev = document.createTextNode("Flue speed ");
	var szum = document.createTextNode(szamitas['szumszam']['vs'][melyiket]);
	var szumme = document.createTextNode(" m/s");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	jobbbal.appendChild(szumnev);
	jobbjobb.appendChild(szum);
	jobbjobb.appendChild(szumme);
	jobbbal.appendChild(brb);
	jobbjobb.appendChild(brj);

	var szumnev = document.createTextNode("Total static pressure ");
	var szum = document.createTextNode(szamitas['szumszam']['php'][melyiket]);
	var szumme = document.createTextNode(" Pa");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	jobbbal.appendChild(szumnev);
	jobbjobb.appendChild(szum);
	jobbjobb.appendChild(szumme);
	jobbbal.appendChild(brb);
	jobbjobb.appendChild(brj);

	var szumnev = document.createTextNode("Total frictional res. ");
	var szum = document.createTextNode(szamitas['szumszam']['pss'][melyiket]);
	var szumme = document.createTextNode(" Pa");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	jobbbal.appendChild(szumnev);
	jobbjobb.appendChild(szum);
	jobbjobb.appendChild(szumme);
	jobbbal.appendChild(brb);
	jobbjobb.appendChild(brj);

	var szumnev = document.createTextNode("Total formal res. ");
	var szum = document.createTextNode(szamitas['szumszam']['pap'][melyiket]);
	var szumme = document.createTextNode(" Pa");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	jobbbal.appendChild(szumnev);
	jobbjobb.appendChild(szum);
	jobbjobb.appendChild(szumme);
	jobbbal.appendChild(brb);
	jobbjobb.appendChild(brj);

	var szumnev = document.createTextNode("TOTAL DRAG ");
	var szum = document.createTextNode(Math.round((szamitas['szumszam']['pap'][melyiket] + szamitas['szumszam']['pss'][melyiket] + szamitas['szumszam']['php'][melyiket]) * Math.pow(10, 4)) / Math.pow(10, 4));
	var szumme = document.createTextNode(" Pa");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	jobbbal.appendChild(szumnev);
	jobbjobb.appendChild(szum);
	jobbjobb.appendChild(szumme);
	jobbbal.appendChild(brb);
	jobbjobb.appendChild(brj);
    }
}

function overtorol(melyiket) {
    eval("csomeshover[" + melyiket + "]").visible = false;
    eval("csomeshovertukor[" + melyiket + "]").visible = false;
    kapcs_drotrajz();
    eval("ujcsodiv" + melyiket).style.backgroundColor = '#fd9';
    if (dispable) {
        szumma();
    }
}

function szumma() {
    
    if (dispable) {
    
	var balbal = document.getElementById("balbal");
	var baljobb = document.getElementById("baljobb");
	var jobbbal = document.getElementById("jobbbal");
	var jobbjobb = document.getElementById("jobbjobb");
	while (balbal.hasChildNodes()) { balbal.removeChild(balbal.lastChild); }
	while (baljobb.hasChildNodes()) { baljobb.removeChild(baljobb.lastChild); }
	while (jobbbal.hasChildNodes()) { jobbbal.removeChild(jobbbal.lastChild); }
	while (jobbjobb.hasChildNodes()) { jobbjobb.removeChild(jobbjobb.lastChild); }

	var szumnev = document.createTextNode("Min total pipe length ");
	var szum = document.createTextNode(szamitas['szumma']['fustjarathossz']);
	var szumme = document.createTextNode(" m");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	balbal.appendChild(szumnev);
	baljobb.appendChild(szum);
	baljobb.appendChild(szumme);
	balbal.appendChild(brb);
	baljobb.appendChild(brj);

	var szumnev = document.createTextNode("Current pipe length ");
	var szum = document.createTextNode(szamitas['szumma']['jarathossz']);
	var szumme = document.createTextNode(" m");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	balbal.appendChild(szumnev);
	baljobb.appendChild(szum);
	baljobb.appendChild(szumme);
	balbal.appendChild(brb);
	baljobb.appendChild(brj);

	var szumnev = document.createTextNode("Exit temperature ");
	var szum = document.createTextNode(szamitas['szumma']['hom']);
	var szumme = document.createTextNode(" °C");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	balbal.appendChild(szumnev);
	baljobb.appendChild(szum);
	baljobb.appendChild(szumme);
	balbal.appendChild(brb);
	baljobb.appendChild(brj);

	var szumnev = document.createTextNode("Total static pressure ");
	var szum = document.createTextNode(szamitas['szumma']['ph']);
	var szumme = document.createTextNode(" Pa");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	balbal.appendChild(szumnev);
	baljobb.appendChild(szum);
	baljobb.appendChild(szumme);
	balbal.appendChild(brb);
	baljobb.appendChild(brj); 

	var szumnev = document.createTextNode("Total frictional res. ");
	var szum = document.createTextNode(szamitas['szumma']['ps']);
	var szumme = document.createTextNode(" Pa");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	balbal.appendChild(szumnev);
	baljobb.appendChild(szum);
	baljobb.appendChild(szumme);
	balbal.appendChild(brb);
	baljobb.appendChild(brj); 

	var szumnev = document.createTextNode("Total formal res. ");
	var szum = document.createTextNode(szamitas['szumma']['pa']);
	var szumme = document.createTextNode(" Pa");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	balbal.appendChild(szumnev);
	baljobb.appendChild(szum);
	baljobb.appendChild(szumme);
	balbal.appendChild(brb);
	baljobb.appendChild(brj);

	var szumnev = document.createTextNode("TOTAL DRAG ");
	var szum = document.createTextNode(szamitas['szumma']['ell']);
	var szumme = document.createTextNode(" Pa");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	balbal.appendChild(szumnev);
	baljobb.appendChild(szum);
	baljobb.appendChild(szumme);
	balbal.appendChild(brb);
	baljobb.appendChild(brj); 

	var szumnev = document.createTextNode("Stove efficiency ");
	var szum = document.createTextNode(szamitas['szumma']['hatasfok']);
	var szumme = document.createTextNode(" %");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	jobbbal.appendChild(szumnev);
	jobbjobb.appendChild(szum);
	jobbjobb.appendChild(szumme);
	jobbbal.appendChild(brb);
	jobbjobb.appendChild(brj);

	var szumnev = document.createTextNode("Air demand ");
	var szum = document.createTextNode(szamitas['szumma']['levego']);
	var szumme = document.createTextNode(" m3/s");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	jobbbal.appendChild(szumnev);
	jobbjobb.appendChild(szum);
	jobbjobb.appendChild(szumme);
	jobbbal.appendChild(brb);
	jobbjobb.appendChild(brj);

	var szumnev = document.createTextNode("Safety burn through ");
	var szum = document.createTextNode(Math.round(document.getElementById("fa").value * Math.pow(10, 4)) / Math.pow(10, 4));
	var szumme = document.createTextNode(" cm2");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	jobbbal.appendChild(szumnev);
	jobbjobb.appendChild(szum);
	jobbjobb.appendChild(szumme);
	jobbbal.appendChild(brb);
	jobbjobb.appendChild(brj);

	var szumnev = document.createTextNode("Max load ");
	var szum = document.createTextNode(Math.round(document.getElementById("fa").value * Math.pow(10, 4)) / Math.pow(10, 4));
	var szumme = document.createTextNode(" kg");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	jobbbal.appendChild(szumnev);
	jobbjobb.appendChild(szum);
	jobbjobb.appendChild(szumme);
	jobbbal.appendChild(brb);
	jobbjobb.appendChild(brj);

	var szumnev = document.createTextNode("Optimal load ");
	var szum = document.createTextNode(Math.round(document.getElementById("fa").value * .78 * Math.pow(10, 4)) / Math.pow(10, 4));
	var szumme = document.createTextNode(" kg");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	jobbbal.appendChild(szumnev);
	jobbjobb.appendChild(szum);
	jobbjobb.appendChild(szumme);
	jobbbal.appendChild(brb);
	jobbjobb.appendChild(brj);

	var szumnev = document.createTextNode("Min load ");
	var szum = document.createTextNode(Math.round(document.getElementById("fa").value * .5 * Math.pow(10, 4)) / Math.pow(10, 4));
	var szumme = document.createTextNode(" kg");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	jobbbal.appendChild(szumnev);
	jobbjobb.appendChild(szum);
	jobbjobb.appendChild(szumme);
	jobbbal.appendChild(brb);
	jobbjobb.appendChild(brj);

	var szumnev = document.createTextNode("Burning rate ");
	var szum = document.createTextNode(Math.round(document.getElementById("fa").value * .78 * Math.pow(10, 4)) / Math.pow(10, 4));
	var szumme = document.createTextNode(" kg/h");
	var brb = document.createElement("br");
	var brj = document.createElement("br");
	jobbbal.appendChild(szumnev);
	jobbjobb.appendChild(szum);
	jobbjobb.appendChild(szumme);
	jobbbal.appendChild(brb);
	jobbjobb.appendChild(brj);
    
    }
    
    warning();
}

function warning() {
    var warning = document.getElementById("warning");

    if (warning.hasChildNodes()) {
	while (warning.hasChildNodes()) { warning.removeChild(warning.lastChild); }
    }
    
    if (szamitas['szumma']['jarathossz'] < szamitas['szumma']['fustjarathossz']) {
	jaratrovid = document.createTextNode("Length of flue pipe system is " + szamitas['szumma']['jarathossz'] + " m, shorter than expected: " + szamitas['szumma']['fustjarathossz'] + " m!");
	piros = document.createElement("div");
	piros.className = "piros";
	document.getElementById("warning").appendChild(piros);
	piros.appendChild(jaratrovid);
    }
    
    if (document.getElementById("egyeniy").value < Number(document.getElementById("fa").value) + 25) {
	nemmagas = document.createTextNode("Height of combustion chamber is " + Math.round(document.getElementById("egyeniy").value * Math.pow(10, 2)) / Math.pow(10, 2) + " cm, smaller than expected: " + Math.round(Number(Number(document.getElementById("fa").value) + 25) * Math.pow(10, 2)) / Math.pow(10, 2) + " cm!");
	piros = document.createElement("div");
	piros.className = "piros";
	document.getElementById("warning").appendChild(piros);
	piros.appendChild(nemmagas);
    }
    
    if (document.getElementById("tuzalap").value < Number(document.getElementById("fa").value) * 100) {
	nemalap = document.createTextNode("Floor area of combustion chamber is " + Math.round(document.getElementById("tuzalap").value * Math.pow(10, 2)) / Math.pow(10, 2) + " cm2, smaller than expected: " + Math.round(Number(Number(document.getElementById("fa").value) * 100) * Math.pow(10, 2)) / Math.pow(10, 2) + " cm2!");
	piros = document.createElement("div");
	piros.className = "piros";
	document.getElementById("warning").appendChild(piros);
	piros.appendChild(nemalap);
    }
    
    if (document.getElementById("fa").value > 40) {
	nemalap = document.createTextNode("Maximum load is " + document.getElementById("fa").value + " kg, exceeds maximum: 40 kg!");
	piros = document.createElement("div");
	piros.className = "piros";
	document.getElementById("warning").appendChild(piros);
	piros.appendChild(nemalap);
    }
    
    var vspiroslo = [];
    var vspiroshi = [];
    var vssarga = [];
    
    for (i = 0; i < szamitas['szumszam']['vs'].length; i++) {
	if (szamitas['szumszam']['vs'][i] < 1.2) {
	    vspiroslo.push([i + 1]);
	} else if (szamitas['szumszam']['vs'][i] > 6) {
	    vspiroshi.push([i + 1]);
	} else if (szamitas['szumszam']['vs'][i] > 3.5) {
	    vssarga.push([i + 1]);
	}
    }
    
    if (vspiroslo.length > 0) {
	vspiroslotxt = document.createTextNode("Flue speed is too low in " + vspiroslo + ". pipe sections! Reduce relevant pipes' cross section!");
	piros = document.createElement("div");
	piros.className = "piros";
	document.getElementById("warning").appendChild(piros);
	piros.appendChild(vspiroslotxt);
    }
    
    if (vspiroshi.length > 0) {
	vspiroshitxt = document.createTextNode("Flue speed is too high in " + vspiroshi + ". pipe sections! Increase relevant pipes' cross section!");
	piros = document.createElement("div");
	piros.className = "piros";
	document.getElementById("warning").appendChild(piros);
	piros.appendChild(vspiroshitxt);
    }
    
    if (vssarga.length > 0) {
	vssargatxt = document.createTextNode("Flue speed might be too high in " + vssarga + ". pipe sections! You may increase relevant pipes' cross section!");
	sarga = document.createElement("div");
	sarga.className = "sarga";
	document.getElementById("warning").appendChild(sarga);
	sarga.appendChild(vssargatxt);
    }
    
    if (szamitas['szumma']['hatasfok'] < 78) {
	nemhatekony = document.createTextNode("Efficiency is " + szamitas['szumma']['hatasfok'] + " %, the expected minimum is 78 %!");
	sarga = document.createElement("div");
	sarga.className = "sarga";
	document.getElementById("warning").appendChild(sarga);
	sarga.appendChild(nemhatekony);
    }
    
    if (szamitas['szumma']['ell'] < document.getElementById("resmin").value) {
	resmin = document.createTextNode("Total drag is less than the expected minimum!");
	sarga = document.createElement("div");
	sarga.className = "sarga";
	document.getElementById("warning").appendChild(sarga);
	sarga.appendChild(resmin);
    }
    
    if (szamitas['szumma']['ell'] > document.getElementById("resmax").value) {
	resmin = document.createTextNode("Total drag is more than the expected maximum!");
	sarga = document.createElement("div");
	sarga.className = "sarga";
	document.getElementById("warning").appendChild(sarga);
	sarga.appendChild(resmin);
    }
    
}

function gombclear() {
    document.getElementById("ora").disabled = false;
    document.getElementById("gomb_ora").checked = false;
    document.getElementById("fa").disabled = false;
    document.getElementById("gomb_fa").checked = false;
    document.getElementById("kw").disabled = false;
    document.getElementById("gomb_kw").checked = false;
    document.getElementById("kilepomagas").disabled = true;
    document.getElementById("csotorles").disabled = true;
}

function gombinit() {
    document.getElementById("ora").disabled = false;
    document.getElementById("gomb_ora").checked = false;
    document.getElementById("fa").disabled = false;
    document.getElementById("gomb_fa").checked = false;
    document.getElementById("kw").disabled = true;
    document.getElementById("gomb_kw").checked = true;
    document.getElementById("kilepomagas").disabled = true;
    document.getElementById("csotorles").disabled = true;
}

function gomboraklikk() {
    document.getElementById("ora").disabled = true;
    document.getElementById("gomb_ora").checked = true;
    document.getElementById("fa").disabled = false;
    document.getElementById("gomb_fa").checked = false;
    document.getElementById("kw").disabled = false;
    document.getElementById("gomb_kw").checked = false;
    document.getElementById("gomb").value = 1;
    csovek3d();
}

function gombfaklikk() {
    document.getElementById("ora").disabled = false;
    document.getElementById("gomb_ora").checked = false;
    document.getElementById("fa").disabled = true;
    document.getElementById("gomb_fa").checked = true;
    document.getElementById("kw").disabled = false;
    document.getElementById("gomb_kw").checked = false;
    document.getElementById("gomb").value = 2;
    csovek3d();
}

function gombkwklikk() {
    document.getElementById("ora").disabled = false;
    document.getElementById("gomb_ora").checked = false;
    document.getElementById("fa").disabled = false;
    document.getElementById("gomb_fa").checked = false;
    document.getElementById("kw").disabled = true;
    document.getElementById("gomb_kw").checked = true;
    document.getElementById("gomb").value = 3;
    csovek3d();
}

function validalas(ertek, min, max) {
    if (ertek >= min && ertek <= max) {
	return true;
    } else {
	return false;
    }
}

function valtozora(ora) {
    if (validalas(ora, 1, 24)) {
	document.getElementById("ora").style.background = 'white';
	if (document.getElementById("kw").disabled) {
	    document.getElementById("kw").value = document.getElementById("fa").value * 3.25 / ora;
	    frissit();
	} else {
	    document.getElementById("fa").value = ora * document.getElementById("kw").value / 3.25;
	    document.getElementById("tuzfelcheck").checked = true;
	    tuzfelcheck(true);
	    frissit();
	}
    } else {
	document.getElementById("ora").style.background = 'yellow';
	document.getElementById("ora").value = 1;
    }
}

function valtozfa(fa) {
    if (!fa) {
	fa = document.getElementById("fa").value;
    }
    if (validalas(fa, 1, 999)) {
	document.getElementById("fa").style.background = 'white';
	if (document.getElementById("ora").disabled) {
	    document.getElementById("ora").value = fa* 3.25 / document.getElementById("kw").value;
	    document.getElementById("tuzfelcheck").checked = true;
	    frissit();
	} else {
	    document.getElementById("kw").value = fa * 3.25 / document.getElementById("ora").value;
	    document.getElementById("tuzfelcheck").checked = true;
	    frissit();
	}
    } else {
	document.getElementById("fa").style.background = 'yellow';
	document.getElementById("fa").value = 1;
    }
}

function valtozkw(kw) {
    if (validalas(kw, 1, 99)) {
	document.getElementById("kw").style.background = 'white';
	if (document.getElementById("ora").disabled) {
	    document.getElementById("ora").value = document.getElementById("fa").value * 3.25 / kw;
	    frissit();
	} else {
	    document.getElementById("fa").value = document.getElementById("ora").value * kw / 3.25;
	    document.getElementById("tuzfelcheck").checked = true;
	    tuzfelcheck(true);
	    frissit();
	}
    } else {
	document.getElementById("kw").style.background = 'yellow';
	document.getElementById("kw").value = 1;
    }
}

function tuzfelcheck(namivan) {
    if (namivan) {
	document.getElementById("tuzfel").disabled = false;
	document.getElementById("egyeniy").disabled = false;
    } else {
	document.getElementById("tuzfel").disabled = true;
	if (document.getElementById("tuzalap").disabled) {
	    document.getElementById("egyeniy").disabled = true;
	} else {
	    document.getElementById("egyeniy").disabled = false;
	}
    }
    csovek3d();
}

function tuzalapcheck(namivan) {
    if (namivan) {
	document.getElementById("tuzalap").disabled = false;
	document.getElementById("egyeniy").disabled = false;
    } else {
	document.getElementById("tuzalap").disabled = true;
	if (document.getElementById("tuzfel").disabled) {
	    document.getElementById("egyeniy").disabled = true;
	} else {
	    document.getElementById("egyeniy").disabled = false;
	}
    }
    csovek3d();
}

function egyeniy(y) {
    if (y < 10) {
	document.getElementById("egyeniy").style.background = 'yellow';	
	document.getElementById("egyeniy").value = 10;
	y = 10;
    } else if (!validalas(y, Number(document.getElementById("fa").value) + 25, 200)) {
	document.getElementById("egyeniy").style.background = 'yellow';	
    } else {
	document.getElementById("egyeniy").style.background = 'white';
    }
    if (document.getElementById("tuzfelcheck").checked) {
	    var x = document.getElementById("egyenix").value;
	    var z = document.getElementById("egyeniz").value;
	    var tuzfel = document.getElementById("tuzfel").value = ((x * y) + (x * z) + (y * z)) * 2;
	    document.getElementById("fa").value = tuzfel / 900;
	    if (document.getElementById("kilepo").value == "0") {
		    document.getElementById("kilepomagas").value = y;
	    }
	    tuztermesh.scale.y = y / arany;
	    valtoztuzfel();
    } else {
	    var tuzalap = document.getElementById("tuzalap").value = Math.pow((- 2 * y + Math.sqrt(4 * Math.pow(y, 2) + 4 * (document.getElementById("tuzfel").value / 2))) / 2, 2);
	    var xzarany = document.getElementById("egyenix").value / document.getElementById("egyeniz").value;
	    x = document.getElementById("egyenix").value = Math.sqrt(tuzalap * xzarany);
	    z = document.getElementById("egyeniz").value = Math.sqrt(tuzalap / xzarany);
	    tuztermesh.scale.x = x / arany;
	    tuztermesh.scale.z = z / arany;
	    tuztermesh.scale.y = y / arany;
	    kilepooldal();
    }
}

function egyenix(x) {
    if (validalas(x, 5, 200)) {
	document.getElementById("egyenix").style.background = 'white';
	if (!document.getElementById("tuzalapcheck").checked) {
		var tuzalap = document.getElementById("tuzalap").value;
		var z = document.getElementById("egyeniz").value = tuzalap / x;
		tuztermesh.scale.x = x / arany;
		tuztermesh.scale.z = z / arany;
		kilepooldal();
	} else if (document.getElementById("tuzfelcheck").checked) {
		var tuzalap = document.getElementById("tuzalap").value = x * document.getElementById("egyeniz").value;
		var tuzfel = document.getElementById("tuzfel").value = tuzalap * 2 + document.getElementById("egyeniy").value * document.getElementById("egyenix").value * 2 
		+ document.getElementById("egyeniy").value * document.getElementById("egyeniz").value * 2;
		document.getElementById("fa").value = tuzfel / 900;
		tuztermesh.scale.x = x / arany;
		valtoztuzfel();
	} else {
		var tuzalap = document.getElementById("tuzalap").value = x * document.getElementById("egyeniz").value;
		y = document.getElementById("egyeniy").value = ((document.getElementById("tuzfel").value / 2) - tuzalap) / (eval(document.getElementById("egyenix").value) + eval(document.getElementById("egyeniz").value));
		tuztermesh.scale.y = y / arany;
		tuztermesh.scale.x = x / arany;
		kilepooldal();
	}
    } else {
	document.getElementById("egyenix").style.background = 'yellow';
	document.getElementById("egyenix").value = 5;
    }	
}

function egyeniz(z) {
    if (validalas(z, 5, 200)) {
	document.getElementById("egyeniz").style.background = 'white';
	if (!document.getElementById("tuzalapcheck").checked) {
		var tuzalap = document.getElementById("tuzalap").value;
		var x = document.getElementById("egyenix").value = tuzalap / z;
		tuztermesh.scale.x = x / arany;
		tuztermesh.scale.z = z / arany;
		kilepooldal();
	} else if (document.getElementById("tuzfelcheck").checked) {
		var tuzalap = document.getElementById("tuzalap").value = z * document.getElementById("egyenix").value;
		var tuzfel = document.getElementById("tuzfel").value = tuzalap * 2 + document.getElementById("egyeniy").value * document.getElementById("egyenix").value * 2 
		+ document.getElementById("egyeniy").value * document.getElementById("egyeniz").value * 2;
		document.getElementById("fa").value = tuzfel / 900;
		tuztermesh.scale.z = z / arany;
		valtoztuzfel();
	} else {
		var tuzalap = document.getElementById("tuzalap").value = z * document.getElementById("egyenix").value;
		y = document.getElementById("egyeniy").value = ((document.getElementById("tuzfel").value / 2) - tuzalap) / (eval(document.getElementById("egyenix").value) + eval(document.getElementById("egyeniz").value));
		tuztermesh.scale.y = y / arany;
		tuztermesh.scale.z = z / arany;
		kilepooldal();
	}
    } else {
	document.getElementById("egyeniz").style.background = 'yellow';
	document.getElementById("egyeniz").value = 5;
    }	
}

function valtoztuzalap (tuzalap) {
    if (validalas(tuzalap, 100, 9999999)) {
	document.getElementById("tuzalap").style.background = 'white';
	if (document.getElementById("tuzfelcheck").checked) {
		var xzarany = document.getElementById("egyenix").value / document.getElementById("egyeniz").value;
		x = document.getElementById("egyenix").value = Math.sqrt(tuzalap * xzarany);
		z = document.getElementById("egyeniz").value = Math.sqrt(tuzalap / xzarany);
		tuztermesh.scale.x = x / arany;
		tuztermesh.scale.z = z / arany;
		var tuzfel = document.getElementById("tuzfel").value = tuzalap * 2 + document.getElementById("egyeniy").value * document.getElementById("egyenix").value * 2 
		+ document.getElementById("egyeniy").value * document.getElementById("egyeniz").value * 2;
		document.getElementById("fa").value = tuzfel / 900;
		valtoztuzfel();
	} else {
		var xzarany = document.getElementById("egyenix").value / document.getElementById("egyeniz").value;
		x = document.getElementById("egyenix").value = Math.sqrt(tuzalap * xzarany);
		z = document.getElementById("egyeniz").value = Math.sqrt(tuzalap / xzarany);
		y = document.getElementById("egyeniy").value = ((document.getElementById("tuzfel").value / 2) - tuzalap) / (eval(document.getElementById("egyenix").value) + eval(document.getElementById("egyeniz").value));
		tuztermesh.scale.x = x / arany;
		tuztermesh.scale.z = z / arany;
		tuztermesh.scale.y = y / arany;
		kilepooldal();
	}
    } else {
	document.getElementById("tuzalap").style.background = 'yellow';
	document.getElementById("tuzalap").value = 100;
    }	
}

function valtoztuzfel (tuzfel) {
    if (!tuzfel) {
	tuzfel = document.getElementById("tuzfel").value;
    }
    if (validalas(tuzfel, Number(document.getElementById("fa").value) * 900, 99999999)) {
	document.getElementById("tuzfel").style.background = 'white';
	if (document.getElementById("tuzalapcheck").checked) {
		regi = document.getElementById("fa").value * 900;
		document.getElementById("fa").value = tuzfel / 900;
		var tuzfelvaltoz = tuzfel / regi;
		x = document.getElementById("egyenix").value = Math.sqrt(tuzfelvaltoz) * document.getElementById("egyenix").value;
		z = document.getElementById("egyeniz").value = Math.sqrt(tuzfelvaltoz) * document.getElementById("egyeniz").value;
		y = document.getElementById("egyeniy").value = Math.sqrt(tuzfelvaltoz) * document.getElementById("egyeniy").value;
		document.getElementById("tuzalap").value = x * z;
		tuztermesh.scale.x = x / arany;
		tuztermesh.scale.y = y / arany;
		tuztermesh.scale.z = z / arany;
	} else {
		fa = document.getElementById("fa").value = tuzfel / 900;
		y = document.getElementById("egyeniy").value = (tuzfel / 2 - document.getElementById("tuzalap").value) / (eval(document.getElementById("egyenix").value) + eval(document.getElementById("egyeniz").value));
		tuztermesh.scale.y = y / arany;
	}
	valtozfa();
    } else {
	document.getElementById("tuzfel").style.background = 'yellow';
	document.getElementById("tuzfel").value = Number(document.getElementById("fa").value) * 900;
    }
}

function frissittuzfel(tuzfel, regi) {
    if (document.getElementById("tuzalapcheck").checked) {
	var tuzfelvaltoz = tuzfel / regi;
	x = document.getElementById("egyenix").value = Math.sqrt(tuzfelvaltoz) * document.getElementById("egyenix").value;
	z = document.getElementById("egyeniz").value = Math.sqrt(tuzfelvaltoz) * document.getElementById("egyeniz").value;
	y = document.getElementById("egyeniy").value = Math.sqrt(tuzfelvaltoz) * document.getElementById("egyeniy").value;
	document.getElementById("tuzalap").value = x * z;
	tuztermesh.scale.x = x / arany;
	tuztermesh.scale.y = y / arany;
	tuztermesh.scale.z = z / arany;
    } else {
	y = document.getElementById("egyeniy").value = (tuzfel / 2 - document.getElementById("tuzalap").value) / (eval(document.getElementById("egyenix").value) + eval(document.getElementById("egyeniz").value));
	tuztermesh.scale.y = y / arany;
    }
    kilepooldal();
}

function frissit() {
    var regi = document.getElementById("tuzfel").value;
    var tuzfel = document.getElementById("tuzfel").value = document.getElementById("fa").value * 900;
    frissittuzfel(tuzfel, regi);
}

function vanemarkalyhaja(ezt) {
    xmlhttp_initprojekt.onreadystatechange = function() {
	if (xmlhttp_initprojekt.readyState == 4 && xmlhttp_initprojekt.status == 200) {
	    var ezjottvissza = xmlhttp_initprojekt.responseText;
	    if (ezjottvissza == "nincs") {
		init();
	    } else {
		var adat = JSON.parse(ezjottvissza);
		document.getElementById("ora").value = Number(adat.ora);
		document.getElementById("fa").value = Number(adat.fa);
		document.getElementById("kw").value = Number(adat.kw);
		if (adat.gomb == "1") {
		    document.getElementById("gomb_ora").checked = true;
		    document.getElementById("ora").disabled = true;
		} else if (adat.gomb == "2") {
		    document.getElementById("gomb_fa").checked = true;
		    document.getElementById("fa").disabled = true;
		} else if (adat.gomb == "3") {
		    document.getElementById("gomb_kw").checked = true;
		    document.getElementById("kw").disabled = true;
		}
		document.getElementById("tuzfel").value = Number(adat.tuzfel);
		if (adat.tfc != "1") {
		    document.getElementById("tuzfelcheck").checked = false;
		    document.getElementById("tuzfel").disabled = true;
		} else {
		    document.getElementById("tuzfelcheck").checked = true;
		    document.getElementById("tuzfel").disabled = false;
		}
		document.getElementById("egyeniy").value = Number(adat.egyeniy);
		document.getElementById("tuzalap").value = Number(adat.tuzalap);
		if (adat.tac != "1") {
		    document.getElementById("tuzalapcheck").checked = false;
		    document.getElementById("tuzalap").disabled = true;
		} else {
		    document.getElementById("tuzalapcheck").checked = true;
		    document.getElementById("tuzalap").disabled = false;
		}
		if (adat.tfc != "1" && adat.tac != "1") {
		    document.getElementById("egyeniy").disabled = true;
		} else {
		    document.getElementById("egyeniy").disabled = false;
		}
		document.getElementById("egyenix").value = Number(adat.egyenix);
		document.getElementById("egyeniz").value = Number(adat.egyeniz);
		document.getElementById("elevacio").value = Number(adat.elevacio);
		document.getElementById("levegohom").value = Number(adat.levegohom);
		document.getElementById("kalyhahej").value = Number(adat.kalyhahej);
		document.getElementById("resmin").value = Number(adat.resmin);
		document.getElementById("resmax").value = Number(adat.resmax);
		document.getElementById("kilepo").value = Number(adat.kilepo);
		if (adat.ag != "1") {
		    document.getElementById("elag0").checked = false;
		} else {
		    document.getElementById("elag0").checked = true;
		}
		document.getElementById("kileposzeles").value = Number(adat.kileposzeles);
		document.getElementById("kilepomely").value = Number(adat.kilepomely);
		document.getElementById("kilepomagas").value = Number(adat.kilepomagas);
		document.getElementById("csox0").value = Number(adat.csox);
		document.getElementById("csoy0").value = Number(adat.csoy);
		document.getElementById("csoz0").value = Number(adat.csoz);
		document.getElementById("csoanyag0").value = Number(adat.csoanyag);
		
		tuztermesh.scale.x = Number(adat.egyenix) / arany;
		tuztermesh.scale.y = Number(adat.egyeniy) / arany;
		tuztermesh.scale.z = Number(adat.egyeniz) / arany;
		
		if (projektbetoltes) {
		    document.getElementById("project_name").value = adat.project_name;
		    document.getElementById("cel").value = adat.cel;
		    document.getElementById("ent_name").value = adat.ent_name;
		    document.getElementById("ent_addr_str").value = adat.ent_addr_str;
		    document.getElementById("ent_addr_town").value = adat.ent_addr_town;
		    document.getElementById("ent_addr_zip").value = adat.ent_addr_zip;
		    document.getElementById("ent_addr_country").value = adat.ent_addr_country;
		    document.getElementById("ent_taxnum").value = adat.ent_taxnum;
		    document.getElementById("cus_fullname").value = adat.cus_fullname;
		    document.getElementById("cus_phone_number").value = adat.cus_phone_number;
		    document.getElementById("cus_addr_street").value = adat.cus_addr_street;
		    document.getElementById("cus_addr_town").value = adat.cus_addr_town;
		    document.getElementById("cus_addr_zip").value = adat.cus_addr_zip;
		    document.getElementById("cus_addr_country").value = adat.cus_addr_country;
		    document.getElementById("project_name").style.background = 'white';
		    document.getElementById("ent_name").style.background = 'white';
		    document.getElementById("ent_addr_str").style.background = 'white';
		    document.getElementById("ent_addr_town").style.background = 'white';
		    document.getElementById("ent_addr_zip").style.background = 'white';
		    document.getElementById("ent_addr_country").style.background = 'white';
		    document.getElementById("ent_taxnum").style.background = 'white';
		    document.getElementById("cus_fullname").style.background = 'white';
		    document.getElementById("cus_phone_number").style.background = 'white';
		    document.getElementById("cus_addr_street").style.background = 'white';
		    document.getElementById("cus_addr_town").style.background = 'white';
		    document.getElementById("cus_addr_zip").style.background = 'white';
		    document.getElementById("cus_addr_country").style.background = 'white';
		}
		while (adatstatusprojekt.hasChildNodes()) { adatstatusprojekt.removeChild(adatstatusprojekt.lastChild); }
		adattarolasprojekt = document.createTextNode("Combustion chamber is loaded!");
		zold = document.createElement("div");
		zold.className = "zold";
		document.getElementById("adatstatusprojekt").appendChild(zold);
		zold.appendChild(adattarolasprojekt);
		inithivas = true;
		kilepooldal();
	    }
	}
    }
    if (!ezt) {
	ezt = 0;
    } else {
	projektbetoltes = true;
	ehhezaproekthezkell = ezt;
	gombclear();
	while (adatstatusprojekt.hasChildNodes()) { adatstatusprojekt.removeChild(adatstatusprojekt.lastChild); }
	szurke = document.createElement("div");
	szurke.className = "szurke";
	adattarolasprojekt = document.createTextNode("Loading combustion chamber...");
	document.getElementById("adatstatusprojekt").appendChild(szurke);
	szurke.appendChild(adattarolasprojekt);
    }
    xmlhttp_initprojekt.open("GET", "./kalyha.php?vanemar=" + ezt, true);
    xmlhttp_initprojekt.setRequestHeader('Content-Type', 'text/xml');
    xmlhttp_initprojekt.send(null);
}

function vanemarfustjarata() {
    xmlhttp_initfustjarat.onreadystatechange = function() {
	if (xmlhttp_initfustjarat.readyState == 4 && xmlhttp_initfustjarat.status == 200) {
	    var ezjottvisszafust = xmlhttp_initfustjarat.responseText;
	    
	    if (ezjottvisszafust == "nincs") {

		while (adatstatusfust.hasChildNodes()) { adatstatusfust.removeChild(adatstatusfust.lastChild); }
		szurke = document.createElement("div");
		szurke.className = "szurke";
		nincsmegfustje = document.createTextNode("No flue pipes yet...");
		document.getElementById("adatstatusfust").appendChild(szurke);
		szurke.appendChild(nincsmegfustje);

	    } else {
		var adat = JSON.parse(ezjottvisszafust);
		
		var i = 0;
		var egyenkentkell = function(ezazarray) {
		    ujcsoinit(ezazarray[i], function() {
			i++;
			if (i < ezazarray.length) {
			    egyenkentkell(ezazarray);
			}
		    });
		}
		egyenkentkell(adat);
		document.getElementById("projektzaras").disabled = false;
	    }
	    inithivas = false;
	    if (projektbetoltes) {
		document.getElementById("ora").disabled = true;
		document.getElementById("gomb_ora").disabled = true;
		document.getElementById("fa").disabled = true;
		document.getElementById("gomb_fa").disabled = true;
		document.getElementById("kw").disabled = true;
		document.getElementById("gomb_kw").disabled = true;
		document.getElementById("tuzfel").disabled = true;
		document.getElementById("tuzfelcheck").disabled = true;
		document.getElementById("egyeniy").disabled = true;
		document.getElementById("tuzalap").disabled = true;
		document.getElementById("tuzalapcheck").disabled = true;
		document.getElementById("egyenix").disabled = true;
		document.getElementById("egyeniz").disabled = true;
		document.getElementById("elevacio").disabled = true;
		document.getElementById("levegohom").disabled = true;
		document.getElementById("kalyhahej").disabled = true;
		document.getElementById("resmin").disabled = true;
		document.getElementById("resmax").disabled = true;
		document.getElementById("kozepre").disabled = true;
		document.getElementById("kileposzeles").disabled = true;
		document.getElementById("kilepomely").disabled = true;
		document.getElementById("kilepomagas").disabled = true;
		document.getElementById("csox0").disabled = true;
		document.getElementById("csoy0").disabled = true;
		document.getElementById("csoz0").disabled = true;
		document.getElementById("csoanyag0").disabled = true;
		document.getElementById("csotorles").disabled = true;
		document.getElementById("jarathozzaadas").disabled = true;
		for (i = 1; i < csomesh.length; i++) {
		    document.getElementById("elag" + i).disabled = true;
		    document.getElementById("fugg" + i).disabled = true;
		    document.getElementById("fuggnum" + i).disabled = true;
		    document.getElementById("viz" + i).disabled = true;
		    document.getElementById("viznum" + i).disabled = true;
		    document.getElementById("csox" + i).disabled = true;
		    document.getElementById("csoy" + i).disabled = true;
		    document.getElementById("csoz" + i).disabled = true;
		    document.getElementById("csoanyag" + i).disabled = true;
		}
		document.getElementById("project_name").disabled = true;
		document.getElementById("cel").disabled = true;
		document.getElementById("ent_name").disabled = true;
		document.getElementById("ent_addr_str").disabled = true;
		document.getElementById("ent_addr_town").disabled = true;
		document.getElementById("ent_addr_zip").disabled = true;
		document.getElementById("ent_addr_country").disabled = true;
		document.getElementById("ent_taxnum").disabled = true;
		document.getElementById("cus_fullname").disabled = true;
		document.getElementById("cus_phone_number").disabled = true;
		document.getElementById("cus_addr_street").disabled = true;
		document.getElementById("cus_addr_town").disabled = true;
		document.getElementById("cus_addr_zip").disabled = true;
		document.getElementById("cus_addr_country").disabled = true;
		document.getElementById("projektzaras").disabled = true;
		document.getElementById("projzar").disabled = true;
		
		document.getElementById("projektklonozas").disabled = false;
		document.getElementById("info").disabled = false;
		document.getElementById("projektnyomtatas").disabled = false;
		projektbetoltes = false;
		csakszamit();
	    } else {
		kilepooldal();
	    }
	}
    }
    if (!projektbetoltes) {
	ehhezaproekthezkell = 0;
    } else {
	while (csomesh.length > 1) {
	    ujcso(false);
	}
	while (adatstatusfust.hasChildNodes()) { adatstatusfust.removeChild(adatstatusfust.lastChild); }
	szurke = document.createElement("div");
	szurke.className = "szurke";
	fustjaratbetolt = document.createTextNode("Loading flue pipes...");
	document.getElementById("adatstatusfust").appendChild(szurke);
	szurke.appendChild(fustjaratbetolt);
    }
    xmlhttp_initfustjarat.open("GET", "./kalyha.php?vanemarfust=" + ehhezaproekthezkell, true);
    xmlhttp_initfustjarat.setRequestHeader('Content-Type', 'text/xml');
    xmlhttp_initfustjarat.send(null);
}

function csakszamit() {
    xmlhttp_csakszamit.onreadystatechange = function() {
	if (xmlhttp_csakszamit.readyState == 4 && xmlhttp_csakszamit.status == 200) {
		ezjottvissza = xmlhttp_csakszamit.responseText;
		szamitas = JSON.parse(ezjottvissza);
		diplayfustjaratok = document.createTextNode("Calculations are loaded!");
		while (adatstatusfust.hasChildNodes()) { adatstatusfust.removeChild(adatstatusfust.lastChild); }
		zold = document.createElement("div");
		zold.className = "zold";
		document.getElementById("adatstatusfust").appendChild(zold);
		zold.appendChild(diplayfustjaratok);
		/////////
		szumma();
		/////////
	    }
	}

	var fj = new Object();
	fj.ag = [];
	fj.fugg = [];
	fj.viz = [];
	fj.csox = [];
	fj.csoy = [];
	fj.csoz = [];
	fj.csoanyag = [];
	fj.phi = [];
	fj.h = [];

	for (i = 1; i < csomesh.length; i++) {
	    im1 = i - 1;
	    if (document.getElementById("elag" + i).checked) { fj.ag[im1] = 1; } else { fj.ag[im1] = 0; }
	    fj.fugg[im1] = Number(document.getElementById("fuggnum" + i).value);
	    fj.viz[im1] = Number(document.getElementById("viznum" + i).value);
	    fj.csox[im1] = Number(document.getElementById("csox" + i).value);
	    fj.csoy[im1] = Number(document.getElementById("csoy" + i).value);
	    fj.csoz[im1] = Number(document.getElementById("csoz" + i).value);
	    fj.csoanyag[im1] = Number(document.getElementById("csoanyag" + i).value);
	    fj.phi[im1] = kerekit(phi[i]);
	    fj.h[im1] = kerekit(h[i]);
	}
	var eztistaroldel = "ehhez=" + ehhezaproekthezkell + "&csakszamit=" + JSON.stringify(fj);

	xmlhttp_csakszamit.open("POST", "./kalyha.php", true);
	xmlhttp_csakszamit.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp_csakszamit.send(eztistaroldel);
	
	while (adatstatusfust.hasChildNodes()) { adatstatusfust.removeChild(adatstatusfust.lastChild); }
	szurke = document.createElement("div");
	szurke.className = "szurke";
	adattarolasfust = document.createTextNode("Loading calculations...");
	document.getElementById("adatstatusfust").appendChild(szurke);
	szurke.appendChild(adattarolasfust);
}

function init() {
    
    gombinit();
 
    var tuzfel = document.getElementById("tuzfel").value = document.getElementById("fa").value * 900;

    var tuzalap = document.getElementById("fa").value * 100;
    document.getElementById("tuzalap").value = tuzalap;

    var hossz = Math.sqrt(tuzalap);
    document.getElementById("egyenix").value = document.getElementById("egyeniz").value = hossz;

    var magassag = (tuzfel - 2 * tuzalap) / (hossz * 4);
    document.getElementById("egyeniy").value = magassag;

    var alapxz = hossz / arany;
    var alapy = magassag / arany;
    tuztermesh.scale.x = alapxz;
    tuztermesh.scale.y = alapy;
    tuztermesh.scale.z = alapxz;

    document.getElementById("kilepomagas").value = magassag;

    kapcs_drotrajz();
    kilepooldal();
}

function kilepooldal(ertek) {

    if (!ertek) {
	var ertek = document.getElementById("kilepo").value;
    }
    if (ertek == 0) {
	document.getElementById("kileposzeles").disabled = false;
	document.getElementById("kilepomagas").disabled = true;
	document.getElementById("kilepomely").disabled = false;
	document.getElementById("kilepomagas").value = document.getElementById("egyeniy").value;
    } else if (ertek == 1 || ertek == 2 || ertek == 4) {
	document.getElementById("kileposzeles").disabled = true;
	document.getElementById("kilepomagas").disabled = true;
	document.getElementById("kilepomely").disabled = false;
	document.getElementById("kilepomagas").value = document.getElementById("kilepomagas").max = (document.getElementById("egyeniy").value / arany - csomesh[0].scale.y / 2) * arany;
    } else {
	document.getElementById("kileposzeles").disabled = false;
	document.getElementById("kilepomagas").disabled = true;
	document.getElementById("kilepomely").disabled = true;
	document.getElementById("kilepomagas").value = document.getElementById("kilepomagas").max = (document.getElementById("egyeniy").value / arany - csomesh[0].scale.y / 2) * arany;
    }
    csocs();
}

var h = [];
var phi = [];

var d1 = [];
var d2 = [];
var v1 = [];
var v2 = [];
d1[0] = new THREE.Vector3();
d2[0] = new THREE.Vector3();

var dt1 = [];
var dt2 = [];
var vt1 = [];
var vt2 = [];
dt1[0] = new THREE.Vector3();
dt2[0] = new THREE.Vector3();

var szog90 = false;
var szog180 = false;

function csovek3d() {
    if (document.getElementById("elag0").checked) {
	document.getElementById("ora").disabled = true;
	document.getElementById("gomb_ora").disabled = true;
	document.getElementById("fa").disabled = true;
	document.getElementById("gomb_fa").disabled = true;
	document.getElementById("kw").disabled = true;
	document.getElementById("gomb_kw").disabled = true;
	document.getElementById("tuzfel").disabled = true;
	document.getElementById("tuzfelcheck").disabled = true;
	document.getElementById("egyeniy").disabled = true;
	document.getElementById("tuzalap").disabled = true;
	document.getElementById("tuzalapcheck").disabled = true;
	document.getElementById("egyenix").disabled = true;
	document.getElementById("egyeniz").disabled = true;
    } else {
	if (!document.getElementById("gomb_ora").checked) {
	    document.getElementById("ora").disabled = false;
	}
	document.getElementById("gomb_ora").disabled = false;
	if (!document.getElementById("gomb_fa").checked) {
	    document.getElementById("fa").disabled = false;
	}
	document.getElementById("gomb_fa").disabled = false;
	if (!document.getElementById("gomb_kw").checked) {
	    document.getElementById("kw").disabled = false;
	}
	document.getElementById("gomb_kw").disabled = false;
	if (document.getElementById("tuzfelcheck").checked) {
	    document.getElementById("tuzfel").disabled = false;
	}
	document.getElementById("tuzfelcheck").disabled = false;
	if (document.getElementById("tuzfelcheck").checked || document.getElementById("tuzalapcheck").checked) {
	    document.getElementById("egyeniy").disabled = false;
	}
	if (document.getElementById("tuzalapcheck").checked) {
	    document.getElementById("tuzalap").disabled = false;
	}
	document.getElementById("tuzalapcheck").disabled = false;
	document.getElementById("egyenix").disabled = false;
	document.getElementById("egyeniz").disabled = false;
    }
    szog90 = false;
    szog180 = false;
    for (i = 1; i < csomesh.length; i++) {
	csomesh[i].scale.x = document.getElementById("csox" + i).value / arany;
	csomesh[i].scale.y = document.getElementById("csoy" + i).value / arany;
	csomesh[i].scale.z = document.getElementById("csoz" + i).value / arany;
	vonal[i].scale.z = -csomesh[i].scale.z;
	csomesh[i].position.z = csomesh[i].scale.z / 2;
	dummyszemben[i].position.z = -csomesh[i].scale.z;

	csomeshtukor[i].scale.x = document.getElementById("csox" + i).value / arany;
	csomeshtukor[i].scale.y = document.getElementById("csoy" + i).value / arany;
	csomeshtukor[i].scale.z = document.getElementById("csoz" + i).value / arany;
	vonaltukor[i].scale.z = -csomeshtukor[i].scale.z;
	csomeshtukor[i].position.z = csomeshtukor[i].scale.z / 2;
	dummyszembentukor[i].position.z = -csomeshtukor[i].scale.z;

	renderer.render(scene, camera);

	v1[i] = new THREE.Vector3(0, 0, 0);
	v2[i] = new THREE.Vector3(0, 0, 0);

	d1[i] = dummyszemben[i - 1].localToWorld(v1[i]);
	dummy[i].position = csomeshtarto[i].position = d1[i];
	if (document.getElementById("elag" + i).checked && !document.getElementById("elag" + (i - 1)).checked) {
	    dummy[i].rotation.y = -90 * (Math.PI / 180) + dummy[i - 1].rotation.y;
	    dummy[i].rotation.x = 0;
	} else {
	    dummy[i].rotation.x = document.getElementById("fuggnum" + i).value * (Math.PI / 180);
	    dummy[i].rotation.y = document.getElementById("viznum" + i).value * (Math.PI / 180);
	}

	vt1[i] = new THREE.Vector3(0, 0, 0);
	vt2[i] = new THREE.Vector3(0, 0, 0);

	dt1[i] = dummyszembentukor[i - 1].localToWorld(vt1[i]);
	dummytukor[i].position = csomeshtartotukor[i].position = dt1[i];

	if (document.getElementById("elag" + i).checked) {
	    if (!document.getElementById("elag" + (i - 1)).checked) {
		document.getElementById("fugg" + i).disabled = true;
		document.getElementById("fuggnum" + i).disabled = true;
		document.getElementById("viz" + i).disabled = true;
		document.getElementById("viznum" + i).disabled = true;
		if (i > 1) {
		    document.getElementById("fugg" + (i - 1)).disabled = true;
		    document.getElementById("fuggnum" + (i - 1)).disabled = true;
		    document.getElementById("viz" + (i - 1)).disabled = true;
		    document.getElementById("viznum" + (i - 1)).disabled = true;
		}
		dummytukor[i].rotation.x = 0;
		if (document.getElementById("viznum" + i).value == 0 || document.getElementById("viznum" + i).value == 180 || document.getElementById("viznum" + i).value == -180) {
		    dummy[i].rotation.y = 0;
		    dummytukor[i].rotation.y = 180 * (Math.PI / 180);
		    szog180 = true;
		} else {
		    dummytukor[i].rotation.y = 90 * (Math.PI / 180) + dummy[i - 1].rotation.y;
		    szog180 = false;
		}
		if (dummy[i - 1].rotation.y / (Math.PI / 180) == 90 || dummy[i - 1].rotation.y / (Math.PI / 180) == -90) {
		    szog90 = true;
		} else {
		    szog90 = false;
		}
	    } else {
		dummytukor[i].rotation.x = document.getElementById("fuggnum" + i).value * (Math.PI / 180);
		dummytukor[i].rotation.y = -document.getElementById("viznum" + i).value * (Math.PI / 180);
		if (szog90 || szog180) {
		    dummy[i].rotation.x += 90 * (Math.PI / 180);
		    dummy[i].rotation.y += 90 * (Math.PI / 180);
		    dummytukor[i].rotation.x = -document.getElementById("fuggnum" + i).value * (Math.PI / 180);
		    dummytukor[i].rotation.y = document.getElementById("viznum" + i).value * (Math.PI / 180);
		    dummytukor[i].rotation.x += 90 * (Math.PI / 180);
		    dummytukor[i].rotation.y += 90 * (Math.PI / 180);
		}
	    }
	} else {
	    szog90 = szog180 = false;
	    document.getElementById("fugg" + i).disabled = false;
	    document.getElementById("fuggnum" + i).disabled = false;
	    document.getElementById("viz" + i).disabled = false;
	    document.getElementById("viznum" + i).disabled = false;
	    dummytukor[i].rotation.x = document.getElementById("fuggnum" + i).value * (Math.PI / 180);
	    dummytukor[i].rotation.y = document.getElementById("viznum" + i).value * (Math.PI / 180);
	    if (!document.getElementById("elag" + (csomesh.length - 2)).checked) {
		if ((dummy[csomesh.length - 2].rotation.y / (Math.PI / 180)) % 90 !== 0) {
		    document.getElementById("elag" + (csomesh.length - 1)).disabled = true;
		} else {
		    document.getElementById("elag" + (csomesh.length - 1)).disabled = false;
		}
	    }
	}
	renderer.render(scene, camera);

	d2[i] = dummyszemben[i].localToWorld(v2[i]);
	csomeshtarto[i].lookAt(d2[i]);

	dt2[i] = dummyszembentukor[i].localToWorld(vt2[i]);
	csomeshtartotukor[i].lookAt(dt2[i]);

	renderer.render(scene, camera);

	h[i] = d2[i - 1].y - d1[i - 1].y;

	vek1x = d2[i - 1].x - d1[i - 1].x;
	vek1y = d2[i - 1].y - d1[i - 1].y;
	vek1z = d2[i - 1].z - d1[i - 1].z;
	vek2x = d2[i].x - d1[i].x;
	vek2y = d2[i].y - d1[i].y;
	vek2z = d2[i].z - d1[i].z;
	ujvek1 = new THREE.Vector3(vek1x, vek1y, vek1z);
	ujvek2 = new THREE.Vector3(vek2x, vek2y, vek2z);
	ujvek3 = new THREE.Vector3();
	ujvek3.multiplyVectors(ujvek2, ujvek1);
	vektorosszeg = ujvek3.x + ujvek3.y + ujvek3.z;
	arkoszfi = vektorosszeg / (csomesh[i - 1].scale.z * csomesh[i].scale.z); // ezzel szoptunk hatalmasat
	fi = Math.acos(arkoszfi);
	phi[i] = fi / (Math.PI / 180) || 0; // iranyvaltashoz kell hasznalni a szamitasnal
    }
    if (inithivas || projektbetoltes) {
	adattarolas();
    } else {
	kesleltet();
    }
}

var timer;
function kesleltet() {
    clearTimeout(timer);
    timer = setTimeout(function() {
        adattarolas();
    }, 1000);
}

function adattarolas() {
    if (!projektbetoltes) {    
	xmlhttp_projektek.onreadystatechange = function() {
	    if (xmlhttp_projektek.readyState == 4 && xmlhttp_projektek.status == 200) {
		diplayprojektek = document.createTextNode(xmlhttp_projektek.responseText);
		while (adatstatusprojekt.hasChildNodes()) { adatstatusprojekt.removeChild(adatstatusprojekt.lastChild); }
		zold = document.createElement("div");
		zold.className = "zold";
		document.getElementById("adatstatusprojekt").appendChild(zold);
		zold.appendChild(diplayprojektek);
		
if (!inithivas) {
    xmlhttp_fustjaratok.onreadystatechange = function() {
	if (xmlhttp_fustjaratok.readyState == 4 && xmlhttp_fustjaratok.status == 200) {
	    ezjottvissza = xmlhttp_fustjaratok.responseText;
	    szamitas = JSON.parse(ezjottvissza);

	    while (adatstatusfust.hasChildNodes()) { adatstatusfust.removeChild(adatstatusfust.lastChild); }
	    diplayfustjaratok = document.createTextNode("Flue pipes are saved!");
	    zold = document.createElement("div");
	    zold.className = "zold";
	    document.getElementById("adatstatusfust").appendChild(zold);
	    zold.appendChild(diplayfustjaratok);

	    if (projektklonozas) {
		document.location.reload(true);
	    }
	    szumma();
	}
    }

    var fj = new Object();
    fj.ag = [];
    fj.fugg = [];
    fj.viz = [];
    fj.csox = [];
    fj.csoy = [];
    fj.csoz = [];
    fj.csoanyag = [];
    fj.phi = [];
    fj.h = [];

    for (i = 1; i < csomesh.length; i++) {
	im1 = i - 1;
	if (document.getElementById("elag" + i).checked) { fj.ag[im1] = 1; } else { fj.ag[im1] = 0; }
	fj.fugg[im1] = Number(document.getElementById("fuggnum" + i).value);
	fj.viz[im1] = Number(document.getElementById("viznum" + i).value);
	fj.csox[im1] = Number(document.getElementById("csox" + i).value);
	fj.csoy[im1] = Number(document.getElementById("csoy" + i).value);
	fj.csoz[im1] = Number(document.getElementById("csoz" + i).value);
	fj.csoanyag[im1] = Number(document.getElementById("csoanyag" + i).value);
	fj.phi[im1] = kerekit(phi[i]);
	fj.h[im1] = kerekit(h[i]);
    }
    var eztistaroldel = "fustjaratok=" + JSON.stringify(fj);

    xmlhttp_fustjaratok.open("POST", "./kalyha.php" , true);
    xmlhttp_fustjaratok.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp_fustjaratok.send(eztistaroldel);

    while (adatstatusfust.hasChildNodes()) { adatstatusfust.removeChild(adatstatusfust.lastChild); }
    szurke = document.createElement("div");
    szurke.className = "szurke";
    adattarolasfust = document.createTextNode("Saving flue pipes...");
    document.getElementById("adatstatusfust").appendChild(szurke);
    szurke.appendChild(adattarolasfust);

} else {
    document.getElementById("csotorles").disabled = true;
}	
	    }
	}
	if (document.getElementById("tuzfelcheck").checked) { var tuzfelcheckbool = 1; } else { var tuzfelcheckbool = 0; }
	if (document.getElementById("tuzalapcheck").checked) { var tuzalapcheckbool = 1; } else { var tuzalapcheckbool = 0; }
	if (document.getElementById("elag0").checked) { var elag0bool = 1; } else { var elag0bool = 0; }
	if (document.getElementById("gomb_ora").checked) { var gomb = 1; } else if (document.getElementById("gomb_fa").checked) { var gomb = 2; } else if (document.getElementById("gomb_kw").checked) { gomb = 3; }
	
	if (!document.getElementById("resmin").value) { document.getElementById("resmin").value = 5; }
	if (!document.getElementById("resmax").value) { document.getElementById("resmax").value = 25; }
	
	var ezttaroldel =   "./kalyha.php?ora=" + document.getElementById("ora").value +
			    "&fa=" + document.getElementById("fa").value +
			    "&kw=" + document.getElementById("kw").value +
			    "&gomb=" + gomb +
			    "&tuzfel=" + document.getElementById("tuzfel").value +
			    "&tfc=" + tuzfelcheckbool +
			    "&egyeniy=" + document.getElementById("egyeniy").value +
			    "&tuzalap=" + document.getElementById("tuzalap").value +
			    "&tac=" + tuzalapcheckbool +
			    "&egyenix=" + document.getElementById("egyenix").value +
			    "&egyeniz=" + document.getElementById("egyeniz").value +
			    "&elevacio=" + document.getElementById("elevacio").value +
			    "&levegohom=" + document.getElementById("levegohom").value +
			    "&kalyhahej=" + document.getElementById("kalyhahej").value +
			    "&resmin=" + document.getElementById("resmin").value +
			    "&resmax=" + document.getElementById("resmax").value +
			    "&kilepo=" + document.getElementById("kilepo").value +
			    "&ag=" + elag0bool +
			    "&kileposzeles=" + document.getElementById("kileposzeles").value +
			    "&kilepomely=" + document.getElementById("kilepomely").value +
			    "&kilepomagas=" + document.getElementById("kilepomagas").value +
			    "&csox=" + document.getElementById("csox0").value +
			    "&csoy=" + document.getElementById("csoy0").value +
			    "&csoz=" + document.getElementById("csoz0").value +
			    "&csoanyag=" + document.getElementById("csoanyag0").value;

	xmlhttp_projektek.open("GET", ezttaroldel, true);
	xmlhttp_projektek.setRequestHeader('Content-Type', 'text/xml');
	xmlhttp_projektek.send(null);

	while (adatstatusprojekt.hasChildNodes()) { adatstatusprojekt.removeChild(adatstatusprojekt.lastChild); }
	szurke = document.createElement("div");
	szurke.className = "szurke";
	adattarolasprojekt = document.createTextNode("Saving combustion chamber...");
	document.getElementById("adatstatusprojekt").appendChild(szurke);
	szurke.appendChild(adattarolasprojekt);
    }

    if (inithivas || projektbetoltes) { vanemarfustjarata(); }
}


function ujcso3d(namivan) {
    if (namivan) {
	dummy[ujcso.sorszam - 1] = new THREE.Object3D();
	dummyszemben[ujcso.sorszam - 1] = new THREE.Object3D();
	csomeshtarto[ujcso.sorszam - 1] = new THREE.Object3D();
	csomesh[ujcso.sorszam - 1] = new THREE.Mesh(csoproto, materialcso);
	csomeshover[ujcso.sorszam - 1] = new THREE.Mesh(csoproto, materialcsoover);
	csomeshover[ujcso.sorszam - 1].visible = false;
	vonal[ujcso.sorszam - 1] = new THREE.Line(geovonal, materialvonal);
	dummy[ujcso.sorszam - 1].add(vonal[ujcso.sorszam - 1]);
	dummy[ujcso.sorszam - 1].add(dummyszemben[ujcso.sorszam - 1]);
	csomeshtarto[ujcso.sorszam - 1].add(csomesh[ujcso.sorszam - 1]);
	csomesh[ujcso.sorszam - 1].add(csomeshover[ujcso.sorszam - 1]);
	scene.add(dummy[ujcso.sorszam - 1]);
	scene.add(csomeshtarto[ujcso.sorszam - 1]);

	dummytukor[ujcso.sorszam - 1] = new THREE.Object3D();
	dummyszembentukor[ujcso.sorszam - 1] = new THREE.Object3D();
	csomeshtartotukor[ujcso.sorszam - 1] = new THREE.Object3D();
	csomeshtukor[ujcso.sorszam - 1] = new THREE.Mesh(csoproto, materialcso);
	csomeshovertukor[ujcso.sorszam - 1] = new THREE.Mesh(csoproto, materialcsoover);
	csomeshovertukor[ujcso.sorszam - 1].visible = false;
	vonaltukor[ujcso.sorszam - 1] = new THREE.Line(geovonal, materialvonal);
	dummytukor[ujcso.sorszam - 1].add(vonaltukor[ujcso.sorszam - 1]);
	dummytukor[ujcso.sorszam - 1].add(dummyszembentukor[ujcso.sorszam - 1]);
	csomeshtartotukor[ujcso.sorszam - 1].add(csomeshtukor[ujcso.sorszam - 1]);
	csomeshtukor[ujcso.sorszam - 1].add(csomeshovertukor[ujcso.sorszam - 1]);
	scene.add(dummytukor[ujcso.sorszam - 1]);
	scene.add(csomeshtartotukor[ujcso.sorszam - 1]);

	kilepooldal();
    } else {
	scene.remove(csomeshtarto[ujcso.sorszam]);
	scene.remove(dummy[ujcso.sorszam]);
	delete csomeshover[ujcso.sorszam];
	delete csomesh[ujcso.sorszam];
	delete vonal[ujcso.sorszam];
	delete dummyszemben[ujcso.sorszam];
	delete csomeshtarto[ujcso.sorszam];
	delete dummy[ujcso.sorszam];
	csomesh.length = dummy.length = dummyszemben.length = csomeshtarto.length = vonal.length = ujcso.sorszam;

	scene.remove(csomeshtartotukor[ujcso.sorszam]);
	scene.remove(dummytukor[ujcso.sorszam]);
	delete csomeshovertukor[ujcso.sorszam];
	delete csomeshtukor[ujcso.sorszam];
	delete vonaltukor[ujcso.sorszam];
	delete dummyszembentukor[ujcso.sorszam];
	delete csomeshtartotukor[ujcso.sorszam];
	delete dummytukor[ujcso.sorszam];
	csomeshtukor.length = dummytukor.length = dummyszembentukor.length = csomeshtartotukor.length = vonaltukor.length = ujcso.sorszam;

	kilepooldal();
    }
}

function csokozepre() {
    document.getElementById("kileposzeles").value = document.getElementById("kilepomely").value = 0;
    csocs();
}

function csocs() {
    renderer.render(scene, camera);

    csomesh[0].scale.x = document.getElementById("csox0").value / arany;
    csomesh[0].scale.y = document.getElementById("csoy0").value / arany;
    csomesh[0].scale.z = document.getElementById("csoz0").value / arany;
    vonal[0].scale.z = -csomesh[0].scale.z;

    dummy[0].position = new THREE.Vector3(0, 0, 0);
    dummy[0].rotation = new THREE.Vector3(0, 0, 0);

    dummyszemben[0].position.z = -csomesh[0].scale.z;
    csomesh[0].position.z = csomesh[0].scale.z / 2;

    if (document.getElementById("kilepo").value == 0) {// Fent
	csakitt = new THREE.Vector3(0, 0, 0);
	dummy[0].position.y = tuztermesh.scale.y / 2;
	dummy[0].position.x = document.getElementById("kileposzeles").value / arany;
	dummy[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtarto[0].position = dummy[0].position;
	dummy[0].rotation.x = 90 * (Math.PI / 180);
	dummy[0].rotation.y = 0;
	csomeshtarto[0].rotation.x = -90 * (Math.PI / 180);
	csomeshtarto[0].rotation.y = 0;
	renderer.render(scene, camera);
	csakittpoz = dummyszemben[0].localToWorld(csakitt);
	h[0] = document.getElementById("kilepomagas").value / 100;
	d2[0].x = csakittpoz.x;
	d2[0].y = csakittpoz.y;
	d2[0].z = csakittpoz.z;
	d1[0].x = dummy[0].position.x;
	d1[0].y = dummy[0].position.y;
	d1[0].z = dummy[0].position.z;
    } else if (document.getElementById("kilepo").value == 1) {// Balra
	csakitt = new THREE.Vector3(0, 0, 0);
	dummy[0].position.x = -tuztermesh.scale.x / 2;
	document.getElementById("kileposzeles").value = dummy[0].position.x * arany;
	dummy[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummy[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtarto[0].position = dummy[0].position;
	dummy[0].rotation.y = 90 * (Math.PI / 180);
	dummy[0].rotation.x = 0;
	csomeshtarto[0].rotation.y = -90 * (Math.PI / 180);
	csomeshtarto[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakittpoz = dummyszemben[0].localToWorld(csakitt);
	h[0] = document.getElementById("kilepomagas").value / 100;
	d2[0].x = csakittpoz.x;
	d2[0].y = csakittpoz.y;
	d2[0].z = csakittpoz.z;
	d1[0].x = dummy[0].position.x;
	d1[0].y = dummy[0].position.y;
	d1[0].z = dummy[0].position.z;
    } else if (document.getElementById("kilepo").value == 2) {// Jobbra
	csakitt = new THREE.Vector3(0, 0, 0);
	dummy[0].position.x = tuztermesh.scale.x / 2;
	document.getElementById("kileposzeles").value = dummy[0].position.x * arany;
	dummy[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummy[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtarto[0].position = dummy[0].position;
	dummy[0].rotation.y = -90 * (Math.PI / 180);
	dummy[0].rotation.x = 0;
	csomeshtarto[0].rotation.y = 90 * (Math.PI / 180);
	csomeshtarto[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakittpoz = dummyszemben[0].localToWorld(csakitt);
	h[0] = document.getElementById("kilepomagas").value / 100;
	d2[0].x = csakittpoz.x;
	d2[0].y = csakittpoz.y;
	d2[0].z = csakittpoz.z;
	d1[0].x = dummy[0].position.x;
	d1[0].y = dummy[0].position.y;
	d1[0].z = dummy[0].position.z;
    } else if (document.getElementById("kilepo").value == 3) {// Hatul
	csakitt = new THREE.Vector3(0, 0, 0);
	dummy[0].position.z = -tuztermesh.scale.z / 2;
	document.getElementById("kilepomely").value = dummy[0].position.z * arany;
	dummy[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummy[0].position.x = document.getElementById("kileposzeles").value / arany;
	csomeshtarto[0].position = dummy[0].position;
	dummy[0].rotation.y = 0;
	dummy[0].rotation.x = 0;
	csomeshtarto[0].rotation.y = 180 * (Math.PI / 180);
	csomeshtarto[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakittpoz = dummyszemben[0].localToWorld(csakitt);
	h[0] = document.getElementById("kilepomagas").value / 100;
	d2[0].x = csakittpoz.x;
	d2[0].y = csakittpoz.y;
	d2[0].z = csakittpoz.z;
	d1[0].x = dummy[0].position.x;
	d1[0].y = dummy[0].position.y;
	d1[0].z = dummy[0].position.z;
    } else {// Balra - Jobbra
	csakitt = new THREE.Vector3(0, 0, 0);
	dummy[0].position.x = -tuztermesh.scale.x / 2;
	document.getElementById("kileposzeles").value = 0;
	dummy[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummy[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtarto[0].position = dummy[0].position;
	dummy[0].rotation.y = 90 * (Math.PI / 180);
	dummy[0].rotation.x = 0;
	csomeshtarto[0].rotation.y = -90 * (Math.PI / 180);
	csomeshtarto[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakittpoz = dummyszemben[0].localToWorld(csakitt);
	h[0] = document.getElementById("kilepomagas").value / 100;
	d2[0].x = csakittpoz.x;
	d2[0].y = csakittpoz.y;
	d2[0].z = csakittpoz.z;
	d1[0].x = dummy[0].position.x;
	d1[0].y = dummy[0].position.y;
	d1[0].z = dummy[0].position.z;
    }

    csomeshtukor[0].scale.x = document.getElementById("csox0").value / arany;
    csomeshtukor[0].scale.y = document.getElementById("csoy0").value / arany;
    csomeshtukor[0].scale.z = document.getElementById("csoz0").value / arany;
    vonaltukor[0].scale.z = -csomeshtukor[0].scale.z;

    dummytukor[0].position = new THREE.Vector3(0, 0, 0);
    dummytukor[0].rotation = new THREE.Vector3(0, 0, 0);

    dummyszembentukor[0].position.z = -csomeshtukor[0].scale.z;
    csomeshtukor[0].position.z = csomeshtukor[0].scale.z / 2;

    if (document.getElementById("kilepo").value == 0) {// Fent
	csakitttukor = new THREE.Vector3(0, 0, 0);
	dummytukor[0].position.y = tuztermesh.scale.y / 2;
	dummytukor[0].position.x = document.getElementById("kileposzeles").value / arany;
	dummytukor[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtartotukor[0].position = dummytukor[0].position;
	dummytukor[0].rotation.x = 90 * (Math.PI / 180);
	dummytukor[0].rotation.y = 0;
	csomeshtartotukor[0].rotation.x = -90 * (Math.PI / 180);
	csomeshtartotukor[0].rotation.y = 0;
	renderer.render(scene, camera);
	csakitttukorpoz = dummyszembentukor[0].localToWorld(csakitttukor);
	dt2[0].x = csakitttukorpoz.x;
	dt2[0].y = csakitttukorpoz.y;
	dt2[0].z = csakitttukorpoz.z;
	dt1[0].x = dummytukor[0].position.x;
	dt1[0].y = dummytukor[0].position.y;
	dt1[0].z = dummytukor[0].position.z;
	document.getElementById("elag0").checked = false;
    } else if (document.getElementById("kilepo").value == 1) {// Balra
	csakitttukor = new THREE.Vector3(0, 0, 0);
	dummytukor[0].position.x = -tuztermesh.scale.x / 2;
	dummytukor[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummytukor[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtartotukor[0].position = dummytukor[0].position;
	dummytukor[0].rotation.y = 90 * (Math.PI / 180);
	dummytukor[0].rotation.x = 0;
	csomeshtartotukor[0].rotation.y = -90 * (Math.PI / 180);
	csomeshtartotukor[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakitttukorpoz = dummyszembentukor[0].localToWorld(csakitttukor);
	dt2[0].x = csakitttukorpoz.x;
	dt2[0].y = csakitttukorpoz.y;
	dt2[0].z = csakitttukorpoz.z;
	dt1[0].x = dummytukor[0].position.x;
	dt1[0].y = dummytukor[0].position.y;
	dt1[0].z = dummytukor[0].position.z;
	document.getElementById("elag0").checked = false;
    } else if (document.getElementById("kilepo").value == 2) {// Jobbra
	csakitttukor = new THREE.Vector3(0, 0, 0);
	dummytukor[0].position.x = tuztermesh.scale.x / 2;
	dummytukor[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummytukor[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtartotukor[0].position = dummytukor[0].position;
	dummytukor[0].rotation.y = -90 * (Math.PI / 180);
	dummytukor[0].rotation.x = 0;
	csomeshtartotukor[0].rotation.y = 90 * (Math.PI / 180);
	csomeshtartotukor[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakitttukorpoz = dummyszembentukor[0].localToWorld(csakitttukor);
	dt2[0].x = csakitttukorpoz.x;
	dt2[0].y = csakitttukorpoz.y;
	dt2[0].z = csakitttukorpoz.z;
	dt1[0].x = dummytukor[0].position.x;
	dt1[0].y = dummytukor[0].position.y;
	dt1[0].z = dummytukor[0].position.z;
	document.getElementById("elag0").checked = false;
    } else if (document.getElementById("kilepo").value == 3) {// Hatul
	csakitttukor = new THREE.Vector3(0, 0, 0);
	dummytukor[0].position.z = -tuztermesh.scale.z / 2;
	dummytukor[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummytukor[0].position.x = document.getElementById("kileposzeles").value / arany;
	csomeshtartotukor[0].position = dummytukor[0].position;
	dummytukor[0].rotation.y = 0;
	dummytukor[0].rotation.x = 0;
	csomeshtartotukor[0].rotation.y = 180 * (Math.PI / 180);
	csomeshtartotukor[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakitttukorpoz = dummyszembentukor[0].localToWorld(csakitttukor);
	dt2[0].x = csakitttukorpoz.x;
	dt2[0].y = csakitttukorpoz.y;
	dt2[0].z = csakitttukorpoz.z;
	dt1[0].x = dummytukor[0].position.x;
	dt1[0].y = dummytukor[0].position.y;
	dt1[0].z = dummytukor[0].position.z;
	document.getElementById("elag0").checked = false;
    } else {// Balra - Jobbra
	csakitttukor = new THREE.Vector3(0, 0, 0);
	dummytukor[0].position.x = tuztermesh.scale.x / 2;
	dummytukor[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummytukor[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtartotukor[0].position = dummytukor[0].position;
	dummytukor[0].rotation.y = -90 * (Math.PI / 180);
	dummytukor[0].rotation.x = 0;
	csomeshtartotukor[0].rotation.y = 90 * (Math.PI / 180);
	csomeshtartotukor[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakitttukorpoz = dummyszembentukor[0].localToWorld(csakitttukor);
	dt2[0].x = csakitttukorpoz.x;
	dt2[0].y = csakitttukorpoz.y;
	dt2[0].z = csakitttukorpoz.z;
	dt1[0].x = dummytukor[0].position.x;
	dt1[0].y = dummytukor[0].position.y;
	dt1[0].z = dummytukor[0].position.z;
	document.getElementById("elag0").checked = true;
    }

    renderer.render(scene, camera);
    csovek3d();
}

function ujcso(namivan) {

    if (namivan) {
	document.getElementById("projektzaras").disabled = false;
	document.getElementById("csotorles").disabled = false;
	document.getElementById("kilepo").disabled = true;

	var txtelag = document.createTextNode("Fork: ");
	var elag = document.createElement("input");
	elag.type = "checkbox";
	elag.id = "elag" + ujcso.sorszam;
	elag.checked = document.getElementById("elag" + (ujcso.sorszam - 1)).checked;
	elag.onchange = csovek3d;
	elag.title = "Check ON to start a parallel section";

	var fuggrangeid = "fugg" + ujcso.sorszam, fuggnumberid = "fuggnum" + ujcso.sorszam;

	var txtfugg = document.createTextNode(" V: ");
	var fugg = document.createElement("input");
	fugg.type = "range";
	fugg.id = fuggrangeid;
	fugg.min = "-180";
	fugg.max = "180";
	fugg.value = "0";
	fugg.step = "45";
	fugg.onchange = function fuggnumber() {
	    document.getElementById(fuggnumberid).value = this.value;
	    csocs();
	};
	fugg.title = "Direction component X of pipe section. Change in 45 degree steps";

	var fuggnum = document.createElement("input");
	fuggnum.type = "number";
	fuggnum.id = fuggnumberid;
	fuggnum.min = "-180";
	fuggnum.max = "180";
	fuggnum.value = "0";
	fuggnum.step = "5";
	fuggnum.onchange = function fuggrange() {
	    document.getElementById(fuggrangeid).value = this.value;
	    csocs();
	};
	fuggnum.title = "Direction component X of pipe section. Change in 5 degree steps or enter free-hand degrees";

	var vizrangeid = "viz" + ujcso.sorszam, viznumberid = "viznum" + ujcso.sorszam;

	var txtviz = document.createTextNode(" H: ");
	var viz = document.createElement("input");
	viz.type = "range";
	viz.id = vizrangeid;
	viz.min = "-180";
	viz.max = "180";
	viz.value = "0";
	viz.step = "45";
	viz.style.cssText = "-webkit-transform:rotate(180deg);";
	viz.onchange = function fuggnumber() {
	    document.getElementById(viznumberid).value = this.value;
	    csocs();
	};
	viz.title = "Direction component Y of pipe section. Change in 45 degree steps";

	var viznum = document.createElement("input");
	viznum.type = "number";
	viznum.id = viznumberid;
	viznum.min = "-180";
	viznum.max = "180";
	viznum.value = "0";
	viznum.step = "5";
	viznum.onchange = function fuggrange() {
	    document.getElementById(vizrangeid).value = this.value;
	    csocs();
	};
	viznum.title = "Direction component Y of pipe section. Change in 5 degree steps or enter free-hand degrees";
	
	var br = document.createElement("br");

	var txtatm = document.createTextNode("Section: ");

	var csox = document.createElement("input");
	csox.type = "number";
	csox.id = "csox" + ujcso.sorszam;
	csox.min = "1";
	csox.max = "50";
	csox.value = document.getElementById("csox" + (ujcso.sorszam - 1)).value;
	csox.onchange = csocs;
	csox.title = "Dimension X of pipe section";

	var txtx = document.createTextNode(" x ");

	var csoy = document.createElement("input");
	csoy.type = "number";
	csoy.id = "csoy" + ujcso.sorszam;
	csoy.min = "1";
	csoy.max = "50";
	csoy.value = document.getElementById("csoy" + (ujcso.sorszam - 1)).value;
	csoy.onchange = csocs;
	csoy.title = "Dimension Y of pipe section";
	
	var sub1 = document.createElement("sub");
	var cm1 = document.createTextNode(" cm");

	var txtho = document.createTextNode(" Length: ");

	var csoz = document.createElement("input");
	csoz.type = "number";
	csoz.id = "csoz" + ujcso.sorszam;
	csoz.min = "1";
	csoz.max = "200";
	csoz.value = "50";
	csoz.onchange = csocs;
	csoz.title = "Length of pipe section";

	var sub2 = document.createElement("sub");
	var cm2 = document.createTextNode(" cm");

	var csoanyag = document.createElement("select");
	csoanyag.id = "csoanyag" + ujcso.sorszam;
	csoanyag.onchange = csocs;
	csoanyag.title = "Material of pipe section walls. Raw 4 is roughest";

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.003;
	csoanyagopt.innerHTML = "Fireclay tube";
	csoanyag.appendChild(csoanyagopt);

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.002;
	csoanyagopt.innerHTML = "Fireclay";
	csoanyag.appendChild(csoanyagopt);

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.001;
	csoanyagopt.innerHTML = "Steel tube";
	csoanyag.appendChild(csoanyagopt);

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.005;
	csoanyagopt.innerHTML = "Raw 1";
	csoanyag.appendChild(csoanyagopt);

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.00666;
	csoanyagopt.innerHTML = "Raw 2";
	csoanyag.appendChild(csoanyagopt);

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.00833;
	csoanyagopt.innerHTML = "Raw 3";
	csoanyag.appendChild(csoanyagopt);

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.01;
	csoanyagopt.innerHTML = "Raw 4";
	csoanyag.appendChild(csoanyagopt);

	csoanyag.selectedIndex = document.getElementById("csoanyag" + (ujcso.sorszam - 1)).selectedIndex;

	var ujcsodiv = document.createElement("div");
	ujcsodiv.id = "ujcsodiv" + ujcso.sorszam;
	ujcsodiv.className = "tuzbevitel";
	var sorszam = ujcso.sorszam;
	ujcsodiv.onmouseover = function() {
	    overkiir(sorszam);
	};
	ujcsodiv.onmouseout = function() {
	    overtorol(sorszam);
	};
	ujcsodiv.title = "Enter pipe section data";

	var txtsorszdiv = document.createElement("div");
	txtsorszdiv.id = "txtsorszdiv" + ujcso.sorszam;
	txtsorszdiv.className = 'csosorszam';
	var txtsorsz = document.createTextNode(ujcso.sorszam + 1);

	document.getElementById("dinamikus").appendChild(ujcsodiv);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtelag);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(elag);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtfugg);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(fugg);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(fuggnum);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtviz);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(viz);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(viznum);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(br);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtsorszdiv);
	document.getElementById("txtsorszdiv" + ujcso.sorszam).appendChild(txtsorsz);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtatm);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(csox);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtx);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(csoy);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(sub1);
	sub1.appendChild(cm1);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtho);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(csoz);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(sub2);
	sub2.appendChild(cm2);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(csoanyag);

	document.getElementById("elag" + (ujcso.sorszam - 1)).disabled = true;

	if (document.getElementById("elag" + (ujcso.sorszam - 1)).checked) {
	    document.getElementById("elag" + ujcso.sorszam).disabled = true;
	    document.getElementById("csoz" + (ujcso.sorszam - 1)).disabled = true;
	    if (ujcso.sorszam > 1) {
		document.getElementById("fugg" + (ujcso.sorszam - 1)).disabled = true;
		document.getElementById("fuggnum" + (ujcso.sorszam - 1)).disabled = true;
		document.getElementById("viz" + (ujcso.sorszam - 1)).disabled = true;
		document.getElementById("viznum" + (ujcso.sorszam - 1)).disabled = true;
	    }
	} else {
	    document.getElementById("elag" + ujcso.sorszam).disabled = false;
	}

	if (document.getElementById("elag" + (ujcso.sorszam - 1)).checked && kerekit(d2[ujcso.sorszam - 1].x) == kerekit(dt2[ujcso.sorszam - 1].x)
		&& kerekit(d2[ujcso.sorszam - 1].y) == kerekit(dt2[ujcso.sorszam - 1].y) && kerekit(d2[ujcso.sorszam - 1].z) == kerekit(dt2[ujcso.sorszam - 1].z)) {
	    document.getElementById("elag" + ujcso.sorszam).disabled = true;
	    document.getElementById("elag" + ujcso.sorszam).checked = false;
	}

	ujcso.sorszam++;
	
	var scrolldiv = document.getElementById("tab2");
	scrolldiv.scrollTop = scrolldiv.scrollHeight;

	ujcso3d(true);

    } else {

	if (ujcso.sorszam > 1) {

	    ujcso.sorszam--;

	    if (ujcso.sorszam == 1) {
		document.getElementById("csotorles").disabled = true;
		document.getElementById("projektzaras").disabled = true;
		document.getElementById("kilepo").disabled = false;
		document.getElementById("csoz" + (ujcso.sorszam - 1)).disabled = false;
	    } else {
		document.getElementById("elag" + (ujcso.sorszam - 1)).disabled = false;
	    }

	    var torolni1 = document.getElementById("ujcsodiv" + ujcso.sorszam);

	    document.getElementById("dinamikus").removeChild(torolni1);

	    if (ujcso.sorszam > 2 && document.getElementById("elag" + (ujcso.sorszam - 2)).checked) {
		document.getElementById("elag" + (ujcso.sorszam - 1)).disabled = true;
	    } else {
		document.getElementById("elag" + (ujcso.sorszam - 1)).disabled = false;
	    }

	    if (ujcso.sorszam > 1) {
		document.getElementById("fugg" + (ujcso.sorszam - 1)).disabled = false;
		document.getElementById("fuggnum" + (ujcso.sorszam - 1)).disabled = false;
		document.getElementById("viz" + (ujcso.sorszam - 1)).disabled = false;
		document.getElementById("viznum" + (ujcso.sorszam - 1)).disabled = false;
		document.getElementById("csoz" + (ujcso.sorszam - 1)).disabled = false;
	    }

	    if (ujcso.sorszam == 2 && document.getElementById("elag0").checked) {
		document.getElementById("elag" + (ujcso.sorszam - 1)).disabled = true;
	    }
	    ujcso3d(false);
	}
    }
}

function kerekit(ezt) {
    return Math.round(ezt * Math.pow(10, 5)) / Math.pow(10, 5);
}

function ujcsoinit(adat, visszahivas) {

    	document.getElementById("csotorles").disabled = false;
	document.getElementById("kilepo").disabled = true;

	var txtelag = document.createTextNode("Fork: ");
	var elag = document.createElement("input");
	elag.type = "checkbox";
	elag.id = "elag" + ujcso.sorszam;
	elag.checked = document.getElementById("elag" + (ujcso.sorszam - 1)).checked;
	elag.onchange = csovek3d;
	elag.title = "Check ON to start a parallel section";

	var fuggrangeid = "fugg" + ujcso.sorszam, fuggnumberid = "fuggnum" + ujcso.sorszam;

	var txtfugg = document.createTextNode(" V: ");
	var fugg = document.createElement("input");
	fugg.type = "range";
	fugg.id = fuggrangeid;
	fugg.min = "-180";
	fugg.max = "180";
	fugg.value = "0";
	fugg.step = "45";
	fugg.onchange = function fuggnumber() {
	    document.getElementById(fuggnumberid).value = this.value;
	    csocs();
	};
	fugg.title = "Direction component X of pipe section. Change in 45 degree steps";

	var fuggnum = document.createElement("input");
	fuggnum.type = "number";
	fuggnum.id = fuggnumberid;
	fuggnum.min = "-180";
	fuggnum.max = "180";
	fuggnum.value = "0";
	fuggnum.step = "5";
	fuggnum.onchange = function fuggrange() {
	    document.getElementById(fuggrangeid).value = this.value;
	    csocs();
	};
	fuggnum.title = "Direction component X of pipe section. Change in 5 degree steps or enter free-hand degrees";

	var vizrangeid = "viz" + ujcso.sorszam, viznumberid = "viznum" + ujcso.sorszam;

	var txtviz = document.createTextNode(" H: ");
	var viz = document.createElement("input");
	viz.type = "range";
	viz.id = vizrangeid;
	viz.min = "-180";
	viz.max = "180";
	viz.value = "0";
	viz.step = "45";
	viz.style.cssText = "-webkit-transform:rotate(180deg);";
	viz.onchange = function fuggnumber() {
	    document.getElementById(viznumberid).value = this.value;
	    csocs();
	};
	viz.title = "Direction component Y of pipe section. Change in 45 degree steps";
	
	var viznum = document.createElement("input");
	viznum.type = "number";
	viznum.id = viznumberid;
	viznum.min = "-180";
	viznum.max = "180";
	viznum.value = "0";
	viznum.step = "5";
	viznum.onchange = function fuggrange() {
	    document.getElementById(vizrangeid).value = this.value;
	    csocs();
	};
	viznum.title = "Direction component Y of pipe section. Change in 5 degree steps or enter free-hand degrees";

	var br = document.createElement("br");

	var txtatm = document.createTextNode("Section: ");

	var csox = document.createElement("input");
	csox.type = "number";
	csox.id = "csox" + ujcso.sorszam;
	csox.min = "1";
	csox.max = "50";
	csox.value = document.getElementById("csox" + (ujcso.sorszam - 1)).value;
	csox.onchange = csocs;
	csox.title = "Dimension X of pipe section";
	
	var txtx = document.createTextNode(" x ");

	var csoy = document.createElement("input");
	csoy.type = "number";
	csoy.id = "csoy" + ujcso.sorszam;
	csoy.min = "1";
	csoy.max = "50";
	csoy.value = document.getElementById("csoy" + (ujcso.sorszam - 1)).value;
	csoy.onchange = csocs;
	csoy.title = "Dimension Y of pipe section";
	
	var sub1 = document.createElement("sub");
	var cm1 = document.createTextNode(" cm");

	var txtho = document.createTextNode(" Length: ");

	var csoz = document.createElement("input");
	csoz.type = "number";
	csoz.id = "csoz" + ujcso.sorszam;
	csoz.min = "1";
	csoz.max = "200";
	csoz.value = "50";
	csoz.onchange = csocs;
	csoz.title = "Length of pipe section";

	var sub2 = document.createElement("sub");
	var cm2 = document.createTextNode(" cm");

	var csoanyag = document.createElement("select");
	csoanyag.id = "csoanyag" + ujcso.sorszam;
	csoanyag.onchange = csocs;
	csoanyag.title = "Material of pipe section walls. Raw 4 is roughest";

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.003;
	csoanyagopt.innerHTML = "Fireclay tube";
	csoanyag.appendChild(csoanyagopt);

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.002;
	csoanyagopt.innerHTML = "Fireclay";
	csoanyag.appendChild(csoanyagopt);

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.001;
	csoanyagopt.innerHTML = "Steel tube";
	csoanyag.appendChild(csoanyagopt);

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.005;
	csoanyagopt.innerHTML = "Raw 1";
	csoanyag.appendChild(csoanyagopt);

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.00666;
	csoanyagopt.innerHTML = "Raw 2";
	csoanyag.appendChild(csoanyagopt);

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.00833;
	csoanyagopt.innerHTML = "Raw 3";
	csoanyag.appendChild(csoanyagopt);

	csoanyagopt = document.createElement("option");
	csoanyagopt.value = 0.01;
	csoanyagopt.innerHTML = "Raw 4";
	csoanyag.appendChild(csoanyagopt);

	csoanyag.selectedIndex = document.getElementById("csoanyag" + (ujcso.sorszam - 1)).selectedIndex;

	var ujcsodiv = document.createElement("div");
	ujcsodiv.id = "ujcsodiv" + ujcso.sorszam;
	ujcsodiv.className = "tuzbevitel";
	var sorszam = ujcso.sorszam;
	ujcsodiv.onmouseover = function() {
	    overkiir(sorszam);
	};
	ujcsodiv.onmouseout = function() {
	    overtorol(sorszam);
	};
	ujcsodiv.title = "Enter pipe section data";

	var txtsorszdiv = document.createElement("div");
	txtsorszdiv.id = "txtsorszdiv" + ujcso.sorszam;
	txtsorszdiv.className = 'csosorszam';
	var txtsorsz = document.createTextNode(ujcso.sorszam + 1);

	document.getElementById("dinamikus").appendChild(ujcsodiv);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtelag);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(elag);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtfugg);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(fugg);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(fuggnum);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtviz);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(viz);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(viznum);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(br);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtsorszdiv);
	document.getElementById("txtsorszdiv" + ujcso.sorszam).appendChild(txtsorsz);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtatm);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(csox);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtx);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(csoy);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(sub1);
	sub1.appendChild(cm1);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(txtho);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(csoz);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(sub2);
	sub2.appendChild(cm2);
	document.getElementById("ujcsodiv" + ujcso.sorszam).appendChild(csoanyag);

    document.getElementById("elag" + (ujcso.sorszam - 1)).disabled = true;

    if (document.getElementById("elag" + (ujcso.sorszam - 1)).checked) {
	document.getElementById("elag" + ujcso.sorszam).disabled = true;
	document.getElementById("csoz" + (ujcso.sorszam - 1)).disabled = true;
	if (ujcso.sorszam > 1) {
	    document.getElementById("fugg" + (ujcso.sorszam - 1)).disabled = true;
	    document.getElementById("fuggnum" + (ujcso.sorszam - 1)).disabled = true;
	    document.getElementById("viz" + (ujcso.sorszam - 1)).disabled = true;
	    document.getElementById("viznum" + (ujcso.sorszam - 1)).disabled = true;
	}
    } else {
	document.getElementById("elag" + ujcso.sorszam).disabled = false;
    }

    if (document.getElementById("elag" + (ujcso.sorszam - 1)).checked && kerekit(d2[ujcso.sorszam - 1].x) == kerekit(dt2[ujcso.sorszam - 1].x)
	    && kerekit(d2[ujcso.sorszam - 1].y) == kerekit(dt2[ujcso.sorszam - 1].y) && kerekit(d2[ujcso.sorszam - 1].z) == kerekit(dt2[ujcso.sorszam - 1].z)) {
	document.getElementById("elag" + ujcso.sorszam).disabled = true;
	document.getElementById("elag" + ujcso.sorszam).checked = false;
    }

    ujcso.sorszam++;

/// ITT KAPJA MEG AZ ADATOKAT ////////////////////////////////////////////////////////////
											//
if (adat.ag == "0") {									//
    document.getElementById("elag" + (ujcso.sorszam - 1)).checked = false;		//
} else {										//
    document.getElementById("elag" + (ujcso.sorszam - 1)).checked = true;		//
}											//
document.getElementById("fugg" + (ujcso.sorszam - 1)).value = Number(adat.fugg);	//
document.getElementById("fuggnum" + (ujcso.sorszam - 1)).value = Number(adat.fugg);	//
document.getElementById("viz" + (ujcso.sorszam - 1)).value = Number(adat.viz);		//
document.getElementById("viznum" + (ujcso.sorszam - 1)).value = Number(adat.viz);	//
document.getElementById("csox" + (ujcso.sorszam - 1)).value = Number(adat.csox);	//
document.getElementById("csoy" + (ujcso.sorszam - 1)).value = Number(adat.csoy);	//
document.getElementById("csoz" + (ujcso.sorszam - 1)).value = Number(adat.csoz);	//
document.getElementById("csoanyag" + (ujcso.sorszam - 1)).value = Number(adat.csoanyag);//
											//
//////////////////////////////////////////////////////////////////////////////////////////

    dummy[ujcso.sorszam - 1] = new THREE.Object3D();
    dummyszemben[ujcso.sorszam - 1] = new THREE.Object3D();
    csomeshtarto[ujcso.sorszam - 1] = new THREE.Object3D();
    csomesh[ujcso.sorszam - 1] = new THREE.Mesh(csoproto, materialcso);
    csomeshover[ujcso.sorszam - 1] = new THREE.Mesh(csoproto, materialcsoover);
    csomeshover[ujcso.sorszam - 1].visible = false;
    vonal[ujcso.sorszam - 1] = new THREE.Line(geovonal, materialvonal);
    dummy[ujcso.sorszam - 1].add(vonal[ujcso.sorszam - 1]);
    dummy[ujcso.sorszam - 1].add(dummyszemben[ujcso.sorszam - 1]);
    csomeshtarto[ujcso.sorszam - 1].add(csomesh[ujcso.sorszam - 1]);
    csomesh[ujcso.sorszam - 1].add(csomeshover[ujcso.sorszam - 1]);
    scene.add(dummy[ujcso.sorszam - 1]);
    scene.add(csomeshtarto[ujcso.sorszam - 1]);

    dummytukor[ujcso.sorszam - 1] = new THREE.Object3D();
    dummyszembentukor[ujcso.sorszam - 1] = new THREE.Object3D();
    csomeshtartotukor[ujcso.sorszam - 1] = new THREE.Object3D();
    csomeshtukor[ujcso.sorszam - 1] = new THREE.Mesh(csoproto, materialcso);
    csomeshovertukor[ujcso.sorszam - 1] = new THREE.Mesh(csoproto, materialcsoover);
    csomeshovertukor[ujcso.sorszam - 1].visible = false;
    vonaltukor[ujcso.sorszam - 1] = new THREE.Line(geovonal, materialvonal);
    dummytukor[ujcso.sorszam - 1].add(vonaltukor[ujcso.sorszam - 1]);
    dummytukor[ujcso.sorszam - 1].add(dummyszembentukor[ujcso.sorszam - 1]);
    csomeshtartotukor[ujcso.sorszam - 1].add(csomeshtukor[ujcso.sorszam - 1]);
    csomeshtukor[ujcso.sorszam - 1].add(csomeshovertukor[ujcso.sorszam - 1]);
    scene.add(dummytukor[ujcso.sorszam - 1]);
    scene.add(csomeshtartotukor[ujcso.sorszam - 1]);

    renderer.render(scene, camera);

    csomesh[0].scale.x = document.getElementById("csox0").value / arany;
    csomesh[0].scale.y = document.getElementById("csoy0").value / arany;
    csomesh[0].scale.z = document.getElementById("csoz0").value / arany;
    vonal[0].scale.z = -csomesh[0].scale.z;

    dummy[0].position = new THREE.Vector3(0, 0, 0);
    dummy[0].rotation = new THREE.Vector3(0, 0, 0);

    dummyszemben[0].position.z = -csomesh[0].scale.z;
    csomesh[0].position.z = csomesh[0].scale.z / 2;

    if (document.getElementById("kilepo").value == 0) {// Fent
	csakitt = new THREE.Vector3(0, 0, 0);
	dummy[0].position.y = tuztermesh.scale.y / 2;
	dummy[0].position.x = document.getElementById("kileposzeles").value / arany;
	dummy[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtarto[0].position = dummy[0].position;
	dummy[0].rotation.x = 90 * (Math.PI / 180);
	dummy[0].rotation.y = 0;
	csomeshtarto[0].rotation.x = -90 * (Math.PI / 180);
	csomeshtarto[0].rotation.y = 0;
	renderer.render(scene, camera);
	csakittpoz = dummyszemben[0].localToWorld(csakitt);
	h[0] = document.getElementById("kilepomagas").value / 100;
	d2[0].x = csakittpoz.x;
	d2[0].y = csakittpoz.y;
	d2[0].z = csakittpoz.z;
	d1[0].x = dummy[0].position.x;
	d1[0].y = dummy[0].position.y;
	d1[0].z = dummy[0].position.z;
    } else if (document.getElementById("kilepo").value == 1) {// Balra
	csakitt = new THREE.Vector3(0, 0, 0);
	dummy[0].position.x = -tuztermesh.scale.x / 2;
	document.getElementById("kileposzeles").value = dummy[0].position.x * arany;
	dummy[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummy[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtarto[0].position = dummy[0].position;
	dummy[0].rotation.y = 90 * (Math.PI / 180);
	dummy[0].rotation.x = 0;
	csomeshtarto[0].rotation.y = -90 * (Math.PI / 180);
	csomeshtarto[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakittpoz = dummyszemben[0].localToWorld(csakitt);
	h[0] = document.getElementById("kilepomagas").value / 100;
	d2[0].x = csakittpoz.x;
	d2[0].y = csakittpoz.y;
	d2[0].z = csakittpoz.z;
	d1[0].x = dummy[0].position.x;
	d1[0].y = dummy[0].position.y;
	d1[0].z = dummy[0].position.z;
    } else if (document.getElementById("kilepo").value == 2) {// Jobbra
	csakitt = new THREE.Vector3(0, 0, 0);
	dummy[0].position.x = tuztermesh.scale.x / 2;
	document.getElementById("kileposzeles").value = dummy[0].position.x * arany;
	dummy[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummy[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtarto[0].position = dummy[0].position;
	dummy[0].rotation.y = -90 * (Math.PI / 180);
	dummy[0].rotation.x = 0;
	csomeshtarto[0].rotation.y = 90 * (Math.PI / 180);
	csomeshtarto[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakittpoz = dummyszemben[0].localToWorld(csakitt);
	h[0] = document.getElementById("kilepomagas").value / 100;
	d2[0].x = csakittpoz.x;
	d2[0].y = csakittpoz.y;
	d2[0].z = csakittpoz.z;
	d1[0].x = dummy[0].position.x;
	d1[0].y = dummy[0].position.y;
	d1[0].z = dummy[0].position.z;
    } else if (document.getElementById("kilepo").value == 3) {// Hatul
	csakitt = new THREE.Vector3(0, 0, 0);
	dummy[0].position.z = -tuztermesh.scale.z / 2;
	document.getElementById("kilepomely").value = dummy[0].position.z * arany;
	dummy[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummy[0].position.x = document.getElementById("kileposzeles").value / arany;
	csomeshtarto[0].position = dummy[0].position;
	dummy[0].rotation.y = 0;
	dummy[0].rotation.x = 0;
	csomeshtarto[0].rotation.y = 180 * (Math.PI / 180);
	csomeshtarto[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakittpoz = dummyszemben[0].localToWorld(csakitt);
	h[0] = document.getElementById("kilepomagas").value / 100;
	d2[0].x = csakittpoz.x;
	d2[0].y = csakittpoz.y;
	d2[0].z = csakittpoz.z;
	d1[0].x = dummy[0].position.x;
	d1[0].y = dummy[0].position.y;
	d1[0].z = dummy[0].position.z;
    } else {// Balra - Jobbra
	csakitt = new THREE.Vector3(0, 0, 0);
	dummy[0].position.x = -tuztermesh.scale.x / 2;
	document.getElementById("kileposzeles").value = 0;
	dummy[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummy[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtarto[0].position = dummy[0].position;
	dummy[0].rotation.y = 90 * (Math.PI / 180);
	dummy[0].rotation.x = 0;
	csomeshtarto[0].rotation.y = -90 * (Math.PI / 180);
	csomeshtarto[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakittpoz = dummyszemben[0].localToWorld(csakitt);
	h[0] = document.getElementById("kilepomagas").value / 100;
	d2[0].x = csakittpoz.x;
	d2[0].y = csakittpoz.y;
	d2[0].z = csakittpoz.z;
	d1[0].x = dummy[0].position.x;
	d1[0].y = dummy[0].position.y;
	d1[0].z = dummy[0].position.z;
    }

    csomeshtukor[0].scale.x = document.getElementById("csox0").value / arany;
    csomeshtukor[0].scale.y = document.getElementById("csoy0").value / arany;
    csomeshtukor[0].scale.z = document.getElementById("csoz0").value / arany;
    vonaltukor[0].scale.z = -csomeshtukor[0].scale.z;

    dummytukor[0].position = new THREE.Vector3(0, 0, 0);
    dummytukor[0].rotation = new THREE.Vector3(0, 0, 0);

    dummyszembentukor[0].position.z = -csomeshtukor[0].scale.z;
    csomeshtukor[0].position.z = csomeshtukor[0].scale.z / 2;

    if (document.getElementById("kilepo").value == 0) {// Fent
	csakitttukor = new THREE.Vector3(0, 0, 0);
	dummytukor[0].position.y = tuztermesh.scale.y / 2;
	dummytukor[0].position.x = document.getElementById("kileposzeles").value / arany;
	dummytukor[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtartotukor[0].position = dummytukor[0].position;
	dummytukor[0].rotation.x = 90 * (Math.PI / 180);
	dummytukor[0].rotation.y = 0;
	csomeshtartotukor[0].rotation.x = -90 * (Math.PI / 180);
	csomeshtartotukor[0].rotation.y = 0;
	renderer.render(scene, camera);
	csakitttukorpoz = dummyszembentukor[0].localToWorld(csakitttukor);
	dt2[0].x = csakitttukorpoz.x;
	dt2[0].y = csakitttukorpoz.y;
	dt2[0].z = csakitttukorpoz.z;
	dt1[0].x = dummytukor[0].position.x;
	dt1[0].y = dummytukor[0].position.y;
	dt1[0].z = dummytukor[0].position.z;
	document.getElementById("elag0").checked = false;
    } else if (document.getElementById("kilepo").value == 1) {// Balra
	csakitttukor = new THREE.Vector3(0, 0, 0);
	dummytukor[0].position.x = -tuztermesh.scale.x / 2;
	dummytukor[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummytukor[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtartotukor[0].position = dummytukor[0].position;
	dummytukor[0].rotation.y = 90 * (Math.PI / 180);
	dummytukor[0].rotation.x = 0;
	csomeshtartotukor[0].rotation.y = -90 * (Math.PI / 180);
	csomeshtartotukor[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakitttukorpoz = dummyszembentukor[0].localToWorld(csakitttukor);
	dt2[0].x = csakitttukorpoz.x;
	dt2[0].y = csakitttukorpoz.y;
	dt2[0].z = csakitttukorpoz.z;
	dt1[0].x = dummytukor[0].position.x;
	dt1[0].y = dummytukor[0].position.y;
	dt1[0].z = dummytukor[0].position.z;
	document.getElementById("elag0").checked = false;
    } else if (document.getElementById("kilepo").value == 2) {// Jobbra
	csakitttukor = new THREE.Vector3(0, 0, 0);
	dummytukor[0].position.x = tuztermesh.scale.x / 2;
	dummytukor[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummytukor[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtartotukor[0].position = dummytukor[0].position;
	dummytukor[0].rotation.y = -90 * (Math.PI / 180);
	dummytukor[0].rotation.x = 0;
	csomeshtartotukor[0].rotation.y = 90 * (Math.PI / 180);
	csomeshtartotukor[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakitttukorpoz = dummyszembentukor[0].localToWorld(csakitttukor);
	dt2[0].x = csakitttukorpoz.x;
	dt2[0].y = csakitttukorpoz.y;
	dt2[0].z = csakitttukorpoz.z;
	dt1[0].x = dummytukor[0].position.x;
	dt1[0].y = dummytukor[0].position.y;
	dt1[0].z = dummytukor[0].position.z;
	document.getElementById("elag0").checked = false;
    } else if (document.getElementById("kilepo").value == 3) {// Hatul
	csakitttukor = new THREE.Vector3(0, 0, 0);
	dummytukor[0].position.z = -tuztermesh.scale.z / 2;
	dummytukor[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummytukor[0].position.x = document.getElementById("kileposzeles").value / arany;
	csomeshtartotukor[0].position = dummytukor[0].position;
	dummytukor[0].rotation.y = 0;
	dummytukor[0].rotation.x = 0;
	csomeshtartotukor[0].rotation.y = 180 * (Math.PI / 180);
	csomeshtartotukor[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakitttukorpoz = dummyszembentukor[0].localToWorld(csakitttukor);
	dt2[0].x = csakitttukorpoz.x;
	dt2[0].y = csakitttukorpoz.y;
	dt2[0].z = csakitttukorpoz.z;
	dt1[0].x = dummytukor[0].position.x;
	dt1[0].y = dummytukor[0].position.y;
	dt1[0].z = dummytukor[0].position.z;
	document.getElementById("elag0").checked = false;
    } else {// Balra - Jobbra
	csakitttukor = new THREE.Vector3(0, 0, 0);
	dummytukor[0].position.x = tuztermesh.scale.x / 2;
	dummytukor[0].position.y = document.getElementById("kilepomagas").value / arany - tuztermesh.scale.y / 2;
	dummytukor[0].position.z = document.getElementById("kilepomely").value / arany;
	csomeshtartotukor[0].position = dummytukor[0].position;
	dummytukor[0].rotation.y = -90 * (Math.PI / 180);
	dummytukor[0].rotation.x = 0;
	csomeshtartotukor[0].rotation.y = 90 * (Math.PI / 180);
	csomeshtartotukor[0].rotation.x = 0;
	renderer.render(scene, camera);
	csakitttukorpoz = dummyszembentukor[0].localToWorld(csakitttukor);
	dt2[0].x = csakitttukorpoz.x;
	dt2[0].y = csakitttukorpoz.y;
	dt2[0].z = csakitttukorpoz.z;
	dt1[0].x = dummytukor[0].position.x;
	dt1[0].y = dummytukor[0].position.y;
	dt1[0].z = dummytukor[0].position.z;
	document.getElementById("elag0").checked = true;
    }

    renderer.render(scene, camera);

    if (document.getElementById("elag0").checked) {
	document.getElementById("ora").disabled = true;
	document.getElementById("gomb_ora").disabled = true;
	document.getElementById("fa").disabled = true;
	document.getElementById("gomb_fa").disabled = true;
	document.getElementById("kw").disabled = true;
	document.getElementById("gomb_kw").disabled = true;
	document.getElementById("tuzfel").disabled = true;
	document.getElementById("tuzfelcheck").disabled = true;
	document.getElementById("egyeniy").disabled = true;
	document.getElementById("tuzalap").disabled = true;
	document.getElementById("tuzalapcheck").disabled = true;
	document.getElementById("egyenix").disabled = true;
	document.getElementById("egyeniz").disabled = true;
    } else {
	if (!document.getElementById("gomb_ora").checked) {
	    document.getElementById("ora").disabled = false;
	}
	document.getElementById("gomb_ora").disabled = false;
	if (!document.getElementById("gomb_fa").checked) {
	    document.getElementById("fa").disabled = false;
	}
	document.getElementById("gomb_fa").disabled = false;
	if (!document.getElementById("gomb_kw").checked) {
	    document.getElementById("kw").disabled = false;
	}
	document.getElementById("gomb_kw").disabled = false;
	if (document.getElementById("tuzfelcheck").checked) {
	    document.getElementById("tuzfel").disabled = false;
	}
	document.getElementById("tuzfelcheck").disabled = false;
	if (document.getElementById("tuzfelcheck").checked || document.getElementById("tuzalapcheck").checked) {
	    document.getElementById("egyeniy").disabled = false;
	}
	if (document.getElementById("tuzalapcheck").checked) {
	    document.getElementById("tuzalap").disabled = false;
	}
	document.getElementById("tuzalapcheck").disabled = false;
	document.getElementById("egyenix").disabled = false;
	document.getElementById("egyeniz").disabled = false;
    }
    szog90 = false;
    szog180 = false;
    for (i = 1; i < csomesh.length; i++) {
	csomesh[i].scale.x = document.getElementById("csox" + i).value / arany;
	csomesh[i].scale.y = document.getElementById("csoy" + i).value / arany;
	csomesh[i].scale.z = document.getElementById("csoz" + i).value / arany;
	vonal[i].scale.z = -csomesh[i].scale.z;
	csomesh[i].position.z = csomesh[i].scale.z / 2;
	dummyszemben[i].position.z = -csomesh[i].scale.z;

	csomeshtukor[i].scale.x = document.getElementById("csox" + i).value / arany;
	csomeshtukor[i].scale.y = document.getElementById("csoy" + i).value / arany;
	csomeshtukor[i].scale.z = document.getElementById("csoz" + i).value / arany;
	vonaltukor[i].scale.z = -csomeshtukor[i].scale.z;
	csomeshtukor[i].position.z = csomeshtukor[i].scale.z / 2;
	dummyszembentukor[i].position.z = -csomeshtukor[i].scale.z;

	renderer.render(scene, camera);

	v1[i] = new THREE.Vector3(0, 0, 0);
	v2[i] = new THREE.Vector3(0, 0, 0);

	d1[i] = dummyszemben[i - 1].localToWorld(v1[i]);
	dummy[i].position = csomeshtarto[i].position = d1[i];
	if (document.getElementById("elag" + i).checked && !document.getElementById("elag" + (i - 1)).checked) {
	    dummy[i].rotation.y = -90 * (Math.PI / 180) + dummy[i - 1].rotation.y;
	    dummy[i].rotation.x = 0;
	} else {
	    dummy[i].rotation.x = document.getElementById("fuggnum" + i).value * (Math.PI / 180);
	    dummy[i].rotation.y = document.getElementById("viznum" + i).value * (Math.PI / 180);
	}

	vt1[i] = new THREE.Vector3(0, 0, 0);
	vt2[i] = new THREE.Vector3(0, 0, 0);

	dt1[i] = dummyszembentukor[i - 1].localToWorld(vt1[i]);
	dummytukor[i].position = csomeshtartotukor[i].position = dt1[i];

	if (document.getElementById("elag" + i).checked) {
	    if (!document.getElementById("elag" + (i - 1)).checked) {
		document.getElementById("fugg" + i).disabled = true;
		document.getElementById("fuggnum" + i).disabled = true;
		document.getElementById("viz" + i).disabled = true;
		document.getElementById("viznum" + i).disabled = true;
		if (i > 1) {
		    document.getElementById("fugg" + (i - 1)).disabled = true;
		    document.getElementById("fuggnum" + (i - 1)).disabled = true;
		    document.getElementById("viz" + (i - 1)).disabled = true;
		    document.getElementById("viznum" + (i - 1)).disabled = true;
		}
		dummytukor[i].rotation.x = 0;
		if (document.getElementById("viznum" + i).value == 0 || document.getElementById("viznum" + i).value == 180 || document.getElementById("viznum" + i).value == -180) {
		    dummy[i].rotation.y = 0;
		    dummytukor[i].rotation.y = 180 * (Math.PI / 180);
		    szog180 = true;
		} else {
		    dummytukor[i].rotation.y = 90 * (Math.PI / 180) + dummy[i - 1].rotation.y;
		    szog180 = false;
		}
		if (dummy[i - 1].rotation.y / (Math.PI / 180) == 90 || dummy[i - 1].rotation.y / (Math.PI / 180) == -90) {
		    szog90 = true;
		} else {
		    szog90 = false;
		}
	    } else {
		dummytukor[i].rotation.x = document.getElementById("fuggnum" + i).value * (Math.PI / 180);
		dummytukor[i].rotation.y = -document.getElementById("viznum" + i).value * (Math.PI / 180);
		if (szog90 || szog180) {
		    dummy[i].rotation.x += 90 * (Math.PI / 180);
		    dummy[i].rotation.y += 90 * (Math.PI / 180);
		    dummytukor[i].rotation.x = -document.getElementById("fuggnum" + i).value * (Math.PI / 180);
		    dummytukor[i].rotation.y = document.getElementById("viznum" + i).value * (Math.PI / 180);
		    dummytukor[i].rotation.x += 90 * (Math.PI / 180);
		    dummytukor[i].rotation.y += 90 * (Math.PI / 180);
		}
	    }
	} else {
	    szog90 = szog180 = false;
	    document.getElementById("fugg" + i).disabled = false;
	    document.getElementById("fuggnum" + i).disabled = false;
	    document.getElementById("viz" + i).disabled = false;
	    document.getElementById("viznum" + i).disabled = false;
	    dummytukor[i].rotation.x = document.getElementById("fuggnum" + i).value * (Math.PI / 180);
	    dummytukor[i].rotation.y = document.getElementById("viznum" + i).value * (Math.PI / 180);
	    if (!document.getElementById("elag" + (csomesh.length - 2)).checked) {
		if ((dummy[csomesh.length - 2].rotation.y / (Math.PI / 180)) % 90 !== 0) {
		    document.getElementById("elag" + (csomesh.length - 1)).disabled = true;
		} else {
		    document.getElementById("elag" + (csomesh.length - 1)).disabled = false;
		}
	    }
	}
	renderer.render(scene, camera);

	d2[i] = dummyszemben[i].localToWorld(v2[i]);
	csomeshtarto[i].lookAt(d2[i]);

	dt2[i] = dummyszembentukor[i].localToWorld(vt2[i]);
	csomeshtartotukor[i].lookAt(dt2[i]);

	renderer.render(scene, camera);

	h[i] = d2[i - 1].y - d1[i - 1].y;

	vek1x = d2[i - 1].x - d1[i - 1].x;
	vek1y = d2[i - 1].y - d1[i - 1].y;
	vek1z = d2[i - 1].z - d1[i - 1].z;
	vek2x = d2[i].x - d1[i].x;
	vek2y = d2[i].y - d1[i].y;
	vek2z = d2[i].z - d1[i].z;
	ujvek1 = new THREE.Vector3(vek1x, vek1y, vek1z);
	ujvek2 = new THREE.Vector3(vek2x, vek2y, vek2z);
	ujvek3 = new THREE.Vector3();
	ujvek3.multiplyVectors(ujvek2, ujvek1);
	vektorosszeg = ujvek3.x + ujvek3.y + ujvek3.z;
	arkoszfi = vektorosszeg / (csomesh[i - 1].scale.z * csomesh[i].scale.z); // ezzel szoptunk hatalmasat
	fi = Math.acos(arkoszfi);
	phi[i] = fi / (Math.PI / 180) || 0; // iranyvaltashoz kell hasznalni a szamitasnal
    }
    
    visszahivas();
}
