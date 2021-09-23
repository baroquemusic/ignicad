<?php

class KalyhaC3DAdmin {

    var $connection;
    var $error_message;
    var $session_user_id;
    var $valasz;
    var $username;
    var $jog;
    var $sender_iban;
    var $sender_name;
    var $transaction_datetime;
    var $bill;
    var $amount;
    var $unit_price;
    var $id_user;
    var $admin_notes;
    var $kupon;
    var $insertid;
    var $kodok;
    var $balance;
    var $feltolt;
    var $header;
    var $data;

    function initDB($host, $user, $pass, $db, $users, $utalasok, $kuponok, $projektek) {
	$this->hostname = $host;
	$this->dbusername = $user;
	$this->password = $pass;
	$this->database = $db;
	$this->felhasznalok = $users;
	$this->utalasok = $utalasok;
	$this->kuponok = $kuponok;
	$this->projektek = $projektek;
    }

    function loginDB() {

	$this->connection = mysql_connect($this->hostname, $this->dbusername, $this->password);

	if (!$this->connection) {
	    $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
	    return false;
	}
	if (!mysql_select_db($this->database, $this->connection)) {
	    $this->HandleDBError('Failed to select database: ' . $this->database . ' Please make sure that the database name provided is correct');
	    return false;
	}
	if (!mysql_query("SET NAMES 'UTF8'", $this->connection)) {
	    $this->HandleDBError('Error setting utf8 encoding');
	    return false;
	}
	return true;
    }
    
