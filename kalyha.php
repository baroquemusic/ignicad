<?php

require_once ("./include/kalyha_config.php");

if (isset($_GET['ora'])) {

    $kalyha->ora = $_GET['ora'];
    $kalyha->fa = $_GET['fa'];
    $kalyha->kw = $_GET['kw'];
    $kalyha->gomb = $_GET['gomb'];
    $kalyha->tuzfel = $_GET['tuzfel'];
    $kalyha->tfc = $_GET['tfc'];
    $kalyha->egyeniy = $_GET['egyeniy'];
    $kalyha->tuzalap = $_GET['tuzalap'];
    $kalyha->tac = $_GET['tac'];
    $kalyha->egyenix = $_GET['egyenix'];
    $kalyha->egyeniz = $_GET['egyeniz'];
    $kalyha->elevacio = $_GET['elevacio'];
    $kalyha->levegohom = $_GET['levegohom'];
    $kalyha->kalyhahej = $_GET['kalyhahej'];
    $kalyha->resmin = $_GET['resmin'];
    $kalyha->resmax = $_GET['resmax'];
    $kalyha->kilepo = $_GET['kilepo'];
    $kalyha->ag = $_GET['ag'];
    $kalyha->kileposzeles = $_GET['kileposzeles'];
    $kalyha->kilepomely = $_GET['kilepomely'];
    $kalyha->kilepomagas = $_GET['kilepomagas'];
    $kalyha->csox = $_GET['csox'];
    $kalyha->csoy = $_GET['csoy'];
    $kalyha->csoz = $_GET['csoz'];
    $kalyha->csoanyag = $_GET['csoanyag'];

    if ($kalyha->projektekBeir()) {
	echo "Combustion chamber is saved! ";
    } else {
	echo "Combustion chamber is not saved :( ";
	echo $kalyha->error_message;
    }
    
} elseif (isset($_GET['vanemar'])) {
    if ($_GET['vanemar'] == 0) {
	if (!$kalyha->keremAzAdatokat()) {
	    echo "nincs";
	} else {
	    echo json_encode($kalyha->valasz);
	    $_SESSION['projekt'] = $kalyha->valasz;
	}
    } else {
	if (!$kalyha->keremAzAdatokatIdAlapjan($_GET['vanemar'])) {
	    echo "keremAzAdatokatIdAlapjan HIBA ";
	} else {
	    echo json_encode($kalyha->valasz);
	    $_SESSION['projekt'] = $kalyha->valasz;
	}
    }
    
} elseif (isset($_GET['vanemarfust'])) {
    if ($_GET['vanemarfust'] == 0) {
	if (!$kalyha->keremAzAdatokatFustjarat()) {
	    echo "nincs";
	} else {
	    echo json_encode($kalyha->valasz);
	    $_SESSION['fust'] = $kalyha->valasz;
	}
    } else {
	if (!$kalyha->keremAzAdatokatFustjaratIdAlapjan($_GET['vanemarfust'])) {
	    echo "keremAzAdatokatFustjaratIdAlapjan HIBA ";
	} else {
	    echo json_encode($kalyha->valasz);
	    $_SESSION['fust'] = $kalyha->valasz;
	}
    }
} elseif (isset($_POST['fustjaratok'])) {
    $kalyha->fustjaratokadat = json_decode(stripslashes($_POST['fustjaratok']));
    
    if ($kalyha->fustjaratokBeir()) {
	echo json_encode($kalyha->szamitas);
    } else {
	echo "Flue pipes are not saved :( ";
	echo $kalyha->error_message;
    }
    
} elseif (isset($_POST['csakszamit'])) {
    $kalyha->fustjaratokadat = json_decode(stripslashes($_POST['csakszamit']));
    $kalyha->project_id_num = $_POST['ehhez'];
    if ($kalyha->szumma()) {
	echo json_encode($kalyha->szamitas);
	$_SESSION['szum'] = $kalyha->szamitas;
    } else {
	echo "No calculation :( ";
	echo $kalyha->error_message;
    }
    
} elseif (isset($_GET['project_name'])) {

    $kalyha->project_name = substr($kalyha->SanitizeForSQL($_GET['project_name']), 0, 128);
    $kalyha->cel = $_GET['cel'];
    $kalyha->ent_name = substr($kalyha->SanitizeForSQL($_GET['ent_name']), 0, 128);
    $kalyha->ent_addr_str = substr($kalyha->SanitizeForSQL($_GET['ent_addr_str']), 0, 128);
    $kalyha->ent_addr_town = substr($kalyha->SanitizeForSQL($_GET['ent_addr_town']), 0, 64);
    $kalyha->ent_addr_zip = substr($kalyha->SanitizeForSQL($_GET['ent_addr_zip']), 0, 16);
    $kalyha->ent_addr_country = substr($kalyha->SanitizeForSQL($_GET['ent_addr_country']), 0, 64);
    $kalyha->ent_taxnum = substr($kalyha->SanitizeForSQL($_GET['ent_taxnum']), 0, 16);
    $kalyha->cus_fullname = substr($kalyha->SanitizeForSQL($_GET['cus_fullname']), 0, 128);
    $kalyha->cus_phone_number = substr($kalyha->SanitizeForSQL($_GET['cus_phone_number']), 0, 16);
    $kalyha->cus_addr_street = substr($kalyha->SanitizeForSQL($_GET['cus_addr_street']), 0, 128);
    $kalyha->cus_addr_town = substr($kalyha->SanitizeForSQL($_GET['cus_addr_town']), 0, 64);
    $kalyha->cus_addr_zip = substr($kalyha->SanitizeForSQL($_GET['cus_addr_zip']), 0, 16);
    $kalyha->cus_addr_country = substr($kalyha->SanitizeForSQL($_GET['cus_addr_country']), 0, 64);

    if ($kalyha->projektekLezar()) {
	echo "Project closed! ";
    } else {
	echo "Project is not closed :( ";
	echo $kalyha->error_message;
    }
    
}

?>