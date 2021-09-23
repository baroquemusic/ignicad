<?php

if(isset($_GET['debug'])){
	ini_set('display_errors',1);
	ini_set('error_reporting', E_ALL);
}

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
    </head>
    <body><span class='error_message'><?php echo $kalyha -> GetErrorMessage(); ?></span>
	<div id="lepedo" onclick="eltunik()"></div>
		<div id="felugro" class="tab_body">
	    <div class="adattarolo" title="<?php echo $lang['TITLE_PROJECT_OPS4']; ?>">
		<span class="cimsor"><?php echo $lang['YOUR_BALANCE']; ?></span><br>
		<?php echo $lang['PROJECT_REMAINING']; ?><span class="cimsor" style="font-size:1.5em;" ><?php echo $_SESSION['balance'] ?></span>
	    </div>
	    <div class="adattarolo" title="<?php echo $lang['TITLE_PROJECT_OPS1']; ?>">
		<span class="cimsor"><?php echo $lang['PROJECT_NAME']; ?></span><input id="project_name" title="<?php echo $lang['TITLE_PROJECT_NAME']; ?>" type="text" maxlength="128" <?php if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; } ?>><br>
		<?php echo $lang['PURPOSE_OF_USE']; ?>
		<select id="cel" title="<?php echo $lang['TITLE_PURPOSE_OF_USE']; ?>"<?php if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; } ?>>
		    <option value="0"><?php echo $lang['SIZING']; ?></option>
		    <option value="1"><?php echo $lang['CHECKING']; ?></option>
		</select>
	    </div>
	    <div class="adattarolo" title="<?php echo $lang['TITLE_PROJECT_OPS2']; ?>">
    <?php 
    if (!$kalyha->vaneLezartProjektje()) {
    echo '<span class="cimsor">' . $lang['YOUR_ENTERPRISE'] . '</span><br>'
	. $lang['ENTERPRISE_NAME'] . '<input id="ent_name" type="text" maxlength="128"'; if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; }; echo '><br>'
	. $lang['ADDRESS_STREET'] . '<input id="ent_addr_str" type="text" maxlength="128"'; if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; }; echo '><br>'
	. $lang['ADDRESS_TOWN'] . '<input id="ent_addr_town" type="text" maxlength="64"'; if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; }; echo '><br>'
	. $lang['ADDRESS_ZIP'] . '<input id="ent_addr_zip" type="text" maxlength="16"'; if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; }; echo '><br>'
	. $lang['ADDRESS_COUNTRY'] . '<input id="ent_addr_country" type="text" value="' . $lang['COUNTRY'] . '" maxlength="64"'; if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; }; echo '><br>'
	. $lang['ENTERPRISE_TAX_NUMBER'] . '<input id="ent_taxnum" type="text" maxlength="16"'; if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; }; echo '><br>';
    } else {
    $sorok =  array();
    while ($row = mysql_fetch_assoc($kalyha->valasz)) {
    $sorok[] = $row;
    }
    $uccsosor = end($sorok);
    echo '<span class="cimsor">' . $lang['YOUR_ENTERPRISE'] . '</span><br>'
	. $lang['ENTERPRISE_NAME'] . '<input id="ent_name" type="text" value="' . $uccsosor[ent_name] . '" maxlength="128"'; if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; }; echo '><br>'
	. $lang['ADDRESS_STREET'] . '<input id="ent_addr_str" type="text" value="' . $uccsosor[ent_addr_str] . '" maxlength="128"'; if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; }; echo '><br>'
	. $lang['ADDRESS_TOWN'] . '<input id="ent_addr_town" type="text" value="' . $uccsosor[ent_addr_town] . '" maxlength="64"'; if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; }; echo '><br>'
	. $lang['ADDRESS_ZIP'] . '<input id="ent_addr_zip" type="text" value="' . $uccsosor[ent_addr_zip] . '" maxlength="16"'; if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; }; echo '><br>'
	. $lang['ADDRESS_COUNTRY'] . '<input id="ent_addr_country" type="text" value="' . $lang['COUNTRY'] . '" maxlength="64"'; if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; }; echo '><br>'
	. $lang['ENTERPRISE_TAX_NUMBER'] . '<input id="ent_taxnum" type="text" value="' . $uccsosor[ent_taxnum] . '" maxlength="16"'; if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; }; echo '><br>';
    }
    ?>
	    </div>
	     <div class="adattarolo" title="<?php echo $lang['TITLE_PROJECT_OPS3']; ?>">
		<span class="cimsor"><?php echo $lang['YOUR_CUSTOMER']; ?></span><br>
		<?php echo $lang['CUSTOMER_FULL_NAME']; ?><input id="cus_fullname" type="text" maxlength="128"<?php if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; } ?>><br>
		<?php echo $lang['CUSTOMER_PHONE_NUM']; ?><input id="cus_phone_number" type="text" maxlength="16" <?php if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; } ?> 
    value="<?php echo $lang['NOT_OBLIGATORY']; ?>" onfocus="if (this.value == '<?php echo $lang['NOT_OBLIGATORY']; ?>') { this.value=''};" onblur="if (this.value == '') { this.value='<?php echo $lang['NOT_OBLIGATORY']; ?>' }"><br>
		<?php echo $lang['ADDRESS_STREET']; ?><input id="cus_addr_street" type="text" maxlength="128"<?php if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; } ?>><br>
		<?php echo $lang['ADDRESS_TOWN']; ?><input id="cus_addr_town" type="text" maxlength="64"<?php if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; } ?>><br>
		<?php echo $lang['ADDRESS_ZIP']; ?><input id="cus_addr_zip" type="text" maxlength="16"<?php if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; } ?>><br>
		<?php echo $lang['ADDRESS_COUNTRY']; ?><input id="cus_addr_country" type="text" value="<?php echo $lang['COUNTRY']; ?>" maxlength="64"<?php if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; } ?>>
	    </div>
	    <div class="adattarolo">
		<?php echo '<button onclick="eltunik()" >' . $lang['CANCEL'] . '</button>&nbsp<button id="projzar" title="' . $lang['TITLE_CLOSE_PROJECT_BUTTON'] . '" onclick="projektlezaras()"' ?>
		<?php if (!$_SESSION['balance'] || $_SESSION['balance'] == 0) { echo 'disabled'; } ?>
		<?php echo ' >' . $lang['CLOSE_PROJECT'] . '</button>'; ?>
	    </div>
	</div>
	
	<div id="bodycontainer">
	    <div id="header">
		<div class="left"><object data="./images/ignicad.svg" type="image/svg+xml" ></object></div><div class="left"><span class="text"><?php echo $lang['EMAIL_DEAR']; echo $fgmembersite -> UserFullName(); ?>,&nbsp;<?php echo $lang['WELCOME_IN']; ?></span></div>
		<div class="right"><span class="menu"><a href='balance.php' title="<?php echo $lang['TITLE_BALANCE']; ?>"><?php echo $lang['BALANCE']; ?></a>&nbsp;<a href='change-pwd.php'title="<?php echo $lang['TITLE_RESET_PASSWORD']; ?>"><?php echo $lang['RESET_PASSWORD']; ?></a>&nbsp;<a href='logout.php' title="<?php echo $lang['TITLE_LOGOUT']; ?>"><?php echo $lang['LOGOUT']; ?></a></span>&nbsp;<span class="version"><?php echo $lang['SOFTWARE_VERSION']; ?></span></div>
	    </div>
	    <div id="modules">
		<div class="tabs">
		    <ul class="tabrow">
			<a href="#tab1"><li class="selected" title="<?php echo $lang['TITLE_COMBUSTION_CHAMBER']; ?>"><?php echo $lang['COMBUSTION_CHAMBER']; ?></li></a>
			<a href="#tab2"><li title="<?php echo $lang['TITLE_FLUE_PIPES']; ?>"><?php echo $lang['FLUE_PIPES']; ?></li></a>
			<a href="#tab3"><li title="<?php echo $lang['TITLE_MY_PROJECTS']; ?>"><?php echo $lang['MY_PROJECTS']; ?></li></a>
		    </ul>
		</div>
		<div id="tab1" class="tab_body">
		    <div class="bevitel" title="<?php echo $lang['TITLE_COMBUSTION_CHAMBER1']; ?>">
			<?php echo $lang['NOMINAL_HEATING_TIME']; ?> t<sub>n</sub> (<?php echo $lang['NOMINAL_HEATING_TIME_UNIT']; ?>)
			<input type="number" title="<?php echo $lang['TITLE_NOMINAL_HEATING_TIME']; ?>" id="ora" name="ora" min="1" max="24" value="12" onchange="valtozora(this.value)" />
			<input type="radio" title="<?php echo $lang['TITLE_NOMINAL_HEATING_TIME_RADIO']; ?>" id="gomb_ora" onclick="gomboraklikk()" /><br>
			<?php echo $lang['MAXIMUM_LOAD']; ?> m<sub>b</sub> (<?php echo $lang['MAXIMUM_LOAD_UNIT']; ?>)
			<input type="number" title="<?php echo $lang['TITLE_MAXIMUM_LOAD_UNIT']; ?>" id="fa" name="fa" min="1" max="99" value="15" onchange="valtozfa(this.value)" />
			<input type="radio" title="<?php echo $lang['TITLE_MAXIMUM_LOAD_UNIT_RADIO']; ?>" id="gomb_fa" onclick="gombfaklikk()" /><br>
			<?php echo $lang['NOMINAL_HEAT_OUTPUT']; ?> P<sub>n</sub> (<?php echo $lang['NOMINAL_HEAT_OUTPUT_UNIT']; ?>)
			<input type="number" title="<?php echo $lang['TITLE_NOMINAL_HEAT_OUTPUT']; ?>" id="kw" name="kw" min="1" max="99" value="5" onchange="valtozkw(this.value)" />
			<input type="radio" title="<?php echo $lang['TITLE_NOMINAL_HEAT_OUTPUT_RADIO']; ?>" id="gomb_kw" onclick="gombkwklikk()" />
			<input type="hidden" id="gomb" name="gomb" value="1" />
		    </div>
		    <div class="bevitel" title="<?php echo $lang['TITLE_COMBUSTION_CHAMBER2']; ?>">
			<?php echo $lang['COMBUSTION_CHAMBER_SURFACE']; ?> O<sub>br</sub> <input type="number" title="<?php echo $lang['TITLE_COMBUSTION_CHAMBER_SURFACE']; ?>" id="tuzfel" name="tuzfel" onchange="valtoztuzfel(this.value)" style="width:100px;" /><input type="checkbox"  title="<?php echo $lang['TITLE_COMBUSTION_CHAMBER_SURFACE_CHECKBOX']; ?>" id="tuzfelcheck" name="tuzfelcheck" onchange="tuzfelcheck(this.checked)" checked />&nbsp; 
			<?php echo $lang['COMBUSTION_CHAMBER_HEIGHT']; ?> H<sub>br</sub> <input type="number" title="<?php echo $lang['TITLE_COMBUSTION_CHAMBER_HEIGHT']; ?>" id="egyeniy" name="egyeniy" max="200" value="40" onchange="egyeniy(this.value)" /><sub> <?php echo $lang['CENTIMETER_UNIT']; ?></sub><br>
			<?php echo $lang['COMBUSTION_CHAMBER_AREA']; ?> A<sub>br</sub> <input type="number" title="<?php echo $lang['TITLE_COMBUSTION_CHAMBER_AREA']; ?>" id="tuzalap" name="tuzalap" onchange="valtoztuzalap(this.value)"  style="width:80px;" /><input type="checkbox" title="<?php echo $lang['TITLE_COMBUSTION_CHAMBER_AREA_CHECKBOX']; ?>" id="tuzalapcheck" name="tuzalapcheck" onchange="tuzalapcheck(this.checked)" checked />
			= &nbsp;<input type="number" id="egyenix" title="<?php echo $lang['TITLE_COMBUSTION_CHAMBER_AREA_X']; ?>" name="egyenix" min="5" max="200" value="10" onchange="egyenix(this.value)" />
			x <input type="number" id="egyeniz" title="<?php echo $lang['TITLE_COMBUSTION_CHAMBER_AREA_Y']; ?>" name="egyeniz" min="5" max="200" value="10" onchange="egyeniz(this.value)" /><sub> <?php echo $lang['CENTIMETER_UNIT']; ?></sub>
		    </div>
		    <div class="bevitel" title="<?php echo $lang['TITLE_COMBUSTION_CHAMBER3']; ?>">
			<?php echo $lang['ELEVATION']; ?>
			<input type="number" title="<?php echo $lang['TITLE_ELEVATION']; ?>" id="elevacio" name="elevacio" min="-200" max="8000" value="200" onchange="csocs()" /><sub> <?php echo $lang['ELEVATION_UNIT']; ?></sub>
			&nbsp; <?php echo $lang['AIR_TEMPERATURE']; ?>
			<input type="number" title="<?php echo $lang['TITLE_AIR_TEMPERATURE']; ?>" id="levegohom" name="levegohom" min="-40" max="30" value="20" onchange="csocs()" /><sub> <?php echo $lang['AIR_TEMPERATURE_UNIT']; ?></sub>
			&nbsp; 
			<select id="kalyhahej" title="<?php echo $lang['TITLE_SHELL']; ?>" name="kalyhahej" onchange="csocs()">
				<option value="1.3"><?php echo $lang['SINGLE_SHELL']; ?></option><option value="1.5"><?php echo $lang['DOUBLE_SHELL']; ?></option>
			</select>
			<br>
			<?php echo $lang['RESISTANCE_RANGE']; ?><sub><?php echo $lang['MIN']; ?></sub><input type="number" title="<?php echo $lang['TITLE_RESISTANCE_RANGE_MIN']; ?>" id="resmin" name="resmin" value="5" onchange="csocs()" />&nbsp;&mdash;
			<sub><?php echo $lang['MAX']; ?></sub><input type="number" title="<?php echo $lang['TITLE_RESISTANCE_RANGE_MAX']; ?>" id="resmax" name="resmax" value="25" onchange="csocs()" /> <sub>Pa</sub>
		    </div>
		</div>
		<div id="tab2" class="tab_body_pipe">
		    <div id="ujcsodiv0" title="<?php echo $lang['TITLE_COMBUSTION_CHAMBER_VENT1']; ?>" class="tuzbevitel" onmouseover="overkiir(0)" onmouseout="overtorol(0)">
			<?php echo $lang['COMBUSTION_CHAMBER_VENT']; ?>
			<select id="kilepo" title="<?php echo $lang['TITLE_COMBUSTION_CHAMBER_VENT']; ?>" name="kilepo" onchange="kilepooldal(this.value)">
				<option value="0"><?php echo $lang['VENT_UP']; ?></option><option value="1"><?php echo $lang['VENT_LEFT']; ?></option><option value="2"><?php echo $lang['VENT_RIGHT']; ?></option><option value="3"><?php echo $lang['VENT_BACK']; ?></option><option value="4"><?php echo $lang['VENT_LEFT-RIGHT']; ?></option> &nbsp; &nbsp;
			</select><br>
			<input type="button" id="kozepre" title="<?php echo $lang['TITLE_VENT_CENTER']; ?>" value="<?php echo $lang['VENT_CENTER']; ?>" onclick="csokozepre()" />
			<?php echo $lang['VENT_WIDTH']; ?><input type="number" title="<?php echo $lang['TITLE_VENT_WIDTH']; ?>" id="kileposzeles" name="kileposzeles" min="-200" max="200" value="0" onchange="csocs();" /><sub> <?php echo $lang['CENTIMETER_UNIT']; ?></sub>
			<?php echo $lang['VENT_DEPTH']; ?><input type="number" title="<?php echo $lang['TITLE_VENT_DEPTH']; ?>" id="kilepomely" name="kilepomely" min="-200" max="200" value="0" onchange="csocs();" /><sub> <?php echo $lang['CENTIMETER_UNIT']; ?></sub>
			<?php echo $lang['VENT_HEIGHT']; ?><input type="number" title="<?php echo $lang['TITLE_VENT_HEIGHT']; ?>" id="kilepomagas" name="kilepomagas" min="0" max="200" value="0" onchange="csocs();" /><sub> <?php echo $lang['CENTIMETER_UNIT']; ?></sub><br>
			<div class="csosorszam">1</div><?php echo $lang['PIPE_SECTION']; ?>
			<input type="number" id="csox0" title="<?php echo $lang['TITLE_PIPE_SECTION_X']; ?>" name="csox0" min="1" max="50" value="15" onchange="csocs()" />
			x
			<input type="number" id="csoy0" title="<?php echo $lang['TITLE_PIPE_SECTION_Y']; ?>" name="csoy0" min="1" max="50" value="15" onchange="csocs()" /><sub> <?php echo $lang['CENTIMETER_UNIT']; ?></sub>
			<?php echo $lang['PIPE_LENGTH']; ?>
			<input type="number" id="csoz0"  title="<?php echo $lang['TITLE_PIPE_SECTION_Z']; ?>" name="csoz0" min="1" max="200" value="40" onchange="csocs()" />
			<sub> <?php echo $lang['CENTIMETER_UNIT']; ?></sub><select title="<?php echo $lang['TITLE_PIPE_MATIERIAL']; ?>" id="csoanyag0" name="csoanyag0" onchange="csocs()">
				<option value="0.003"><?php echo $lang['PIPE_MATIERIAL_FIRECLAY_PLATE']; ?></option>
				<option value="0.002"><?php echo $lang['PIPE_MATIERIAL_FIRECLAY']; ?></option>
				<option value="0.001"><?php echo $lang['PIPE_MATIERIAL_STEEL']; ?></option>
				<option value="0.005"><?php echo $lang['PIPE_MATIERIAL_RAW1']; ?></option>
				<option value="0.00666"><?php echo $lang['PIPE_MATIERIAL_RAW2']; ?></option>
				<option value="0.00833"><?php echo $lang['PIPE_MATIERIAL_RAW3']; ?></option>
				<option value="0.01"><?php echo $lang['PIPE_MATIERIAL_RAW4']; ?></option>
			</select>
		    </div>
		    <div id="dinamikus"></div>
		    <div class="tuzbevitel">
			<button id="csotorles" title="<?php echo $lang['TITLE_DELETE']; ?>" onclick="ujcso(false)"><?php echo $lang['DELETE']; ?></button>
			<button id="jarathozzaadas" title="<?php echo $lang['TITLE_ADD_PIPE']; ?>" onclick="ujcso(true)"><?php echo $lang['ADD_PIPE']; ?></button>
		    </div>
		</div>
		<div id="tab3" class="tab_body_pipe">