    function listaFelhasznalok() {
	if (!$this->loginDB()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	$export = mysql_query("SELECT * FROM $this->felhasznalok", $this->connection);
	$fields = mysql_num_fields ( $export );
	for ( $i = 0; $i < $fields; $i++ )
	{
	    $this->header .= mysql_field_name( $export , $i ) . "\t";
	}
	while( $row = mysql_fetch_row( $export ) )
	{
	    $line = '';
	    foreach( $row as $value )
	    {                                            
		if ( ( !isset( $value ) ) || ( $value == "" ) )
		{
		    $value = "\t";
		}
		else
		{
		    $value = str_replace( '"' , '""' , $value );
		    $value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
	    }
	    $this->data .= trim( $line ) . "\n";
	}
	$this->data = str_replace( "\r" , "" , $this->data );
	if ( $this->data == "" )
	{
	    $this->data = "\n(0) Records Found!\n";                        
	}
	return true;
    }
    
    function listaProjektek() {
	if (!$this->loginDB()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	$export = mysql_query("SELECT * FROM $this->projektek", $this->connection);
	$fields = mysql_num_fields ( $export );
	for ( $i = 0; $i < $fields; $i++ )
	{
	    $this->header .= mysql_field_name( $export , $i ) . "\t";
	}
	while( $row = mysql_fetch_row( $export ) )
	{
	    $line = '';
	    foreach( $row as $value )
	    {                                            
		if ( ( !isset( $value ) ) || ( $value == "" ) )
		{
		    $value = "\t";
		}
		else
		{
		    $value = str_replace( '"' , '""' , $value );
		    $value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
	    }
	    $this->data .= trim( $line ) . "\n";
	}
	$this->data = str_replace( "\r" , "" , $this->data );
	if ( $this->data == "" )
	{
	    $this->data = "\n(0) Records Found!\n";                        
	}
	return true;
    }
    
    function listaUtalasok() {
	if (!$this->loginDB()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	$export = mysql_query("SELECT * FROM $this->utalasok", $this->connection);
	$fields = mysql_num_fields ( $export );
	for ( $i = 0; $i < $fields; $i++ )
	{
	    $this->header .= mysql_field_name( $export , $i ) . "\t";
	}
	while( $row = mysql_fetch_row( $export ) )
	{
	    $line = '';
	    foreach( $row as $value )
	    {                                            
		if ( ( !isset( $value ) ) || ( $value == "" ) )
		{
		    $value = "\t";
		}
		else
		{
		    $value = str_replace( '"' , '""' , $value );
		    $value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
	    }
	    $this->data .= trim( $line ) . "\n";
	}
	$this->data = str_replace( "\r" , "" , $this->data );
	if ( $this->data == "" )
	{
	    $this->data = "\n(0) Records Found!\n";                        
	}
	return true;
    }
    
    function listaKuponok() {
	if (!$this->loginDB()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	$export = mysql_query("SELECT * FROM $this->kuponok", $this->connection);
	$fields = mysql_num_fields ( $export );
	for ( $i = 0; $i < $fields; $i++ )
	{
	    $this->header .= mysql_field_name( $export , $i ) . "\t";
	}
	while( $row = mysql_fetch_row( $export ) )
	{
	    $line = '';
	    foreach( $row as $value )
	    {                                            
		if ( ( !isset( $value ) ) || ( $value == "" ) )
		{
		    $value = "\t";
		}
		else
		{
		    $value = str_replace( '"' , '""' , $value );
		    $value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
	    }
	    $this->data .= trim( $line ) . "\n";
	}
	$this->data = str_replace( "\r" , "" , $this->data );
	if ( $this->data == "" )
	{
	    $this->data = "\n(0) Records Found!\n";                        
	}
	return true;
    }
    
    function kupontFeltolt() {
	if (!$this->loginDB()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	$kuponokbol = mysql_query("SELECT id_user FROM $this->kuponok WHERE coupon = '$this->feltolt'", $this->connection);
	if (!$kuponokbol || mysql_num_rows($kuponokbol) <= 0) {
	    return false;
	} else {
	    $kuponuser = mysql_fetch_assoc($kuponokbol);
	    if ($kuponuser['id_user'] == 0) {
		$update = 'UPDATE ' . $this->kuponok . ' SET id_user = "' . $this->session_user_id . '" WHERE coupon = "' . $this->feltolt . '"';
		mysql_query($update, $this->connection);
		return true;
	    } else {
		return false;
	    }
	}
    }

    function kerekEgyenleget() {
	if (!$this->loginDB()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	if (!$this->vaneUtalasokTabla()) {
	    return false;
	}

	$utalasokbol = mysql_query("SELECT amount, unit_price FROM $this->utalasok WHERE id_user = '$this->session_user_id'", $this->connection);
	$utalsum = 0;
	while ($row = mysql_fetch_assoc($utalasokbol)) {
	    $utalsum += floor($row["amount"] / $row["unit_price"]);
	}

	$kuponokbol = mysql_query("SELECT coupon FROM $this->kuponok WHERE id_user = '$this->session_user_id'", $this->connection);
	if (!$kuponokbol || mysql_num_rows($kuponokbol) <= 0) {
	    $kuponsum = 0;
	} else {
	    $kuponsum = mysql_num_rows($kuponokbol);
	}

	$this->balance = $utalsum + $kuponsum;
	return true;
    }

    function kuponKell() {
	if (!$this->loginDB()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	if (!$this->vaneUtalasokTabla()) {
	    return false;
	}
	$insert_query = 'INSERT INTO ' . $this->utalasok . ' (
	    id_user_admin,
	    sender_iban,
	    sender_name,
	    transaction_datetime,
	    bill,
	    amount,
	    unit_price,
	    admin_notes
	    )
	    VALUES
	    (
	    "' . $this->session_user_id . '",
	    "' . $this->sender_iban . '",
	    "' . $this->sender_name . '",
	    "' . $this->transaction_datetime . '",
	    "' . $this->bill . '",
	    "' . $this->amount . '",
	    "' . $this->unit_price . '",
	    "' . $this->admin_notes . '"
	    )';

	mysql_query($insert_query, $this->connection);
	$this->insertid = mysql_insert_id();

	if (!$this->kupontGeneral()) {
	    return false;
	}
	return true;
    }

    function kupontGeneral() {
	$this->kodok = array();
	$chars = "23456789ABCDEFGHJKLMNPQRSTUVWXYZ";
	if (!$this->vaneKuponokTabla()) {
	    return false;
	}
	for ($c = 0; $c < $this->kupon; $c++) {
	    $kod = "";
	    for ($i = 0; $i < 5; $i++) {
		$kod .= $chars[mt_rand(0, strlen($chars) - 1)];
	    }
	    $result = mysql_query("SHOW COLUMNS FROM $this->kuponok WHERE coupon = " . $kod);
	    if (!$result || mysql_num_rows($result) <= 0) {
		$insert_query = 'INSERT INTO ' . $this->kuponok . ' (
		    id_transaction,
		    id_user_admin,
		    coupon
		    )
		    VALUES
		    (
		    "' . $this->insertid . '",
		    "' . $this->session_user_id . '",
		    "' . $kod . '"
		    )';
		if (!mysql_query($insert_query, $this->connection)) {
		    $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
		    return false;
		}
		array_push($this->kodok, $kod);
	    } else {
		$c--;
	    }
	}

	return true;
    }

    function utalasokbaMent() {
	if (!$this->loginDB()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	if (!$this->vaneUtalasokTabla()) {
	    return false;
	}
	$insert_query = 'INSERT INTO ' . $this->utalasok . ' (
	    id_user_admin,
	    sender_iban,
	    sender_name,
	    transaction_datetime,
	    bill,
	    amount,
	    unit_price,
	    username,
	    id_user,
	    admin_notes
	    )
	    VALUES
	    (
	    "' . $this->session_user_id . '",
	    "' . $this->sender_iban . '",
	    "' . $this->sender_name . '",
	    "' . $this->transaction_datetime . '",
	    "' . $this->bill . '",
	    "' . $this->amount . '",
	    "' . $this->unit_price . '",
	    "' . $this->username . '",
	    "' . $this->id_user . '",
	    "' . $this->admin_notes . '"
	    )';
	if (!mysql_query($insert_query, $this->connection)) {
	    $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
	    return false;
	}
	return true;
    }

    function usernameAlapjanMinden() {
	if (!$this->loginDB()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	$result = mysql_query("SELECT * FROM $this->felhasznalok WHERE username = '$this->username'", $this->connection);
	$this->valasz = mysql_fetch_assoc($result);
	return true;
    }

    function jogValt() {
	if (!$this->loginDB()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	$update_query = 'UPDATE ' . $this->felhasznalok . ' SET admin = "' . $this->jog . '" WHERE username = "' . $this->username . '"';
	if (!mysql_query($update_query, $this->connection)) {
	    $this->HandleDBError("Error updating data to the table\nquery:$update_query");
	    return false;
	}
	return true;
    }

    function vaneUtalasokTabla() {
	$result = mysql_query("SHOW COLUMNS FROM $this->utalasok");
	if (!$result || mysql_num_rows($result) <= 0) {
	    return $this->csinaljUtalasokTablat();
	}
	return true;
    }

    function csinaljUtalasokTablat() {
	$qry = "CREATE TABLE $this->utalasok (
id_transaction INT NOT NULL AUTO_INCREMENT,
id_user_admin INT ( 7 ) DEFAULT '0',
issue_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

sender_iban VARCHAR ( 64 ) DEFAULT '',
sender_name VARCHAR ( 128 ) DEFAULT '',
transaction_datetime TIMESTAMP DEFAULT '0000-00-00 00:00:00',
bill VARCHAR ( 64 ) DEFAULT '',
amount INT ( 16 ) DEFAULT '0',
unit_price INT ( 8 ) DEFAULT '0',
username VARCHAR ( 16 ) DEFAULT '',
id_user INT ( 7 ) DEFAULT '0',
admin_notes VARCHAR ( 512 ) DEFAULT '',

PRIMARY KEY ( id_transaction ) )";

	if (!mysql_query($qry, $this->connection)) {
	    $this->HandleDBError("Error creating the table \nquery was\n $qry");
	    return false;
	}
	return true;
    }

    function vaneKuponokTabla() {
	$result = mysql_query("SHOW COLUMNS FROM $this->kuponok");
	if (!$result || mysql_num_rows($result) <= 0) {
	    return $this->csinaljKuponokTablat();
	}
	return true;
    }

    function csinaljKuponokTablat() {
	$qry = "CREATE TABLE $this->kuponok (
id_coupon INT NOT NULL AUTO_INCREMENT,
id_transaction INT ( 16 ) DEFAULT '0',
id_user_admin INT ( 7 ) DEFAULT '0',
issue_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

coupon VARCHAR ( 5 ) DEFAULT '',
id_user INT ( 7 ) DEFAULT '0',

PRIMARY KEY ( id_coupon ) )";

	if (!mysql_query($qry, $this->connection)) {
	    $this->HandleDBError("Error creating the table \nquery was\n $qry");
	    return false;
	}
	return true;
    }

    ///////////////////////////////////////

    function GetErrorMessage() {
	if (empty($this->error_message)) {
	    return '';
	}
	$errormsg = nl2br(htmlspecialchars($this->error_message));
	return $errormsg;
    }

    function HandleError($err) {
	$this->error_message .= $err . "\r\n";
    }

    function HandleDBError($err) {
	$this->HandleError($err . "\r\n MySQL error:" . mysql_error());
    }

    function GetSelfScript() {
	return htmlentities($_SERVER['PHP_SELF']);
    }

    function SanitizeForSQL($str) {
	if (function_exists("mysql_real_escape_string")) {
	    $ret_str = mysql_real_escape_string($str);
	} else {
	    $ret_str = addslashes($str);
	}
	return $ret_str;
    }

}

?>
