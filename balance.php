<?php
require_once ("./include/membersite_config.php");
require_once ("./include/kalyha_config.php");
require_once ("./include/admin_config.php");

if (!$fgmembersite_log->CheckLogin()) {
    $fgmembersite_log->RedirectToURL("index.php");
    exit();
}

if ($admin->kerekEgyenleget()) {
    $vanneki = $admin->balance;
} else {
    $vanneki = 0;
}

if ($kalyha->vaneLezartProjektje()) {
    $elhasznalta = $kalyha->lezart;
} else {
    $elhasznalta = 0;
}

$_SESSION['balance'] = $vanneki - $elhasznalta;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="<?php echo $lang['HTML_LANG']; ?>"
      lang="<?php echo $lang['HTML_LANG']; ?>">
    <head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title><?php echo $lang['PAGE_TITLE']; ?></title>
	<script src="./scripts/jquery-1.9.1.min.js"></script>
	<script src="./scripts/three.min.js"></script>
	<script src="./scripts/TrackballControls.js"></script>
	<script src="./scripts/ignea.js"></script>
	<script src="./scripts/kalyha.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="./style/kalyha.css" />
	<style>
	    input[type='text'] {
		width: 150px;
		font-size: 1em;
		height: 1.3em;
		font-weight: bold;
		color: black;
	    }
	</style>
    </head>
    <body><span class='error_message'><?php echo $kalyha->GetErrorMessage(); ?></span>	
	<div id="bodycontainer">
	    <div id="header">
		<div class="left"><object data="./images/ignicad.svg" type="image/svg+xml" ></object></div><div class="left"><span class="text"><?php echo $lang['EMAIL_DEAR'];
							    echo $fgmembersite->UserFullName(); ?>,&nbsp;<?php echo $lang['PLEASE_REFILL_BALANCE']; ?></span></div>
		<div class="right"><span class="menu"><a href='home.php'><?php echo $lang['BACK']; ?></a>&nbsp;<a href='logout.php'><?php echo $lang['LOGOUT']; ?></a></span>&nbsp;<span class="version"><?php echo $lang['SOFTWARE_VERSION']; ?></span></div>
	    </div>
	    <br>
	    <div id="szamitas" style="width: 1000px; height: auto; margin-bottom: 20px;" >
		<h1><?php echo $lang['YOUR_BALANCE']; ?></h1>
		<?php echo $lang['PROJECT_REMAINING']; ?><span class="cimsor" style="font-size:1.5em;"><?php echo $_SESSION['balance'] ?></span>
	    </div>
	    <br>
	    <div id="alul">
		<div id="szamitas" style="width: 480px; margin-right: 20px;" >
		    <h1>Egyenleg feltöltés átutalással</h1>
		    Kérjük utalja át az ártáblázatból kiválasztott összeget a 0000-0000 0000-0000 0000-0000 számú bankszámlaszámra, Gipsz Bt. részére.<br>
			<b>FONTOS! A közlemény rovatban tűntesse fel FELHASZNÁLÓNEVÉT!</b>
		</div>
		<div id="szamitas" style="width: 485px;" >
		    <h1>Egyenleg feltöltés kupon kóddal</h1>
		    <?php echo $lang['REFILL_BALANCE_WITH_CODE']; ?><input id="coupon_code" type="text" maxlength="16"><button id="refill" onclick="feltolt()"><?php echo $lang['REFILL']; ?></button>
		</div>
	    </div>
	</div>
	<script type="text/javascript">
	    if (window.XMLHttpRequest) {
		xmlhttp_feltolt = new XMLHttpRequest();
	    } else {
		xmlhttp_feltolt = new ActiveXObject("Microsoft.XMLHTTP");
	    }
	    function feltolt() {
		if (document.getElementById("coupon_code").value) {
		    xmlhttp_feltolt.onreadystatechange = function() {
			if (xmlhttp_feltolt.readyState == 4 && xmlhttp_feltolt.status == 200) {
			     if (xmlhttp_feltolt.responseText == "no") {
				 alert("Érvénytelen vagy lejárt kupon kód!");
			     } else if (xmlhttp_feltolt.responseText == "ok") {
				 alert("Sikeres kupon kód felhasználás!");
				 document.location.reload(true);
			     }
			}
		    }
		    kod = document.getElementById("coupon_code").value;
		    xmlhttp_feltolt.open("GET", "./admin.php?feltolt=" + kod, true);
		    xmlhttp_feltolt.setRequestHeader('Content-Type', 'text/xml');
		    xmlhttp_feltolt.send(null);
		}
	    }
	</script>
    </body>
</html>