<?php 
    echo '<div class="bevitel" title="' . $lang['TITLE_CURRENT_PROJECT'] . '"><span class="cimsor">' . $lang['CURRENT_PROJECT'] . '</span><br>'
    . $lang['PROJECT_REMAINING'] . '<span class="cimsor" style="font-size:1.5em;" >' . $_SESSION['balance'] . '</span><br>
    <button id="megsem" title="' . $lang['TITLE_BACK_TO_EDIT'] . '" onclick="document.location.reload(true)" >' . $lang['BACK_TO_EDIT'] . '</button>
    <button id="projektzaras" title="' . $lang['TITLE_CLOSE_PROJECT'] . '" onclick="felugrik()" disabled >' . $lang['CLOSE_PROJECT'] . '</button></div>';
    if (!$kalyha->valasz || mysql_num_rows($kalyha->valasz) <= 0) {
	echo '<div class="adattarolo" title="' . $lang['TITLE_NO_SAVED_PROJECT'] . '"><span class="cimsor">' . $lang['NO_SAVED_PROJECT'] . '</span></div>';
    } else {
	echo '<div class="adattarolo" title="' . $lang['TITLE_SAVED_PROJECTS'] . '"><span class="cimsor">' . $lang['SAVED_PROJECTS'] . '</span><br>
		<select title="' . $lang['TITLE_SAVED_PROJECTS_LIST'] . '" id="projektjeim" name="projektjeim" size="' . (mysql_num_rows($kalyha->valasz) + 1) . '" onchange="if(this.value) { vanemarkalyhaja(this.value); }" >';
	foreach ($sorok as $ertek) {
	    echo '<option value="' . $ertek[id_project] . '">' . substr($ertek[issue_datetime], 0, 10) . ' &nbsp; ' . $ertek[project_name] . ' / ' . $ertek[cus_fullname] . '</option>';
	}
	echo '</select>';
	echo '</div><div class="adattarolo"><button title="' . $lang['TITLE_CLONE_PROJECT'] . '" id="projektklonozas" onclick="projektklonozas=true;kilepooldal()" disabled >' . $lang['CLONE_PROJECT'] . '</button>&nbsp;
	    <button title="' . $lang['TITLE_INFO'] . '" id="info" onclick="felugrik()" disabled>Info</button>&nbsp;
	    <button title="' . $lang['TITLE_PRINT_PROJECT'] . '" id="projektnyomtatas" onclick="nyomtat()" disabled >' . $lang['PRINT_PROJECT'] . '</button></div>';
    }
