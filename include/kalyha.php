<?php

class KalyhaC3D
{

	var $ip;
	var $agent;
	var $connection;
	var $error_message;
	var $session_user_id;

	var $ora;
	var $fa;
	var $kw;
	var $gomb;
	var $tuzfel;
	var $tfc;
	var $egyeniy;
	var $tuzalap;
	var $tac;
	var $egyenix;
	var $egyeniz;
	var $elevacio;
	var $levegohom;
	var $kalyhahej;
	var $resmin;
	var $resmax;
	var $kilepo;
	var $ag;
	var $kileposzeles;
	var $kilepomely;
	var $kilepomagas;
	var $csox;
	var $csoy;
	var $csoz;
	var $csoanyag;

	var $project_id_num;
	var $betolt;
	var $valasz;
	var $lezart;

	var $projektadat;
	var $fustjaratokadat;

	var $project_name;
	var $cel;
	var $ent_name;
	var $ent_addr_str;
	var $ent_addr_town;
	var $ent_addr_zip;
	var $ent_addr_country;
	var $ent_taxnum;
	var $cus_fullname;
	var $cus_phone_number;
	var $cus_addr_street;
	var $cus_addr_town;
	var $cus_addr_zip;
	var $cus_addr_country;
	var $tizedes = 4;
	var $picitizedes = 2;

	var $projekt;

	function initDB($host, $user, $pass, $db, $users, $projects, $fluepipes)
	{
		$this->hostname = $host;
		$this->username = $user;
		$this->password = $pass;
		$this->database = $db;
		$this->felhasznalok = $users;
		$this->projektek = $projects;
		$this->fustjaratok = $fluepipes;
	}

	function loginDB()
	{
		if (!empty($_SERVER[HTTP_CLIENT_IP])) {
			$this->ip = $_SERVER[HTTP_CLIENT_IP];
		} elseif (!empty($_SERVER[HTTP_X_FORWARDED_FOR])) {
			$this->ip = $_SERVER[HTTP_X_FORWARDED_FOR];
		} else {
			$this->ip = $_SERVER[REMOTE_ADDR];
		}

		$this->connection = mysqli_connect($this->hostname, $this->username, $this->password);

		$this->agent = mysqli_real_escape_string($this->connection, $_SERVER[HTTP_USER_AGENT]);

		if (!$this->connection) {
			$this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
			return false;
		}
		if (!mysqli_select_db($this->connection, $this->database)) {
			$this->HandleDBError('Failed to select database: ' . $this->database . ' Please make sure that the database name provided is correct');
			return false;
		}
		if (!mysqli_query($this->connection, "SET NAMES 'UTF8'")) {
			$this->HandleDBError('Error setting utf8 encoding');
			return false;
		}
		return true;
	}

	function projektekBeir()
	{

		if (!$this->loginDB()) {
			$this->HandleError("Database login failed!");
			return false;
		}
		if (!$this->vaneProjektekTabla()) {
			return false;
		}
		if (!$this->vaneLezaratlanProjektje()) {
			$insert_query = 'INSERT INTO ' . $this->projektek . '(
	    id_user,
	    lastmod_datetime,
	    ora,
	    fa,
	    kw,
	    gomb,
	    tuzfel,
	    tfc,
	    egyeniy,
	    tuzalap,
	    tac,
	    egyenix,
	    egyeniz,
	    elevacio,
	    levegohom,
	    kalyhahej,
	    resmin,
	    resmax,
	    kilepo,
	    ag,
	    kileposzeles,
	    kilepomely,
	    kilepomagas,
	    csox,
	    csoy,
	    csoz,
	    csoanyag,
	    ip,
	    rendszer
	    )
	    VALUES
	    (
	    "' . $this->session_user_id . '",
	    CURRENT_TIMESTAMP,
	    "' . $this->ora . '",
	    "' . $this->fa . '",
	    "' . $this->kw . '",
	    "' . $this->gomb . '",
	    "' . $this->tuzfel . '",
	    "' . $this->tfc . '",
	    "' . $this->egyeniy . '",
	    "' . $this->tuzalap . '",
	    "' . $this->tac . '",
	    "' . $this->egyenix . '",
	    "' . $this->egyeniz . '",
	    "' . $this->elevacio . '",
	    "' . $this->levegohom . '",
	    "' . $this->kalyhahej . '",
	    "' . $this->resmin . '",
	    "' . $this->resmax . '",
	    "' . $this->kilepo . '",
	    "' . $this->ag . '",
	    "' . $this->kileposzeles . '",
	    "' . $this->kilepomely . '",
	    "' . $this->kilepomagas . '",
	    "' . $this->csox . '",
	    "' . $this->csoy . '",
	    "' . $this->csoz . '",
	    "' . $this->csoanyag . '",
	    "' . $this->ip . '",
	    "' . $this->agent . '"
	    )';
			if (!mysqli_query($this->connection, $insert_query)) {
				$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
				return false;
			}
		}

		$update_query = 'UPDATE ' . $this->projektek . ' SET
	lastmod_datetime = CURRENT_TIMESTAMP,
	ora = "' . $this->ora . '",
	fa = "' . $this->fa . '",
	kw = "' . $this->kw . '",
	gomb = "' . $this->gomb . '",
	tuzfel = "' . $this->tuzfel . '",
	tfc = "' . $this->tfc . '",
	egyeniy = "' . $this->egyeniy . '",
	tuzalap = "' . $this->tuzalap . '",
	tac = "' . $this->tac . '",
	egyenix = "' . $this->egyenix . '",
	egyeniz = "' . $this->egyeniz . '",
	elevacio = "' . $this->elevacio . '",
	levegohom = "' . $this->levegohom . '",
	kalyhahej = "' . $this->kalyhahej . '",
	resmin = "' . $this->resmin . '",
	resmax = "' . $this->resmax . '",
	kilepo = "' . $this->kilepo . '",
	ag = "' . $this->ag . '",
	kileposzeles = "' . $this->kileposzeles . '",
	kilepomely = "' . $this->kilepomely . '",
	kilepomagas = "' . $this->kilepomagas . '",
	csox = "' . $this->csox . '",
	csoy = "' . $this->csoy . '",
	csoz = "' . $this->csoz . '",
	csoanyag = "' . $this->csoanyag . '",
	ip = "' . $this->ip . '",
	rendszer = "' . $this->agent . '"
	WHERE
	id_project = "' . $this->project_id_num . '"';

