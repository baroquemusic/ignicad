<?php
require_once ("./include/membersite_config.php");
require_once ("./include/admin_config.php");

if (!$fgmembersite_log->CheckLogin()) {
    $fgmembersite_log->RedirectToURL("adminlogin.php");
    exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="<?php echo $lang['HTML_LANG']; ?>"
      lang="<?php echo $lang['HTML_LANG']; ?>">
    <head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<link rel="stylesheet" type="text/css" media="screen" href="./style/admin.css" />
	<title><?php echo $lang['ADMIN_PAGE_TITLE']; ?></title>
    </head>
    <body><span class='error_message'><?php echo $admin->GetErrorMessage(); ?></span>
	<div id="container">
	    <div class="left">Admin: <b><?php echo $fgmembersite->UserFullName(); ?></b></div>
	    <div class="right"><a href="adminlogout.php"><?php echo $lang['LOGOUT']; ?></a></div>
	</div>
	<div id="container">
	    <div id="row">
		<div id="left">Számlaszám:</div>
		<div id="right"><input type="text" name="sender_iban" id="sender_iban" maxlength="64" ></input></div>
	    </div>
	    <div id="row">
		<div id="left">Utaló neve:</div>
		<div id="right"><input type="text" name="sender_name" id="sender_name" maxlength="128" ></input></div>
	    </div>
	    <div id="row">
		<div id="left">Utalás dátuma:</div>
		<div id="right"><input type="text" name="transaction_datetime" id="transaction_datetime" maxlength="19" value="0000-00-00 00:00:00" style="width:300px;"></input></div>
	    </div>
	</div>
	<div id="container">
	    <div id="row">
		<div id="left">Kiállított szla. sorsz.:</div>
		<div id="right"><input type="text" name="bill" id="bill" maxlength="64" ></input></div>
	    </div>
	</div>
	<div id="container">
	    <div id="row">
		<div id="left">Összeg:</div>
		<div id="right"><input type="number" name="amount" id="amount" maxlength="16"></input></div>
	    </div>
	    <div id="row">
		<div id="left">Egységár:</div>
		<div id="right"><input type="number" name="unit_price" id="unit_price" maxlength="8"></input></div>
	    </div>
	</div>
	<div id="containercoupon">
	    <div id="row">
		<div id="left">Kupon <input type="checkbox" id="coupon" onclick="kupon(this.checked)"></input> vagy:</div>
		<div id="right">
		    <select id="username" onchange="user(this.value)">
			<option value="" selected>Válassz!</option>
			<?php
			foreach ($fgmembersite->Userek() as $key => $value) {
			    echo '<option value="' . $value . '">' . $value . '</option>';
			}
			?>
		    </select>
		    <div id="userkiir" style="display:inline;"></div>
		</div>
	    </div>
	</div>
	<div id="container">
	    <div id="row">
		<div id="left">Megjegyzés:</div>
		<div id="right"><textarea name="admin_notes" id="admin_notes" maxlength="512" rows="5"></textarea></div>
	    </div>
	</div>
	<div id="container">
	    <div class="right"><button id="mentgomb" onclick="adminment();ujkodok()">Mentés</button></div>
	</div>
	<div id="container">
	    <div id="row">
		<div id="left">Jogosultság:</div>
		<div id="right">
		    <select id="usernametanulo" onchange="usertanulo(this.value)">
			<option value="" selected>Válassz!</option>
			<?php
			foreach ($fgmembersite->Userek() as $key => $value) {
			    echo '<option value="' . $value . '">' . $value . '</option>';
			}
			?>
		    </select>
		    <div id="userkiirtanulo" style="display:inline;"></div>&nbsp;
		    <div id="tanulojogkiir" style="display:inline;visibility:hidden;">
			<select id="tanulojog" onchange="tanulojogtarol(this.value)"><option value="0">Felhasználó</option><option value="1">Admin</option><option value="2">Tanuló</option></select>&nbsp;
			<div id="tarolva" style="display:inline;color:#393;font-weight:bold;"></div>
		    </div>
		</div>
	    </div>
	</div>
	<div id="container">
	    <div id="row">
		<div id="left">Excel export:</div>
		<div id="right">
		    <select id="lista">
			<option value="1" selected>Felhasználók</option>
			<option value="2">Projektek</option>
			<option value="3">Utalások</option>
			<option value="4">Kuponok</option>
		    </select>
		    &nbsp; <button id="mentgomb" onclick="excel()">Export</button>
		</div>
	    </div>
	</div>
	<script type="text/javascript">
		    if (window.XMLHttpRequest) {
			xmlhttp_admin = new XMLHttpRequest();
			xmlhttp_adminjog = new XMLHttpRequest();
			xmlhttp_adminment = new XMLHttpRequest();
		    } else {
			xmlhttp_admin = new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp_adminjog = new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp_adminment = new ActiveXObject("Microsoft.XMLHTTP");
		    }

		    function excel() {
			ezt = document.getElementById("lista").value;
			window.open('admin.php?excel=' + ezt,'_blank','toolbar=yes,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=500,height=100');

		    }

		    function adminment() {
			ment = true;
			if (!document.getElementById("amount").value) {
			    document.getElementById("amount").style.borderColor = "#f00";
			    ment = false;
			} else {
			    amount = document.getElementById("amount").value;
			}
			if (!document.getElementById("unit_price").value) {
			    document.getElementById("unit_price").style.borderColor = "#f00";
			    ment = false;
			} else {
			    unit_price = document.getElementById("unit_price").value;
			}
			if (!document.getElementById("coupon").checked && !document.getElementById("username").value) {
			    document.getElementById("containercoupon").style.borderColor = "#f00";
			    ment = false;
			}
			
			if (!document.getElementById("sender_iban").value) {
			    sender_iban = "n/a";
			} else {
			    sender_iban = document.getElementById("sender_iban").value;
			}
			if (!document.getElementById("sender_name").value) {
			    sender_name = "n/a";
			} else {
			    sender_name = document.getElementById("sender_name").value;
			}
			if (!document.getElementById("transaction_datetime").value) {
			    transaction_datetime = "0000-00-00 00:00:00";
			} else {
			    transaction_datetime = document.getElementById("transaction_datetime").value;
			}
			if (!document.getElementById("bill").value) {
			    bill = "n/a";
			} else {
			    bill = document.getElementById("bill").value;
			}
			if (!document.getElementById("admin_notes").value) {
			    admin_notes = "n/a";
			} else {
			    admin_notes = document.getElementById("admin_notes").value;
			}
			
			if (ment && document.getElementById("username").value) {
			    document.getElementById("mentgomb").disabled = true;
			    xmlhttp_adminment.onreadystatechange = function() {
				if (xmlhttp_adminment.readyState == 4 && xmlhttp_adminment.status == 200) {
				    document.location.reload(true);
				}
			    }
			    id = document.getElementById("username").value;
			    xmlhttp_adminment.open("GET", "./admin.php?adminment=" + id + "&sender_iban=" + sender_iban + "&sender_name=" + sender_name + "&transaction_datetime=" 
				    + transaction_datetime + "&bill=" + bill + "&amount=" + amount + "&unit_price=" + unit_price + "&id_user=" + id_user + "&admin_notes=" + admin_notes, true);
			    xmlhttp_adminment.setRequestHeader('Content-Type', 'text/xml');
			    xmlhttp_adminment.send(null);
			} else if (ment && document.getElementById("coupon").checked) {
			    document.getElementById("mentgomb").disabled = true;
			    xmlhttp_adminment.onreadystatechange = function() {
				if (xmlhttp_adminment.readyState == 4 && xmlhttp_adminment.status == 200) {
				    document.location.reload(true);
				}
			    }
			    darab = Math.floor(document.getElementById("amount").value / document.getElementById("unit_price").value);
			    xmlhttp_adminment.open("GET", "./admin.php?kupon=" + darab + "&sender_iban=" + sender_iban + "&sender_name=" + sender_name + "&transaction_datetime=" 
				    + transaction_datetime + "&bill=" + bill + "&amount=" + amount + "&unit_price=" + unit_price + "&admin_notes=" + admin_notes, true);
			    xmlhttp_adminment.setRequestHeader('Content-Type', 'text/xml');
			    xmlhttp_adminment.send(null);
			}
		    }
		    
		    function ujkodok() {
			if (document.getElementById("coupon").checked) {
			    window.open('ujkodok.php','','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=300,height=700');
			}
		    }
		    
		    function kupon(na) {
			if (na) {
			    document.getElementById("username").disabled = true;
			} else {
			    document.getElementById("username").disabled = false;
			}
		    }
		    function user(na) {
			if (na == '') {
			    document.getElementById("coupon").disabled = false;
			    document.getElementById("userkiir").innerHTML = "";
			} else {
			    document.getElementById("coupon").disabled = true;
			    xmlhttp_admin.onreadystatechange = function() {
				if (xmlhttp_admin.readyState == 4 && xmlhttp_admin.status == 200) {
				    var ezjottvissza = xmlhttp_admin.responseText;
				    var adat = JSON.parse(ezjottvissza);
				    document.getElementById("userkiir").innerHTML = "&nbsp;" + adat['name'] + " &nbsp; " + adat['email'] + " &nbsp; " + adat['phone_number'];
				    id_user = adat['id_user'];
				}
			    }
			    xmlhttp_admin.open("GET", "./admin.php?username=" + na, true);
			    xmlhttp_admin.setRequestHeader('Content-Type', 'text/xml');
			    xmlhttp_admin.send(null);
			}
		    }
		    function usertanulo(na) {
			document.getElementById("tarolva").innerHTML = "";
			if (na == '') {
			    document.getElementById("userkiirtanulo").innerHTML = "";
			    document.getElementById("tanulojogkiir").style.visibility = "hidden";
			} else {
			    xmlhttp_admin.onreadystatechange = function() {
				if (xmlhttp_admin.readyState == 4 && xmlhttp_admin.status == 200) {
				    document.getElementById("tanulojogkiir").style.visibility = "visible";
				    var ezjottvissza = xmlhttp_admin.responseText;
				    var adat = JSON.parse(ezjottvissza);
				    document.getElementById("userkiirtanulo").innerHTML = "&nbsp;" + adat['name'];
				    if (adat['admin'] == 1) {
					document.getElementById("tanulojog").disabled = true;
				    } else {
					document.getElementById("tanulojog").disabled = false;
				    }
				    document.getElementById("tanulojog").value = adat['admin'];
				}
			    }
			    xmlhttp_admin.open("GET", "./admin.php?username=" + na, true);
			    xmlhttp_admin.setRequestHeader('Content-Type', 'text/xml');
			    xmlhttp_admin.send(null);
			}
		    }
		    function tanulojogtarol(na) {
			if (na == 0 || na == 2) {
			    xmlhttp_adminjog.onreadystatechange = function() {
				if (xmlhttp_adminjog.readyState == 4 && xmlhttp_adminjog.status == 200) {
				    document.getElementById("tarolva").innerHTML = xmlhttp_adminjog.responseText;
				}
			    }
			    id = document.getElementById("usernametanulo").value;
			    xmlhttp_adminjog.open("GET", "./admin.php?jogvalt=" + id + "&erre=" + na, true);
			    xmlhttp_adminjog.setRequestHeader('Content-Type', 'text/xml');
			    xmlhttp_adminjog.send(null);
			    document.getElementById("tarolva").innerHTML = "Tárolás...";
			} else {
			    document.getElementById("tarolva").innerHTML = "Ne má' he!";
			}
		    }

	</script>
    </body>
</html>