?>
		</div>
	    </div>
	    <div id="viewcontrol3d">
		<input type="range" title="<?php echo $lang['TITLE_3D_RANGE']; ?>" id="poti_yforg" step="1" value="60" min="0" max="360" onchange="poti_yforg(this.value)" />
		<input type="number" title="<?php echo $lang['TITLE_3D_NUMBER']; ?>" id="szam_yforg" step="1" value="60" min="0" max="360" maxlength="3" onchange="szam_yforg(this.value)" onkeyup="szam_yforg(this.value)" />
		<select id="kapcs_drotrajz" title="<?php echo $lang['TITLE_PIPE_VIEW']; ?>" onchange="kapcs_drotrajz()">
		    <option value="0"><?php echo $lang['PIPE_TUBE']; ?></option><option value="1"><?php echo $lang['PIPE_CENTERLINE']; ?></option><option value="2"><?php echo $lang['PIPE_WIREFRAME']; ?></option>
		</select>
	    </div>
	<div id="container" title="<?php echo $lang['TITLE_3D']; ?>"><input type="checkbox" id="elag0" style="display: none;"></div>
	<div id="alul">
	    <div id="szamitas">
<?php
if ($_SESSION['admin'] == 0) {
    echo "Advertisement";
}
?>
		<div class="bal">
		    <div id="balbal" class="balbal"></div>
		    <div id="baljobb" class="baljobb"></div>
		</div>
		<div class="jobb">
		    <div id="jobbbal" class="jobbbal"></div>
		    <div id="jobbjobb" class="jobbjobb"></div>
		</div>
	    </div>
	    <div id="console" title="<?php echo $lang['TITLE_CONSOLE']; ?>">
		<div id="adatstatusfust"></div><div id="adatstatusprojekt"></div>
		<div id="warning"></div>
	    </div>
	</div>
	</div>
    <script type="text/javascript">
	