		if (!mysqli_query($this->connection, $update_query)) {
			$this->HandleDBError("Error updating data to the table\nquery:$update_query");
			return false;
		}
		return true;
	}

	function projektekLezar()
	{

		if (!$this->loginDB()) {
			$this->HandleError("Database login failed!");
			return false;
		}
		if (!$this->vaneProjektekTabla()) {
			return false;
		}
		if ($this->vaneLezaratlanProjektje()) {
			$update_query = 'UPDATE ' . $this->projektek . ' SET
	    issue_datetime = CURRENT_TIMESTAMP,
	    project_name = "' . $this->project_name . '",
	    cel = "' . $this->cel . '",
	    ent_name = "' . $this->ent_name . '",
	    ent_addr_str = "' . $this->ent_addr_str . '",
	    ent_addr_town = "' . $this->ent_addr_town . '",
	    ent_addr_zip = "' . $this->ent_addr_zip . '",
	    ent_addr_country = "' . $this->ent_addr_country . '",
	    ent_taxnum = "' . $this->ent_taxnum . '",
	    cus_fullname = "' . $this->cus_fullname . '",
	    cus_phone_number = "' . $this->cus_phone_number . '",
	    cus_addr_street = "' . $this->cus_addr_street . '",
	    cus_addr_town = "' . $this->cus_addr_town . '",
	    cus_addr_zip = "' . $this->cus_addr_zip . '",
	    cus_addr_country = "' . $this->cus_addr_country . '",
	    ip = "' . $this->ip . '",
	    rendszer = "' . $this->agent . '"
	    WHERE
	    id_project = "' . $this->project_id_num . '"';

			if (!mysqli_query($this->connection, $update_query)) {
				$this->HandleDBError("Error updating data to the table\nquery:$update_query");
				return false;
			}
			return true;
		}
	}

	function vaneLezaratlanProjektje()
	{
		$result = mysqli_query($this->connection, "SELECT id_project FROM $this->projektek WHERE id_user = '$this->session_user_id' AND issue_datetime = '0000-00-00 00:00:00'");
		if (!$result || mysqli_num_rows($result) <= 0) {
			return false;
		}
		$row = mysqli_fetch_assoc($result);
		$this->project_id_num = $row[id_project];
		return true;
	}

	function vaneLezartProjektje()
	{
		if (!$this->loginDB()) {
			$this->HandleError("Database login failed!");
			return false;
		}
		$query = "SELECT id_project, project_name, cel, issue_datetime, cus_fullname, ent_name, ent_addr_str, ent_addr_town, ent_addr_zip, ent_addr_country, ent_taxnum FROM $this->projektek WHERE id_user = '$this->session_user_id' AND issue_datetime != '0000-00-00 00:00:00'";

		$result = mysqli_query($this->connection, $query);
		if (!$result || mysqli_num_rows($result) <= 0) {
			return false;
		}
		$this->valasz = $result;
		$this->lezart = mysqli_num_rows($result);
		return true;
	}

	function keremAzAdatokat()
	{
		if (!$this->loginDB()) {
			$this->HandleError("Database login failed!");
			return false;
		}
		if (!$this->vaneProjektekTabla()) {
			return false;
		}
		if (!$this->vaneLezaratlanProjektje()) {
			return false;
		}
		$result = mysqli_query($this->connection, "SELECT * FROM $this->projektek WHERE id_user = '$this->session_user_id' AND issue_datetime = '0000-00-00 00:00:00'");
		$this->valasz = mysqli_fetch_assoc($result);
		return true;
	}

	function keremAzAdatokatIdAlapjan($ezazidkell)
	{
		if (!$this->loginDB()) {
			$this->HandleError("Database login failed!");
			return false;
		}
		$result = mysqli_query($this->connection, "SELECT * FROM $this->projektek WHERE id_project = '$ezazidkell'");

		$this->valasz = mysqli_fetch_assoc($result);
		return true;
	}

	function keremAzAdatokatFustjaratIdAlapjan($ezazidkell)
	{
		if (!$this->loginDB()) {
			$this->HandleError("Database login failed!");
			return false;
		}

		$result = mysqli_query($this->connection, "SELECT * FROM $this->fustjaratok WHERE id_project = '$ezazidkell'");

		$arraylist = array();

		while ($row = mysqli_fetch_assoc($result)) {
			$arraylist[] = $row;
		}

		$this->valasz = $arraylist;

		if (!$result || mysqli_num_rows($result) <= 0) {
			return false;
		} else {
			return true;
		}
	}


	function vaneProjektekTabla()
	{
		$result = mysqli_query($this->connection, "SHOW COLUMNS FROM $this->projektek");
		if (!$result || mysqli_num_rows($result) <= 0) {
			return $this->csinaljProjektekTablat();
		}
		return true;
	}

	function csinaljProjektekTablat()
	{
		$qry = "CREATE TABLE $this->projektek (
id_project INT NOT NULL AUTO_INCREMENT,
id_user INT ( 7 ) DEFAULT '0',
project_name VARCHAR ( 128 ) DEFAULT '',
cel TINYINT ( 1 ) DEFAULT '0',
start_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
lastmod_datetime TIMESTAMP DEFAULT '0000-00-00 00:00:00',
issue_datetime TIMESTAMP DEFAULT '0000-00-00 00:00:00',

ent_name VARCHAR ( 128 ) DEFAULT '',
ent_addr_str VARCHAR ( 128 ) DEFAULT '',
ent_addr_town VARCHAR ( 64 ) DEFAULT '',
ent_addr_zip VARCHAR ( 16 ) DEFAULT '',
ent_addr_country VARCHAR ( 64 ) DEFAULT '',
ent_taxnum VARCHAR ( 16 ) DEFAULT '',
cus_fullname VARCHAR ( 128 ) DEFAULT '',
cus_phone_number VARCHAR ( 16 ) DEFAULT '',
cus_addr_street VARCHAR ( 128 ) DEFAULT '',
cus_addr_town VARCHAR ( 64 ) DEFAULT '',
cus_addr_zip VARCHAR ( 16 ) DEFAULT '',
cus_addr_country VARCHAR ( 64 ) DEFAULT '',

ora FLOAT ( 8, 5 ) DEFAULT '0',
fa FLOAT ( 8, 5 ) DEFAULT '0',
kw FLOAT ( 8, 5 ) DEFAULT '0',
gomb INT ( 1 ) DEFAULT '0',
tuzfel FLOAT ( 13, 5 ) DEFAULT '0',
tfc TINYINT ( 1 ) DEFAULT NULL,
egyeniy FLOAT ( 8, 5 ) DEFAULT '0',
tuzalap FLOAT ( 12, 5 ) DEFAULT '0',
tac TINYINT ( 1 ) DEFAULT NULL,	
egyenix FLOAT ( 8, 5 ) DEFAULT '0',
egyeniz FLOAT ( 8, 5 ) DEFAULT '0',
elevacio INT ( 4 ) DEFAULT '0',
levegohom INT ( 2 ) DEFAULT '0',
kalyhahej FLOAT ( 2, 1 ) DEFAULT '0',
resmin FLOAT ( 8, 5 ) DEFAULT '0',
resmax FLOAT ( 8, 5 ) DEFAULT '0',

kilepo INT ( 1 ) DEFAULT '0',
ag TINYINT ( 1 ) DEFAULT NULL,
kileposzeles FLOAT ( 8, 5 ) DEFAULT '0',
kilepomely FLOAT ( 8, 5 ) DEFAULT '0',
kilepomagas FLOAT ( 8, 5 ) DEFAULT '0',
csox FLOAT ( 8, 5 ) DEFAULT '0',
csoy FLOAT ( 8, 5 ) DEFAULT '0',
csoz FLOAT ( 8, 5 ) DEFAULT '0',
csoanyag FLOAT ( 6, 5 ) DEFAULT '0',
ip VARCHAR ( 39 ) DEFAULT '',
rendszer VARCHAR ( 512 ) DEFAULT '',

PRIMARY KEY ( id_project ) ";

		if (!mysqli_query($this->connection, $qry)) {
			$this->HandleDBError("Error creating the table \nquery was\n $qry");
			return false;
		}
		return true;
	}

	function fustjaratokBeir()
	{

		if (!$this->loginDB()) {
			$this->HandleError("Database login failed!");
			return false;
		}
		if (!$this->vaneFustjaratokTabla()) {
			return false;
		}
		if (!$this->vaneLezaratlanProjektje()) {
			return false;
		}

		mysqli_query($this->connection, "DELETE FROM $this->fustjaratok WHERE id_project = '$this->project_id_num'");

		$jaratokszama = count($this->fustjaratokadat->ag);

		for ($i = 0; $i < $jaratokszama; $i++) {

			$ag = $this->fustjaratokadat->ag[$i];
			$fugg = $this->fustjaratokadat->fugg[$i];
			$viz = $this->fustjaratokadat->viz[$i];
			$csox = $this->fustjaratokadat->csox[$i];
			$csoy = $this->fustjaratokadat->csoy[$i];
			$csoz = $this->fustjaratokadat->csoz[$i];
			$csoanyag = $this->fustjaratokadat->csoanyag[$i];
			$phi = $this->fustjaratokadat->phi[$i];
			$h = $this->fustjaratokadat->h[$i];

			$insert_query = "INSERT INTO $this->fustjaratok (id_project, ag, fugg, viz, csox, csoy, csoz, csoanyag, phi, h) VALUES ($this->project_id_num, $ag, $fugg, $viz, $csox, $csoy, $csoz, $csoanyag, $phi, $h)";

			if (!mysqli_query($this->connection, $insert_query)) {
				$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
				return false;
			}
		}
		///////////////////////
		if ($this->szumma()) {
			return true;
		}
		///////////////////////
	}

	function keremAzAdatokatFustjarat()
	{
		if (!$this->loginDB()) {
			$this->HandleError("Database login failed!");
			return false;
		}
		if (!$this->vaneFustjaratokTabla()) {
			return false;
		}
		if (!$this->vaneLezaratlanProjektje()) {
			return false;
		}

		$result = mysqli_query($this->connection, "SELECT * FROM $this->fustjaratok WHERE id_project = '$this->project_id_num'");

		$arraylist = array();

		while ($row = mysqli_fetch_assoc($result)) {
			$arraylist[] = $row;
		}

		$this->valasz = $arraylist;

		if (!$result || mysqli_num_rows($result) <= 0) {
			return false;
		} else {
			return true;
		}
	}

	function vaneFustjaratokTabla()
	{
		$result = mysqli_query($this->connection, "SHOW COLUMNS FROM $this->fustjaratok");
		if (!$result || mysqli_num_rows($result) <= 0) {
			return $this->csinaljFustjaratokTablat();
		}
		return true;
	}

	function csinaljFustjaratokTablat()
	{
		$qry = "CREATE TABLE $this->fustjaratok (
id_pipe BIGINT NOT NULL AUTO_INCREMENT,
id_project INT ( 7 ) NOT NULL,

ag TINYINT ( 1 ) DEFAULT NULL,
fugg INT ( 3 ) NOT NULL,
viz INT ( 3 ) NOT NULL,
csox FLOAT ( 8, 5 ) NOT NULL,
csoy FLOAT ( 8, 5 ) NOT NULL,
csoz FLOAT ( 8, 5 ) NOT NULL,
csoanyag FLOAT ( 6, 5 ) NOT NULL,
phi FLOAT ( 8, 5 ) NOT NULL,
h FLOAT ( 8, 5 ) NOT NULL,

PRIMARY KEY ( id_pipe ) )";

		if (!mysqli_query($this->connection, $qry)) {
			$this->HandleDBError("Error creating the table \nquery was\n $qry");
			return false;
		}
		return true;
	}

	////// !!! IGNEACALC !!! //////////////

	function szumma()
	{
		if (!$this->loginDB()) {
			$this->HandleError("Database login failed!");
			return false;
		}
		$qry = mysqli_query($this->connection, "SELECT ora, fa, kw, tuzfel, egyeniy, tuzalap, egyenix, egyeniz, elevacio, levegohom, kalyhahej, resmin, resmax, ag, kilepomagas, csox, csoy, csoz, csoanyag FROM $this->projektek WHERE id_project = '$this->project_id_num'");
		$projektadat = mysqli_fetch_assoc($qry);

		array_unshift($this->fustjaratokadat->ag, $projektadat[ag]);
		array_unshift($this->fustjaratokadat->fugg, 0);
		array_unshift($this->fustjaratokadat->viz, 0);
		array_unshift($this->fustjaratokadat->csox, $projektadat[csox]);
		array_unshift($this->fustjaratokadat->csoy, $projektadat[csoy]);
		array_unshift($this->fustjaratokadat->csoz, $projektadat[csoz]);
		array_unshift($this->fustjaratokadat->csoanyag, $projektadat[csoanyag]);
		array_unshift($this->fustjaratokadat->phi, 0);
		array_unshift($this->fustjaratokadat->h, $projektadat[kilepomagas] / 100);

		$szam = array();
		$szumszam = array();
		$L = 0;
		$voltszamitas = false;
		$fustjarathossz = sqrt($projektadat[fa]) * $projektadat[kalyhahej];
		$Fs = 1 / (pow(2.718281828, (-9.81 * $projektadat[elevacio]) / 78624));

		for ($i = 0; $i < count($this->fustjaratokadat->ag); $i++) {

			if ($this->fustjaratokadat->ag[$i] != 0) {
				$szam[$i][0] = 2;
			} else {
				$szam[$i][0] = 1;
			}
			$szam[$i][1] = $this->fustjaratokadat->fugg[$i];
			$szam[$i][2] = $this->fustjaratokadat->viz[$i];
			$szam[$i][3] = $this->fustjaratokadat->csox[$i] / 100;
			$szam[$i][4] = $this->fustjaratokadat->csoy[$i] / 100;
			$szam[$i][5] = $this->fustjaratokadat->csoz[$i] / 100 * sqrt($szam[$i][0]); // aktualis szakasz hossz l
			$L += $szam[$i][5];
			$szam[$i][6] = $this->fustjaratokadat->csoanyag[$i];
			if ($i == 0) {
				$szam[$i][7] = $szam[$i][8] = $szam[$i][3] * $szam[$i][4]; // terulet pont es szakasz
				$szam[$i][9] = $szam[$i][10] = ($szam[$i][3] + $szam[$i][4]) * 2; // kerulet pont es szakasz
			} else {
				$szam[$i][7] = min($szam[$i][3] * $szam[$i][4], $szam[$i - 1][3] * $szam[$i - 1][4]); // terulet pont
				$szam[$i][8] = $szam[$i][3] * $szam[$i][4]; // terulet szakasz
				$szam[$i][9] = min(($szam[$i][3] + $szam[$i][4]) * 2, ($szam[$i - 1][3] + $szam[$i - 1][4]) * 2); // kerulet pont
				$szam[$i][10] = ($szam[$i][3] + $szam[$i][4]) * 2; // kerulet szakasz
			}
			$szam[$i][11] = $L - $szam[$i][5]; // a pont tuztertol valo tavolsaga
			//	    $szumszam[tavp][$i] = round($szam[$i][11], $this->tizedes);
			$szam[$i][12] = $szam[$i][11] + ($szam[$i][5] / 2); // szakasz tuztertol valo tavolsaga
			//	    $szumszam[tavs][$i] = round($szam[$i][12], $this->tizedes);
			$szam[$i][13] = $szam[$i][7] * 4 / $szam[$i][9]; // Dh pont
			//	    $szumszam[dhp][$i] = round($szam[$i][13], $this->tizedes);
			$szam[$i][14] = $szam[$i][8] * 4 / $szam[$i][10]; // Dh szakasz
			//	    $szumszam[dhs][$i] = round($szam[$i][14], $this->tizedes);
			$szam[$i][15] = pow(2.718, (-0.83 * $szam[$i][11] / $fustjarathossz)) * 550; // t - pont
			$szumszam[tp][$i] = round($szam[$i][15], $this->tizedes);
			$szam[$i][16] = pow(2.718, (-0.83 * $szam[$i][12] / $fustjarathossz)) * 550; // t - szakasz
			$szumszam[ts][$i] = round($szam[$i][16], $this->tizedes);
			$szam[$i][17] = ($szam[$i][15] + 273) / 273; // Ft pont
			$szam[$i][18] = ($szam[$i][16] + 273) / 273; // Ft szakasz
			$szam[$i][19] = 1.282 / ($szam[$i][17] * $Fs); // Pg pont
			//	    $szumszam[pgp][$i] = round($szam[$i][19], $this->tizedes);
			$szam[$i][20] = 1.282 / ($szam[$i][18] * $Fs); // Pg szakasz
			//	    $szumszam[pgs][$i] = round($szam[$i][20], $this->tizedes);
			if ($i > 0 && $szam[$i - 1][0] == 1 && $szam[$i][0] == 2) {
				$szam[$i][21] = $projektadat[fa] * .00273 * $szam[$i][17] * $Fs; // Vg m3/sec pont
			} else {
				$szam[$i][21] = $projektadat[fa] * .00273 * $szam[$i][17] * $Fs / $szam[$i][0]; // Vg m3/sec pont
			}
			//	    $szumszam[vgp][$i] = round($szam[$i][21], $this->tizedes);
			$szam[$i][22] = $projektadat[fa] * .00273 * $szam[$i][18] * $Fs / $szam[$i][0]; // Vg m3/sec szakasz
			$szumszam[vgs][$i] = round($szam[$i][22], $this->tizedes);
			$szam[$i][23] = $szam[$i][21] / $szam[$i][7]; // v m2/sec pont
			//	    $szumszam[vp][$i] = round($szam[$i][23], $this->tizedes);
			$szam[$i][24] = $szam[$i][22] / $szam[$i][8]; // v m2/sec szakasz
			$szumszam[vs][$i] = round($szam[$i][24], $this->tizedes);
			$szam[$i][25] = 1 / pow(1.14 + 2 * log10($szam[$i][14] / $szam[$i][6]), 2); // lambda f
			//	    $szumszam[lam][$i] = round($szam[$i][25], $this->tizedes);
			if ($i == 0) {
				$szam[$i][26] = 0; // !!!! EZT MAJD AT KELL IRNI HA KILEPO SZOGET KAPHAT !!!!
			} else {
				$szam[$i][26] = $this->zetatabla(5 * (round($this->fustjaratokadat->phi[$i] / 5)), max($szam[$i][0], $szam[$i - 1][0]) / min($szam[$i][0], $szam[$i - 1][0])); // iranyvaltas zeta
			}
			if ($i > 0 && $i < count($this->fustjaratokadat->ag) - 1) {
				if ($szam[$i][14] > $this->fustjaratokadat->csoz[$i] / 100 && $voltszamitas) {
					$szam[$i][27] = ($this->fustjaratokadat->phi[$i] / ($this->fustjaratokadat->phi[$i] + $this->fustjaratokadat->phi[$i + 1])) * ($this->zetatabla(5 *
						(round((180 - $this->fustjaratokadat->phi[$i] - $this->fustjaratokadat->phi[$i + 1]) / 5)), $szam[$i][0]) - $this->zetatabla(5 * (round($this->fustjaratokadat->phi[$i + 1] / 5)), $szam[$i][0])
						- $this->zetatabla(5 * (round($this->fustjaratokadat->phi[$i] / 5)), $szam[$i][0])) * (1 - $this->fustjaratokadat->csoz[$i] / 100 / $szam[$i][14])
						+
						($this->fustjaratokadat->phi[$i] / ($this->fustjaratokadat->phi[$i] + $this->fustjaratokadat->phi[$i - 1])) * ($this->zetatabla(5 *
							(round((180 - $this->fustjaratokadat->phi[$i - 1] - $this->fustjaratokadat->phi[$i]) / 5)), $szam[$i][0]) - $this->zetatabla(5 * (round($this->fustjaratokadat->phi[$i] / 5)), $szam[$i][0])
							- $this->zetatabla(5 * (round($this->fustjaratokadat->phi[$i - 1] / 5)), $szam[$i - 1][0])) * (1 - $this->fustjaratokadat->csoz[$i - 1] / 100 / $szam[$i - 1][14]); // iranyvaltas l < Dh
					$voltszamitas = true;
				} else if ($szam[$i][14] > $this->fustjaratokadat->csoz[$i] / 100) {
					$szam[$i][27] = ($this->fustjaratokadat->phi[$i] / ($this->fustjaratokadat->phi[$i] + $this->fustjaratokadat->phi[$i + 1])) * ($this->zetatabla(5 *
						(round((180 - $this->fustjaratokadat->phi[$i] - $this->fustjaratokadat->phi[$i + 1]) / 5)), $szam[$i][0]) - $this->zetatabla(5 * (round($this->fustjaratokadat->phi[$i + 1] / 5)), $szam[$i][0])
						- $this->zetatabla(5 * (round($this->fustjaratokadat->phi[$i] / 5)), $szam[$i][0])) * (1 - $this->fustjaratokadat->csoz[$i] / 100 / $szam[$i][14]); // iranyvaltas l < Dh
					$voltszamitas = true;
				} else if ($voltszamitas) {
					$szam[$i][27] = ($this->fustjaratokadat->phi[$i] / ($this->fustjaratokadat->phi[$i] + $this->fustjaratokadat->phi[$i - 1])) * ($this->zetatabla(5 *
						(round((180 - $this->fustjaratokadat->phi[$i - 1] - $this->fustjaratokadat->phi[$i]) / 5)), $szam[$i][0]) - $this->zetatabla(5 * (round($this->fustjaratokadat->phi[$i] / 5)), $szam[$i][0])
						- $this->zetatabla(5 * (round($this->fustjaratokadat->phi[$i - 1] / 5)), $szam[$i - 1][0])) * (1 - $this->fustjaratokadat->csoz[$i - 1] / 100 / $szam[$i - 1][14]); // iranyvaltas l < Dh
					$voltszamitas = false;
				} else {
					$szam[$i][27] = 0;
				}
			} else if ($voltszamitas) {
				$szam[$i][27] = ($this->fustjaratokadat->phi[$i] / ($this->fustjaratokadat->phi[$i] + $this->fustjaratokadat->phi[$i - 1])) * ($this->zetatabla(5 *
					(round((180 - $this->fustjaratokadat->phi[$i - 1] - $this->fustjaratokadat->phi[$i]) / 5)), $szam[$i][0]) - $this->zetatabla(5 * (round($this->fustjaratokadat->phi[$i] / 5)), $szam[$i][0])
					- $this->zetatabla(5 * (round($this->fustjaratokadat->phi[$i - 1] / 5)), $szam[$i - 1][0])) * (1 - $this->fustjaratokadat->csoz[$i - 1] / 100 / $szam[$i - 1][14]); // iranyvaltas l < Dh
				$voltszamitas = false;
			} else {
				$szam[$i][27] = 0;
			}
			if ($i == 0) {
				$sokszamjegy = $szam[$i][8] / ($projektadat[tuzalap] / 10000);
				$sokszamjegyleker = floor($sokszamjegy * 10) / 10;
				$sokszamjegyfelker = ceil($sokszamjegy * 10) / 10;
				$zetaleker = $this->kiszetatabla($sokszamjegyleker, 2);
				$zetafelker = $this->kiszetatabla($sokszamjegyfelker, 2);
				$szam[$i][28] = (($sokszamjegy - $sokszamjegyleker) / 0.1) * ($zetaleker - $zetafelker) + $zetafelker; // szukules - tagulas kileponel
			} else {
				if ($szam[$i][8] == min($szam[$i][8], $szam[$i - 1][8])) {
					$ebbol = 2;
				} else {
					$ebbol = 1;
				}
				$sokszamjegy = min($szam[$i][8], $szam[$i - 1][8]) / max($szam[$i][8], $szam[$i - 1][8]);
				$sokszamjegyleker = floor($sokszamjegy * 10) / 10;
				$sokszamjegyfelker = ceil($sokszamjegy * 10) / 10;
				$zetaleker = $this->kiszetatabla($sokszamjegyleker, $ebbol);
				$zetafelker = $this->kiszetatabla($sokszamjegyfelker, $ebbol);
				$szam[$i][28] = (($sokszamjegy - $sokszamjegyleker) / 0.1) * ($zetaleker - $zetafelker) + $zetafelker; // szukules - tagulas
			}
			$szumszam[zeta][$i] = round($szam[$i][26] + $szam[$i][27] + $szam[$i][28], $this->tizedes);
			$szam[$i][29] = $this->fustjaratokadat->h[$i]; // szakasz fuggoleges magassag
			$szam[$i][30] = pow($szam[$i][23], 2) * $szam[$i][19] / 2; // Pd pont
			$szumszam[pdp][$i] = round($szam[$i][30], $this->tizedes);
			$szam[$i][31] = pow($szam[$i][24], 2) * $szam[$i][20] / 2; // Pd szakasz
			$szumszam[pds][$i] = round($szam[$i][31], $this->tizedes);
			if ($i == 0) {
				$szam[$i][32] = 9.81 * -$szam[$i][29] * (1.293 / $Fs - (1.282 / (((273 + 700) / 273) * $Fs))) * sqrt($szam[$i][0]); // Ph pont
			} else {
				$szam[$i][32] = 9.81 * -$szam[$i][29] * (1.293 / $Fs - $szam[$i - 1][20]) * sqrt($szam[$i][0]); // Ph pont
			}
			$szumszam[php][$i] = round($szam[$i][32], $this->tizedes);
			$szam[$i][33] = $szam[$i][31] * $szam[$i][25] / $szam[$i][14] * $szam[$i][5]; // Ps szakasz
			$szumszam[pss][$i] = round($szam[$i][33], $this->tizedes);
			$szam[$i][34] = $szam[$i][30] * ($szam[$i][26] + $szam[$i][27] + $szam[$i][28]); // Pa pont
			$szumszam[pap][$i] = round($szam[$i][34], $this->tizedes);
			$szam[$i][35] = $szam[$i][32] + $szam[$i][33] + $szam[$i][34]; // P osszes
		}

		$szumma = array();

		$szumma[fustjarathossz] = round(sqrt($projektadat[fa]) * $projektadat[kalyhahej], $this->tizedes);
		$szumma[jarathossz] = round($L, $this->tizedes);
		$szumma[hom] = round(pow(2.718, (-0.83 * $L / $fustjarathossz)) * 550, $this->picitizedes);
		$osszpharray = array();
		$osszpsarray = array();
		$osszpaarray = array();
		$osszellarray = array();
		foreach ($szam as $key => $value) {
			foreach ($value as $ikey => $ivalue) {
				if ($ikey == 32) {
					array_push($osszpharray, $ivalue);
				} elseif ($ikey == 33) {
					array_push($osszpsarray, $ivalue);
				} elseif ($ikey == 34) {
					array_push($osszpaarray, $ivalue);
				} elseif ($ikey == 35) {
					array_push($osszellarray, $ivalue);
				}
			}
		}
		$osszph = array_sum($osszpharray);
		$osszps = array_sum($osszpsarray);
		$osszpa = array_sum($osszpaarray);
		$osszell = array_sum($osszellarray);
		$szumma[ph] = round($osszph, $this->tizedes);
		$szumma[ps] = round($osszps, $this->tizedes);
		$szumma[pa] = round($osszpa, $this->tizedes);
		$szumma[ell] = round($osszell, $this->tizedes);
		$szumma[hatasfok] = round(101.09 - (0.0941 * pow(2.718, (-0.83 * $L / $fustjarathossz)) * 550)
			- (6.275 * pow(10, -6) * pow(pow(2.718, (-0.83 * $L / $fustjarathossz)) * 550, 2))
			- (3.173 * pow(10, -9) * pow(pow(2.718, (-0.83 * $L / $fustjarathossz)) * 550, 3)), $this->tizedes);
		$szumma[levego] = round(($projektadat[fa] * 0.00256) * ((273 + $projektadat[levegohom]) / 273) * $Fs, $this->tizedes);

		$this->szamitas[szumma] = $szumma;
		$this->szamitas[szumszam] = $szumszam;

		return true;
	}


	function zetatabla($ezkell, $ebbol)
	{

		$zetair = array();

		$zetair[0][0] = 0;
		$zetair[0][1] = 0;
		$zetair[0][2] = 0;

		$zetair[1][0] = 5;
		$zetair[1][1] = .05;
		$zetair[1][2] = .05;

		$zetair[2][0] = 10;
		$zetair[2][1] = .1;
		$zetair[2][2] = .1;

		$zetair[3][0] = 15;
		$zetair[3][1] = .125;
		$zetair[3][2] = .15;

		$zetair[4][0] = 20;
		$zetair[4][1] = .15;
		$zetair[4][2] = .2;

		$zetair[5][0] = 25;
		$zetair[5][1] = .175;
		$zetair[5][2] = .25;

		$zetair[6][0] = 30;
		$zetair[6][1] = .2;
		$zetair[6][2] = .3;

		$zetair[7][0] = 35;
		$zetair[7][1] = .26666666666666;
		$zetair[7][2] = .43333333333333;

		$zetair[8][0] = 40;
		$zetair[8][1] = .33333333333333;
		$zetair[8][2] = .56666666666666;

		$zetair[9][0] = 45;
		$zetair[9][1] = .4;
		$zetair[9][2] = .7;

		$zetair[10][0] = 50;
		$zetair[10][1] = .5333333333333;
		$zetair[10][2] = .8;

		$zetair[11][0] = 55;
		$zetair[11][1] = .6666666666666;
		$zetair[11][2] = .9;

		$zetair[12][0] = 60;
		$zetair[12][1] = .8;
		$zetair[12][2] = .1;

		$zetair[13][0] = 65;
		$zetair[13][1] = .8666666666666;
		$zetair[13][2] = 1.066666666666;

		$zetair[14][0] = 70;
		$zetair[14][1] = .9333333333333;
		$zetair[14][2] = 1.133333333333;

		$zetair[15][0] = 75;
		$zetair[15][1] = 1;
		$zetair[15][2] = 1.2;

		$zetair[16][0] = 80;
		$zetair[16][1] = 1.066666666666;
		$zetair[16][2] = 1.266666666666;

		$zetair[17][0] = 85;
		$zetair[17][1] = 1.133333333333;
		$zetair[17][2] = 1.333333333333;

		$zetair[18][0] = 90;
		$zetair[18][1] = 1.2;
		$zetair[18][2] = 1.4;

		$zetair[19][0] = 95;
		$zetair[19][1] = 1.25;
		$zetair[19][2] = 1.45;

		$zetair[20][0] = 100;
		$zetair[20][1] = 1.3;
		$zetair[20][2] = 1.5;

		$zetair[21][0] = 105;
		$zetair[21][1] = 1.325;
		$zetair[21][2] = 1.55;

		$zetair[22][0] = 110;
		$zetair[22][1] = 1.35;
		$zetair[22][2] = 1.6;

		$zetair[23][0] = 115;
		$zetair[23][1] = 1.375;
		$zetair[23][2] = 1.65;

		$zetair[24][0] = 120;
		$zetair[24][1] = 1.4;
		$zetair[24][2] = 1.7;

		$zetair[25][0] = 125;
		$zetair[25][1] = 1.466666666666;
		$zetair[25][2] = 1.833333333333;

		$zetair[26][0] = 130;
		$zetair[26][1] = 1.533333333333;
		$zetair[26][2] = 1.966666666666;

		$zetair[27][0] = 135;
		$zetair[27][1] = 1.6;
		$zetair[27][2] = 2.1;

		$zetair[28][0] = 140;
		$zetair[28][1] = 1.733333333333;
		$zetair[28][2] = 2.2;

		$zetair[29][0] = 145;
		$zetair[29][1] = 1.866666666666;
		$zetair[29][2] = 2.3;

		$zetair[30][0] = 150;
		$zetair[30][1] = 2;
		$zetair[30][2] = 2.4;

		$zetair[31][0] = 155;
		$zetair[31][1] = 2.066666666666;
		$zetair[31][2] = 2.466666666666;

		$zetair[32][0] = 160;
		$zetair[32][1] = 2.133333333333;
		$zetair[32][2] = 2.533333333333;

		$zetair[33][0] = 165;
		$zetair[33][1] = 2.2;
		$zetair[33][2] = 2.6;

		$zetair[34][0] = 170;
		$zetair[34][1] = 2.266666666666;
		$zetair[34][2] = 2.666666666666;

		$zetair[35][0] = 175;
		$zetair[35][1] = 2.333333333333;
		$zetair[35][2] = 2.733333333333;

		$zetair[36][0] = 180;
		$zetair[36][1] = 2.4;
		$zetair[36][2] = 2.8;

		$zetair[37][0] = 360;
		$zetair[37][1] = 0;
		$zetair[37][2] = 0;

		$zetair[38][0] = 355;
		$zetair[38][1] = .05;
		$zetair[38][2] = .05;

		$zetair[39][0] = 350;
		$zetair[39][1] = .1;
		$zetair[39][2] = .1;

		$zetair[40][0] = 345;
		$zetair[40][1] = .125;
		$zetair[40][2] = .15;

		$zetair[41][0] = 340;
		$zetair[41][1] = .15;
		$zetair[41][2] = .2;

		$zetair[42][0] = 335;
		$zetair[42][1] = .175;
		$zetair[42][2] = .25;

		$zetair[43][0] = 330;
		$zetair[43][1] = .2;
		$zetair[43][2] = .3;

		$zetair[44][0] = 325;
		$zetair[44][1] = .26666666666666;
		$zetair[44][2] = .43333333333333;

		$zetair[45][0] = 320;
		$zetair[45][1] = .33333333333333;
		$zetair[45][2] = .56666666666666;

		$zetair[46][0] = 315;
		$zetair[46][1] = .4;
		$zetair[46][2] = .7;

		$zetair[47][0] = 310;
		$zetair[47][1] = .5333333333333;
		$zetair[47][2] = .8;

		$zetair[48][0] = 305;
		$zetair[48][1] = .6666666666666;
		$zetair[48][2] = .9;

		$zetair[49][0] = 300;
		$zetair[49][1] = .8;
		$zetair[49][2] = .1;

		$zetair[50][0] = 295;
		$zetair[50][1] = .8666666666666;
		$zetair[50][2] = 1.066666666666;

		$zetair[51][0] = 290;
		$zetair[51][1] = .9333333333333;
		$zetair[51][2] = 1.133333333333;

		$zetair[52][0] = 285;
		$zetair[52][1] = 1;
		$zetair[52][2] = 1.2;

		$zetair[53][0] = 280;
		$zetair[53][1] = 1.066666666666;
		$zetair[53][2] = 1.266666666666;

		$zetair[54][0] = 275;
		$zetair[54][1] = 1.133333333333;
		$zetair[54][2] = 1.333333333333;

		$zetair[55][0] = 270;
		$zetair[55][1] = 1.2;
		$zetair[55][2] = 1.4;

		$zetair[56][0] = 265;
		$zetair[56][1] = 1.25;
		$zetair[56][2] = 1.45;

		$zetair[57][0] = 260;
		$zetair[57][1] = 1.3;
		$zetair[57][2] = 1.5;

		$zetair[58][0] = 255;
		$zetair[58][1] = 1.325;
		$zetair[58][2] = 1.55;

		$zetair[59][0] = 250;
		$zetair[59][1] = 1.35;
		$zetair[59][2] = 1.6;

		$zetair[60][0] = 245;
		$zetair[60][1] = 1.375;
		$zetair[60][2] = 1.65;

		$zetair[61][0] = 240;
		$zetair[61][1] = 1.4;
		$zetair[61][2] = 1.7;

		$zetair[62][0] = 235;
		$zetair[62][1] = 1.466666666666;
		$zetair[62][2] = 1.833333333333;

		$zetair[63][0] = 230;
		$zetair[63][1] = 1.533333333333;
		$zetair[63][2] = 1.966666666666;

		$zetair[64][0] = 225;
		$zetair[64][1] = 1.6;
		$zetair[64][2] = 2.1;

		$zetair[65][0] = 220;
		$zetair[65][1] = 1.733333333333;
		$zetair[65][2] = 2.2;

		$zetair[66][0] = 215;
		$zetair[66][1] = 1.866666666666;
		$zetair[66][2] = 2.3;

		$zetair[67][0] = 210;
		$zetair[67][1] = 2;
		$zetair[67][2] = 2.4;

		$zetair[68][0] = 205;
		$zetair[68][1] = 2.066666666666;
		$zetair[68][2] = 2.466666666666;

		$zetair[69][0] = 200;
		$zetair[69][1] = 2.133333333333;
		$zetair[69][2] = 2.533333333333;

		$zetair[70][0] = 195;
		$zetair[70][1] = 2.2;
		$zetair[70][2] = 2.6;

		$zetair[71][0] = 190;
		$zetair[71][1] = 2.266666666666;
		$zetair[71][2] = 2.666666666666;

		$zetair[72][0] = 185;
		$zetair[72][1] = 2.333333333333;
		$zetair[72][2] = 2.733333333333;

		for ($i = 0; $i < count($zetair); $i++) {
			if ($zetair[$i][0] == $ezkell) {
				return $zetair[$i][$ebbol];
			}
		}
	}

	function kiszetatabla($ezkell, $ebbol)
	{

		$zetaker = array();

		$zetaker[0][0] = 0;
		$zetaker[0][1] = 1; // tagulas
		$zetaker[0][2] = .6; // szukules

		$zetaker[1][0] = .1;
		$zetaker[1][1] = .85;
		$zetaker[1][2] = .525;

		$zetaker[2][0] = .2;
		$zetaker[2][1] = .7;
		$zetaker[2][2] = .45;

		$zetaker[3][0] = .3;
		$zetaker[3][1] = .55;
		$zetaker[3][2] = .375;

		$zetaker[4][0] = .4;
		$zetaker[4][1] = .4;
		$zetaker[4][2] = .3;

		$zetaker[5][0] = .5;
		$zetaker[5][1] = .3;
		$zetaker[5][2] = .25;

		$zetaker[6][0] = .6;
		$zetaker[6][1] = .2;
		$zetaker[6][2] = .2;

		$zetaker[7][0] = .7;
		$zetaker[7][1] = .15;
		$zetaker[7][2] = .15;

		$zetaker[8][0] = .8;
		$zetaker[8][1] = .1;
		$zetaker[8][2] = .1;

		$zetaker[9][0] = .9;
		$zetaker[9][1] = .05;
		$zetaker[9][2] = .05;

		$zetaker[10][0] = 1;
		$zetaker[10][1] = 0;
		$zetaker[10][2] = 0;

		for ($i = 0; $i < count($zetaker); $i++) {
			if ($zetaker[$i][0] == $ezkell) {
				return $zetaker[$i][$ebbol];
			}
		}
	}

	///////////////////////////////////////

	function GetErrorMessage()
	{
		if (empty($this->error_message)) {
			return '';
		}
		$errormsg = nl2br(htmlspecialchars($this->error_message));
		return $errormsg;
	}

	function HandleError($err)
	{
		$this->error_message .= $err . "\r\n";
	}

	function HandleDBError($err)
	{
		$this->HandleError($err . "\r\n MySQL error:" . mysqli_error($this->connection));
	}

	function GetSelfScript()
	{
		return htmlentities($_SERVER[PHP_SELF]);
	}
	function SanitizeForSQL($str)
	{
		if (function_exists("mysqli_real_escape_string")) {
			$ret_str = mysqli_real_escape_string($this->connection, $str);
		} else {
			$ret_str = addslashes($str);
		}
		return $ret_str;
	}
}

?>