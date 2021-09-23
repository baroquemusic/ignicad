<?php

require_once ("./include/admin_config.php");

if (isset($_GET['username'])) {
    $admin->username = $_GET['username'];
    if (!$admin->usernameAlapjanMinden()) {
	echo $admin->$error_message;
    } else {
	echo json_encode($admin->valasz);
    }
} elseif (isset($_GET['jogvalt'])) {
    $admin->username = $_GET['jogvalt'];
    $admin->jog = $_GET['erre'];
    if (!$admin->jogValt()) {
	echo $admin->$error_message;
    } else {
	echo "Jog tárolva!";
    }
} elseif (isset($_GET['adminment'])) {
    $admin->username = $_GET['adminment'];
    $admin->sender_iban = substr($admin->SanitizeForSQL($_GET['sender_iban']), 0, 64);
    $admin->sender_name = substr($admin->SanitizeForSQL($_GET['sender_name']), 0, 128);
    $admin->transaction_datetime = substr($admin->SanitizeForSQL($_GET['transaction_datetime']), 0, 19);
    $admin->bill = substr($admin->SanitizeForSQL($_GET['bill']), 0, 64);
    $admin->amount = $_GET['amount'];
    $admin->unit_price = $_GET['unit_price'];
    $admin->id_user = $_GET['id_user'];
    $admin->admin_notes = substr($admin->SanitizeForSQL($_GET['admin_notes']), 0, 512);
    
    if (!$admin->utalasokbaMent()) {
	echo $admin->$error_message;
    } else {
	echo "Utalásokba mentve!";
    }
} elseif (isset($_GET['kupon'])) {
    $admin->kupon = $_GET['kupon'];
    $admin->sender_iban = substr($admin->SanitizeForSQL($_GET['sender_iban']), 0, 64);
    $admin->sender_name = substr($admin->SanitizeForSQL($_GET['sender_name']), 0, 128);
    $admin->transaction_datetime = substr($admin->SanitizeForSQL($_GET['transaction_datetime']), 0, 19);
    $admin->bill = substr($admin->SanitizeForSQL($_GET['bill']), 0, 64);
    $admin->amount = $_GET['amount'];
    $admin->unit_price = $_GET['unit_price'];
    $admin->admin_notes = substr($admin->SanitizeForSQL($_GET['admin_notes']), 0, 512);
    
    if (!$admin->kuponKell()) {
	echo $admin->$error_message;
    } else {
	echo "Kupon tárolva!";
	$_SESSION['ujkodok'] = $admin->kodok;
    }
} elseif (isset($_GET['feltolt'])) {
    $admin->feltolt = substr($admin->SanitizeForSQL($_GET['feltolt']), 0, 5);
    if (!$admin->kupontFeltolt()) {
	echo "no";
    } else {
	echo "ok";
    }
} elseif (isset($_GET['excel'])) {
    if ($_GET['excel'] == '1') {
	if ($admin->listaFelhasznalok()) {
	    header("Content-type: application/vnd.ms-excel;");
	    header("Content-Disposition: attachment; filename=felhasznalok.xls");
	    header("Pragma: no-cache");
	    header("Expires: 0");
	    print mb_convert_encoding($admin->header . "\n" . $admin->data,'utf-16','utf-8');
	    exit;
	}
    } elseif ($_GET['excel'] == '2') {
	if ($admin->listaProjektek()) {
	    header("Content-type: application/vnd.ms-excel;");
	    header("Content-Disposition: attachment; filename=projektek.xls");
	    header("Pragma: no-cache");
	    header("Expires: 0");
	    print mb_convert_encoding($admin->header . "\n" . $admin->data,'utf-16','utf-8');
	    exit;
	}
    } elseif ($_GET['excel'] == '3') {
	if ($admin->listaUtalasok()) {
	    header("Content-type: application/vnd.ms-excel;");
	    header("Content-Disposition: attachment; filename=utalasok.xls");
	    header("Pragma: no-cache");
	    header("Expires: 0");
	    print mb_convert_encoding($admin->header . "\n" . $admin->data,'utf-16','utf-8');
	    exit;
	}
    } elseif ($_GET['excel'] == '4') {
	if ($admin->listaKuponok()) {
	    header("Content-type: application/vnd.ms-excel;");
	    header("Content-Disposition: attachment; filename=kuponok.xls");
	    header("Pragma: no-cache");
	    header("Expires: 0");
	    print mb_convert_encoding($admin->header . "\n" . $admin->data,'utf-16','utf-8');
	    exit;
	}
    }
}

?>