<?php
if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2) {
    echo "var dispable = true;";
} else {
    echo "var dispable = false;";
}
?>
	
	var Detector = {
	    canvas: !! window.CanvasRenderingContext2D,
	    webgl: ( function () { try { return !! window.WebGLRenderingContext && !! document.createElement( 'canvas' ).getContext( 'experimental-webgl' ); } catch( e ) { return false; } } )(),
	    workers: !! window.Worker,
	    fileapi: window.File && window.FileReader && window.FileList && window.Blob,

	    getWebGLErrorMessage: function () {
		var element = document.createElement( 'div' );
		element.id = 'webgl-error-message';
		element.style.fontFamily = 'monospace';
		element.style.fontSize = '13px';
		element.style.fontWeight = 'normal';
		element.style.textAlign = 'center';
		element.style.background = '#fff';
		element.style.color = '#000';
		element.style.padding = '1.5em';
		element.style.width = '400px';
		element.style.margin = '5em auto 0';
		if ( ! this.webgl ) {
			element.innerHTML = window.WebGLRenderingContext ? [
				'Your graphics card does not seem to support <a href="http://khronos.org/webgl/wiki/Getting_a_WebGL_Implementation" style="color:#000">WebGL</a>.<br />',
				'Find out how to get it <a href="http://get.webgl.org/" style="color:#000">here</a>.'
			].join( '\n' ) : [
				'Your browser does not seem to support <a href="http://khronos.org/webgl/wiki/Getting_a_WebGL_Implementation" style="color:#000">WebGL</a>.<br/>',
				'Find out how to get it <a href="http://get.webgl.org/" style="color:#000">here</a>.'
			].join( '\n' );
		}
		return element;
	    },
		    
	    addGetWebGLMessage: function ( parameters ) {
		var parent, id, element;
		parameters = parameters || {};
		parent = parameters.parent !== undefined ? parameters.parent : document.body;
		id = parameters.id !== undefined ? parameters.id : 'oldie';
		element = Detector.getWebGLErrorMessage();
		element.id = id;
		parent.appendChild( element );
	    }
	};
	
	arany = 100;
	container = document.getElementById('container');
	var scene = new THREE.Scene();
	var camera = new THREE.PerspectiveCamera(35, 5 / 6, 0.1, 1000);
	var renderer = Detector.webgl? new THREE.WebGLRenderer(): new THREE.CanvasRenderer();
	renderer.setSize(500, 600);
	container.appendChild(renderer.domElement);
	var light = new THREE.PointLight(0xCCCCCC);
	scene.add(new THREE.AmbientLight(0x333333));
	var materialcso = new THREE.MeshLambertMaterial({
		color : 0xffcc66
	});
	var materialcsoover = new THREE.MeshLambertMaterial({
		color : 0x00aaff
	});
	var materialvonal = new THREE.LineBasicMaterial({
	color: 0x000000, linewidth: 3
	});
	var csoproto = new THREE.CubeGeometry(1, 1, 1);
	var tuzterproto = new THREE.CubeGeometry(1, 1, 1);
	materialtuzter = [new THREE.MeshLambertMaterial({ color : 0xb6ffb6 }), new THREE.MeshLambertMaterial({ map: THREE.ImageUtils.loadTexture( './images/eleje.png' ) })];
	materialtuzter[1].transparent = true;
	tuzterproto.faces[ 0 ].materialIndex = 0;
	tuzterproto.faces[ 1 ].materialIndex = 0;
	tuzterproto.faces[ 2 ].materialIndex = 0;
	tuzterproto.faces[ 3 ].materialIndex = 0;
	tuzterproto.faces[ 4 ].materialIndex = 1;
	tuzterproto.faces[ 5 ].materialIndex = 0;
	var tuztermesh = new THREE.Mesh(tuzterproto, new THREE.MeshFaceMaterial(materialtuzter));
	var geovonal = new THREE.Geometry();
	geovonal.vertices.push(new THREE.Vector3(0, 0, 0));
	geovonal.vertices.push(new THREE.Vector3(0, 0, 1));
	geovonal.vertices.push(new THREE.Vector3(0, .05, .9));
	geovonal.vertices.push(new THREE.Vector3(0, -.05, .9));
	geovonal.vertices.push(new THREE.Vector3(0, 0, 1));
	geovonal.vertices.push(new THREE.Vector3(.05, 0, .9));
	geovonal.vertices.push(new THREE.Vector3(-.05, 0, .9));
	geovonal.vertices.push(new THREE.Vector3(0, 0, 1));
	var vonal = [];
	var vonaltukor = [];
	var csomesh = [];
	var csomeshtukor = [];
	var csomeshover = [];
	var csomeshovertukor = [];
	var dummy = [];
	var dummytukor = [];
	var dummyszemben = [];
	var dummyszembentukor = [];
	var csomeshtarto = [];
	var csomeshtartotukor = [];
	csomesh[0] = new THREE.Mesh(csoproto, materialcso);
	csomeshover[0] = new THREE.Mesh(csoproto, materialcsoover);
	csomeshover[0].visible = false;
	vonal[0] = new THREE.Line(geovonal, materialvonal);
	dummy[0] = new THREE.Object3D();
	dummyszemben[0] = new THREE.Object3D();
	csomeshtarto[0] = new THREE.Object3D();
	dummy[0].add(dummyszemben[0]);
	csomeshtarto[0].add(csomesh[0]);
	csomesh[0].add(csomeshover[0]);
	dummy[0].add(vonal[0]);
	scene.add(csomeshtarto[0]);
	scene.add(dummy[0]);

	csomeshtukor[0] = new THREE.Mesh(csoproto, materialcso);
	csomeshovertukor[0] = new THREE.Mesh(csoproto, materialcsoover);
	csomeshovertukor[0].visible = false;
	vonaltukor[0] = new THREE.Line(geovonal, materialvonal);
	dummytukor[0] = new THREE.Object3D();
	dummyszembentukor[0] = new THREE.Object3D();
	csomeshtartotukor[0] = new THREE.Object3D();
	dummytukor[0].add(dummyszembentukor[0]);
	csomeshtartotukor[0].add(csomeshtukor[0]);
	csomeshtukor[0].add(csomeshovertukor[0]);
	dummytukor[0].add(vonaltukor[0]);
	scene.add(csomeshtartotukor[0]);
	scene.add(dummytukor[0]);

	scene.add(tuztermesh);
	scene.add(light);
	vanemarkalyhaja();

	camera.position.set(0, 0, 8);
	var foroghat = false;
	container.addEventListener('click', function() {
		foroghat = true;
		requestAnimationFrame(animate);
	});
	var controls = new THREE.TrackballControls(camera, container);
	controls.addEventListener('change', render);
	controls.zoomSpeed = .07;
	controls.minDistance = 3;
	controls.maxDistance = 30;
	controls.dynamicDampingFactor = 0.1;
	animate();

	poti_yforg(60);

	function animate() {
		if (foroghat) {
			requestAnimationFrame(animate);
		}
		controls.update();
		camera.lookAt(scene.position);
	}

	function render() {
		light.position = camera.position;
		renderer.render(scene, camera);
	}
    </script>
    <script>
// GOOGLE ANALITYCS IDE JON
    </script>
    </body>
</html>