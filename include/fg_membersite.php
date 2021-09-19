<?PHP

require_once ("class.phpmailer.php");
require_once ("formvalidator.php");

class FGMembersite {

    var $admin_email;
    var $from_address;
    var $username;
    var $pwd;
    var $database;
    var $tablename;
    var $connection;
    var $rand_key;
    var $error_message;

    //-----Initialization -------
//	function FGMembersite() {
//		$this -> sitename = 'YourWebsiteName.com';
//		$this -> rand_key = '0iQx5oBk66oVZep';
//	}

    function InitDB($host, $uname, $pwd, $database, $tablename) {
	$this->db_host = $host;
	$this->username = $uname;
	$this->pwd = $pwd;
	$this->database = $database;
	$this->tablename = $tablename;
    }

    function SetAdminEmail($email) {
	$this->admin_email = $email;
    }

    function SetWebsiteName($sitename) {
	$this->sitename = $sitename;
    }

    function SetRandomKey($key) {
	$this->rand_key = $key;
    }

    //-------Main Operations ----------------------
    function RegisterUser() {
	if (!isset($_POST['submitted'])) {
	    return false;
	}

	$formvars = array();

	if (!$this->ValidateRegistrationSubmission()) {
	    return false;
	}

	$this->CollectRegistrationSubmission($formvars);

	if (!$this->SaveToDatabase($formvars)) {
	    return false;
	}

	if (!$this->SendUserConfirmationEmail($formvars)) {
	    return false;
	}

	$this->SendAdminIntimationEmail($formvars);

	return true;
    }

    function ConfirmUser() {
	if (empty($_GET['code']) || strlen($_GET['code']) <= 10) {
	    $this->HandleError($GLOBALS['lang']['WRONG_CONFIRM_CODE']);
	    return false;
	}
	$user_rec = array();
	if (!$this->UpdateDBRecForConfirmation($user_rec)) {
	    return false;
	}

	$this->SendUserWelcomeEmail($user_rec);

	$this->SendAdminIntimationOnRegComplete($user_rec);

	return true;
    }

    function Login() {
	if (empty($_POST['username'])) {
	    $this->HandleError("UserName is empty!");
	    return false;
	}

	if (empty($_POST['password'])) {
	    $this->HandleError("Password is empty!");
	    return false;
	}

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (!isset($_SESSION)) {
	    session_start();
	}
	if (!$this->CheckLoginInDB($username, $password)) {
	    return false;
	}

	$_SESSION[$this->GetLoginSessionVar()] = $username;

	return true;
    }
    
    function Userek() {
	if (!$this->DBLogin()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	$result = mysql_query("SELECT username FROM " . $this->tablename . " WHERE confirmcode='y'", $this->connection);
	$arraylist = array();
	
	while ($row = mysql_fetch_assoc($result)) {
	    $arraylist[] = $row['username'];
	}
	return $arraylist;
    }

    function AdminLogin() {
	if (empty($_POST['username'])) {
	    $this->HandleError("UserName is empty!");
	    return false;
	}

	if (empty($_POST['password'])) {
	    $this->HandleError("Password is empty!");
	    return false;
	}

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (!isset($_SESSION)) {
	    session_start();
	}
	if (!$this->CheckAdminLoginInDB($username, $password)) {
	    return false;
	}

	$_SESSION[$this->GetLoginSessionVar()] = $username;

	return true;
    }

    function CheckLogin() {
	if (!isset($_SESSION)) {
	    session_start();
	}

	$sessionvar = $this->GetLoginSessionVar();

	if (empty($_SESSION[$sessionvar])) {
	    return false;
	}
	return true;
    }

    function UserFullName() {
	return isset($_SESSION['name_of_user']) ? $_SESSION['name_of_user'] : '';
    }

    function UserPhoneNumber() {
	return isset($_SESSION['phone_number']) ? $_SESSION['phone_number'] : '';
    }

    function UserID() {
	return isset($_SESSION['id_of_user']) ? $_SESSION['id_of_user'] : '';
    }

    function UserEmail() {
	return isset($_SESSION['email_of_user']) ? $_SESSION['email_of_user'] : '';
    }

    function LogOut() {
	session_start();

	$sessionvar = $this->GetLoginSessionVar();

	$_SESSION[$sessionvar] = NULL;

	unset($_SESSION[$sessionvar]);
    }

    function EmailResetPasswordLink() {
	if (empty($_POST['email'])) {
	    $this->HandleError("Email is empty!");
	    return false;
	}
	$user_rec = array();
	if (false === $this->GetUserFromEmail($_POST['email'], $user_rec)) {
	    return false;
	}
	if (false === $this->SendResetPasswordLink($user_rec)) {
	    return false;
	}
	return true;
    }

    function ResetPassword() {
	if (empty($_GET['email'])) {
	    $this->HandleError("Email is empty!");
	    return false;
	}
	if (empty($_GET['code'])) {
	    $this->HandleError("reset code is empty!");
	    return false;
	}
	$email = trim($_GET['email']);
	$code = trim($_GET['code']);

	if ($this->GetResetPasswordCode($email) != $code) {
	    $this->HandleError("Bad reset code!");
	    return false;
	}

	$user_rec = array();
	if (!$this->GetUserFromEmail($email, $user_rec)) {
	    return false;
	}

	$new_password = $this->ResetUserPasswordInDB($user_rec);
	if (false === $new_password || empty($new_password)) {
	    $this->HandleError("Error updating new password");
	    return false;
	}

	if (false == $this->SendNewPassword($user_rec, $new_password)) {
	    $this->HandleError("Error sending new password");
	    return false;
	}
	return true;
    }

    function ChangePassword() {
	if (!$this->CheckLogin()) {
	    $this->HandleError("Not logged in!");
	    return false;
	}

	if (empty($_POST['oldpwd'])) {
	    $this->HandleError("Old password is empty!");
	    return false;
	}
	if (empty($_POST['newpwd'])) {
	    $this->HandleError("New password is empty!");
	    return false;
	}

	$user_rec = array();
	if (!$this->GetUserFromEmail($this->UserEmail(), $user_rec)) {
	    return false;
	}

	$pwd = trim($_POST['oldpwd']);

	if ($user_rec['password'] != md5($pwd)) {
	    $this->HandleError($GLOBALS['lang']['OLD_PASSWORD_DO_NOT_MATCH']);
	    return false;
	}
	$newpwd = trim($_POST['newpwd']);

	if (!$this->ChangePasswordInDB($user_rec, $newpwd)) {
	    return false;
	}
	return true;
    }

    //-------Public Helper functions -------------
    function GetSelfScript() {
	return htmlentities($_SERVER['PHP_SELF']);
    }

    function SafeDisplay($value_name) {
	if (empty($_POST[$value_name])) {
	    return '';
	}
	return htmlspecialchars($_POST[$value_name]);
    }

    function RedirectToURL($url) {
	header("Location: $url");
	exit;
    }

    function GetSpamTrapInputName() {
	return 'sp' . md5('KHGdnbvsgst' . $this->rand_key);
    }

    function GetErrorMessage() {
	if (empty($this->error_message)) {
	    return '';
	}
	$errormsg = nl2br(htmlspecialchars($this->error_message));
	return $errormsg;
    }

    //-------Private Helper functions-----------

    function HandleError($err) {
	$this->error_message .= $err . "\r\n";
    }

    function HandleDBError($err) {
	$this->HandleError($err . "\r\n mysqlerror:" . mysql_error());
    }

    function GetFromAddress() {
	if (!empty($this->from_address)) {
	    return $this->from_address;
	}

	$host = $_SERVER['SERVER_NAME'];

	$from = "nobody@$host";
	return $from;
    }

    function GetLoginSessionVar() {
	$retvar = md5($this->rand_key);
	$retvar = 'usr_' . substr($retvar, 0, 10);
	return $retvar;
    }

    function CheckLoginInDB($username, $password) {
	if (!$this->DBLogin()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	$username = $this->SanitizeForSQL($username);
	$pwdmd5 = md5($password);
	$qry = "Select id_user, name, email, phone_number, admin from $this->tablename where username='$username' and password='$pwdmd5' and confirmcode='y'";

	$result = mysql_query($qry, $this->connection);

	if (!$result || mysql_num_rows($result) <= 0) {
	    $this->HandleError($GLOBALS['lang']['WRONG_USER_NAME_OR_PASSWORD']);
	    return false;
	}

	$row = mysql_fetch_assoc($result);

	$_SESSION['id_of_user'] = $row['id_user'];
	$_SESSION['name_of_user'] = $row['name'];
	$_SESSION['email_of_user'] = $row['email'];
	$_SESSION['phone_number'] = $row['phone_number'];
	$_SESSION['admin'] = $row['admin'];

	return true;
    }

    function CheckAdminLoginInDB($username, $password) {
	if (!$this->DBLogin()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	$username = $this->SanitizeForSQL($username);
	$pwdmd5 = md5($password);
	$qry = "Select id_user, name, email, phone_number from $this->tablename where username='$username' and password='$pwdmd5' and admin='1' and confirmcode='y'";

	$result = mysql_query($qry, $this->connection);

	if (!$result || mysql_num_rows($result) <= 0) {
	    $this->HandleError($GLOBALS['lang']['WRONG_USER_NAME_OR_PASSWORD']);
	    return false;
	}

	$row = mysql_fetch_assoc($result);

	$_SESSION['id_of_user'] = $row['id_user'];
	$_SESSION['name_of_user'] = $row['name'];
	$_SESSION['email_of_user'] = $row['email'];
	$_SESSION['phone_number'] = $row['phone_number'];

	return true;
    }

    function UpdateDBRecForConfirmation(&$user_rec) {
	if (!$this->DBLogin()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	$confirmcode = $this->SanitizeForSQL($_GET['code']);

	$result = mysql_query("Select name, email from $this->tablename where confirmcode='$confirmcode'", $this->connection);
	if (!$result || mysql_num_rows($result) <= 0) {
	    $this->HandleError($GLOBALS['lang']['WRONG_CONFIRM_CODE']);
	    return false;
	}
	$row = mysql_fetch_assoc($result);
	$user_rec['name'] = $row['name'];
	$user_rec['email'] = $row['email'];

	$qry = "Update $this->tablename Set confirmcode='y' Where  confirmcode='$confirmcode'";

	if (!mysql_query($qry, $this->connection)) {
	    $this->HandleDBError("Error inserting data to the table\nquery:$qry");
	    return false;
	}
	return true;
    }

    function ResetUserPasswordInDB($user_rec) {
	$new_password = substr(md5(uniqid()), 0, 10);

	if (false == $this->ChangePasswordInDB($user_rec, $new_password)) {
	    return false;
	}
	return $new_password;
    }

    function ChangePasswordInDB($user_rec, $newpwd) {
	$newpwd = $this->SanitizeForSQL($newpwd);

	$qry = "Update $this->tablename Set password='" . md5($newpwd) . "' Where  id_user=" . $user_rec['id_user'] . "";

	if (!mysql_query($qry, $this->connection)) {
	    $this->HandleDBError("Error updating the password \nquery:$qry");
	    return false;
	}
	return true;
    }

    function GetUserFromEmail($email, &$user_rec) {
	if (!$this->DBLogin()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	$email = $this->SanitizeForSQL($email);

	$result = mysql_query("Select * from $this->tablename where email='$email'", $this->connection);

	if (!$result || mysql_num_rows($result) <= 0) {
	    $this->HandleError($GLOBALS['lang']['NO_USER_WITH_THIS_EMAIL'] . $email);
	    return false;
	}
	$user_rec = mysql_fetch_assoc($result);

	return true;
    }

    function SendUserWelcomeEmail(&$user_rec) {
	$mailer = new PHPMailer();
	
	$mailer->IsSMTP();
	$mailer->Host = "smtp.ignicad.com";
	$mailer->SMTPAuth = true;
	$mailer->Username = "noreply@ignicad.com";
	$mailer->Password = "HRbK4cDHmm";

	$mailer->CharSet = 'utf-8';

	$mailer->AddAddress($user_rec['email'], $user_rec['name']);

	$mailer->Subject = $GLOBALS['lang']['EMAIL_SUBJECT_WELCOME'] . $this->sitename;

	$mailer->From = $this->GetFromAddress();

	$mailer->Body = $GLOBALS['lang']['EMAIL_DEAR'] . $user_rec['name'] . "!\r\n\r\n" . $GLOBALS['lang']['EMAIL_CONGRATS_YOUR_REG_TO'] . $this->sitename . $GLOBALS['lang']['EMAIL_WEBSITE_WAS_SUCCESS'] . "\r\n" . "\r\n" . $GLOBALS['lang']['EMAIL_REGARDS'] . "\r\n" . $GLOBALS['lang']['EMAIL_SIGNATURE'] . "\r\n" . $this->sitename;

	if (!$mailer->Send()) {
	    $this->HandleError("Failed sending user welcome email.");
	    return false;
	}
	return true;
    }

    function SendAdminIntimationOnRegComplete(&$user_rec) {
	if (empty($this->admin_email)) {
	    return false;
	}
	$mailer = new PHPMailer();
	
	$mailer->IsSMTP();
	$mailer->Host = "smtp.ignicad.com";
	$mailer->SMTPAuth = true;
	$mailer->Username = "noreply@ignicad.com";
	$mailer->Password = "HRbK4cDHmm";

	$mailer->CharSet = 'utf-8';

	$mailer->AddAddress($this->admin_email);

	$mailer->Subject = $GLOBALS['lang']['EMAIL_SUBJECT_REG_CONFIRMED'] . $user_rec['name'];

	$mailer->From = $this->GetFromAddress();

	$mailer->Body = $GLOBALS['lang']['EMAIL_NEW_USER_CONFIRMED_REG'] . $this->sitename . "\r\n" . $GLOBALS['lang']['EMAIL_NAME'] . $user_rec['name'] . "\r\n" . $GLOBALS['lang']['EMAIL_EMAIL_ADDR'] . $user_rec['email'] . "\r\n";

	if (!$mailer->Send()) {
	    return false;
	}
	return true;
    }

    function GetResetPasswordCode($email) {
	return substr(md5($email . $this->sitename . $this->rand_key), 0, 10);
    }

    function SendResetPasswordLink($user_rec) {
	$email = $user_rec['email'];

	$mailer = new PHPMailer();
	
	$mailer->IsSMTP();
	$mailer->Host = "smtp.ignicad.com";
	$mailer->SMTPAuth = true;
	$mailer->Username = "noreply@ignicad.com";
	$mailer->Password = "HRbK4cDHmm";

	$mailer->CharSet = 'utf-8';

	$mailer->AddAddress($email, $user_rec['name']);

	$mailer->Subject = $GLOBALS['lang']['EMAIL_SUBJECT_RESET_PASSWORD_REQUEST'] . $this->sitename;

	$mailer->From = $this->GetFromAddress();

	$link = $this->GetAbsoluteURLFolder() . '/resetpwd.php?email=' . urlencode($email) . '&code=' . urlencode($this->GetResetPasswordCode($email));

	$mailer->Body = $GLOBALS['lang']['EMAIL_DEAR'] . $user_rec['name'] . "!\r\n\r\n" . $GLOBALS['lang']['EMAIL_YOU_REQUESTED_RESET_PASSWORD'] . $this->sitename . "\r\n" . $GLOBALS['lang']['EMAIL_PLEASE_CLICK_LINK_TO_COMPLETE'] . "\r\n" . $link . "\r\n" . $GLOBALS['lang']['EMAIL_REGARDS'] . "\r\n" . $GLOBALS['lang']['EMAIL_SIGNATURE'] . "\r\n" . $this->sitename;

	if (!$mailer->Send()) {
	    return false;
	}
	return true;
    }

    function SendNewPassword($user_rec, $new_password) {
	$email = $user_rec['email'];

	$mailer = new PHPMailer();
	
	$mailer->IsSMTP();
	$mailer->Host = "smtp.ignicad.com";
	$mailer->SMTPAuth = true;
	$mailer->Username = "noreply@ignicad.com";
	$mailer->Password = "HRbK4cDHmm";

	$mailer->CharSet = 'utf-8';

	$mailer->AddAddress($email, $user_rec['name']);

	$mailer->Subject = $GLOBALS['lang']['EMAIL_YOUR_NEW_PASSWORD_FOR'] . $this->sitename;

	$mailer->From = $this->GetFromAddress();

	$mailer->Body = $GLOBALS['lang']['EMAIL_DEAR'] . $user_rec['name'] . "!\r\n\r\n" . $GLOBALS['lang']['EMAIL_YOUR_PASSWORD_RESET_YOUR_NEW_LOGIN'] . "\r\n" . $GLOBALS['lang']['EMAIL_USER_NAME'] . $user_rec['username'] . "\r\n" . $GLOBALS['lang']['EMAIL_PASSWORD'] . "$new_password\r\n" . "\r\n" . $GLOBALS['lang']['EMAIL_LOG_IN_HERE'] . $this->GetAbsoluteURLFolder() . "/login.php\r\n" . "\r\n" . $GLOBALS['lang']['EMAIL_REGARDS'] . "\r\n" . $GLOBALS['lang']['EMAIL_SIGNATURE'] . "\r\n" . $this->sitename;

	if (!$mailer->Send()) {
	    return false;
	}
	return true;
    }

    function ValidateRegistrationSubmission() {
	if (!empty($_POST[$this->GetSpamTrapInputName()])) {

	    $this->HandleError("Automated submission prevention: case 2 failed");
	    return false;
	}

	$validator = new FormValidator();
	$validator->addValidation("name", "req", "Please fill in Name");
	$validator->addValidation("email", "email", "The input for Email should be a valid email value");
	$validator->addValidation("email", "req", "Please fill in Email");
	$validator->addValidation("phone_number", "num", "Only numbars");
	$validator->addValidation("phone_number", "req", "Please fill in Phone");
	$validator->addValidation("username", "req", "Please fill in UserName");
	$validator->addValidation("password", "req", "Please fill in Password");

	if (!$validator->ValidateForm()) {
	    $error = '';
	    $error_hash = $validator->GetErrors();
	    foreach ($error_hash as $inpname => $inp_err) {
		$error .= $inpname . ':' . $inp_err . "\n";
	    }
	    $this->HandleError($error);
	    return false;
	}
	return true;
    }

    function CollectRegistrationSubmission(&$formvars) {
	$formvars['name'] = $this->Sanitize($_POST['name']);
	$formvars['email'] = $this->Sanitize($_POST['email']);
	$formvars['phone_number'] = $this->Sanitize($_POST['phone_number']);
	$formvars['username'] = $this->Sanitize($_POST['username']);
	$formvars['password'] = $this->Sanitize($_POST['password']);
    }

    function SendUserConfirmationEmail(&$formvars) {
	$mailer = new PHPMailer();
	
	$mailer->IsSMTP();
	$mailer->Host = "smtp.ignicad.com";
	$mailer->SMTPAuth = true;
	$mailer->Username = "noreply@ignicad.com";
	$mailer->Password = "HRbK4cDHmm";

	$mailer->CharSet = 'utf-8';

	$mailer->AddAddress($formvars['email'], $formvars['name']);

	$mailer->Subject = $GLOBALS['lang']['EMAIL_SUBJECT_CONFIRM_REG'] . $this->sitename;

	$mailer->From = $this->GetFromAddress();

	$confirmcode = $formvars['confirmcode'];

	$confirm_url = $this->GetAbsoluteURLFolder() . 'confirmreg.php?code=' . $confirmcode;

	$mailer->Body = $GLOBALS['lang']['EMAIL_DEAR'] . $formvars['name'] . "!\r\n\r\n" . $GLOBALS['lang']['EMAIL_THANK_YOU_FOR_REGISTERING_AT'] . $this->sitename . "\r\n" . $GLOBALS['lang']['EMAIL_PLEASE_CLICK_LINK_TO_COMPLETE'] . "\r\n" . "$confirm_url\r\n" . "\r\n" . $GLOBALS['lang']['EMAIL_REGARDS'] . "\r\n" . $GLOBALS['lang']['EMAIL_SIGNATURE'] . "\r\n" . $this->sitename;

	if (!$mailer->Send()) {
	    $this->HandleError("Failed sending registration confirmation email.");
	    return false;
	}
	return true;
    }

    function GetAbsoluteURLFolder() {
	$scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
	$scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
	return $scriptFolder;
    }

    function SendAdminIntimationEmail(&$formvars) {
	if (empty($this->admin_email)) {
	    return false;
	}
	$mailer = new PHPMailer();
	
	$mailer->IsSMTP();
	$mailer->Host = "smtp.ignicad.com";
	$mailer->SMTPAuth = true;
	$mailer->Username = "noreply@ignicad.com";
	$mailer->Password = "HRbK4cDHmm";

	$mailer->CharSet = 'utf-8';

	$mailer->AddAddress($this->admin_email);

	$mailer->Subject = $GLOBALS['lang']['EMAIL_SUBJECT_NEW_REGISTRANT'] . $formvars['name'];

	$mailer->From = $this->GetFromAddress();

	$mailer->Body = $GLOBALS['lang']['EMAIL_NEW_USER_REGISTERED_AT'] . $this->sitename . "\r\n" . $GLOBALS['lang']['EMAIL_NAME'] . $formvars['name'] . "\r\n" . $GLOBALS['lang']['EMAIL_EMAIL_ADDR'] . $formvars['email'] . "\r\n" . $GLOBALS['lang']['EMAIL_PHONE_NUM'] . $formvars['phone_number'] . "\r\n" . $GLOBALS['lang']['EMAIL_USER_NAME'] . $formvars['username'];

	if (!$mailer->Send()) {
	    return false;
	}
	return true;
    }

    function SaveToDatabase(&$formvars) {
	if (!$this->DBLogin()) {
	    $this->HandleError("Database login failed!");
	    return false;
	}
	if (!$this->Ensuretable()) {
	    return false;
	}
	if (!$this->IsFieldUnique($formvars, 'email')) {
	    $this->HandleError($GLOBALS['lang']['THIS_EMAIL_ALREADY_REGISTERED']);
	    return false;
	}

	if (!$this->IsFieldUnique($formvars, 'phone_number')) {
	    $this->HandleError($GLOBALS['lang']['THIS_PHONE_ALREADY_REGISTERED']);
	    return false;
	}

	if (!$this->IsFieldUnique($formvars, 'username')) {
	    $this->HandleError($GLOBALS['lang']['THIS_USER_NAME_ALREADY_REGISTERED']);
	    return false;
	}
	if (!$this->InsertIntoDB($formvars)) {
	    $this->HandleError("Inserting to Database failed!");
	    return false;
	}
	return true;
    }

    function IsFieldUnique($formvars, $fieldname) {
	$field_val = $this->SanitizeForSQL($formvars[$fieldname]);
	$qry = "select username from $this->tablename where $fieldname='" . $field_val . "'";
	$result = mysql_query($qry, $this->connection);
	if ($result && mysql_num_rows($result) > 0) {
	    return false;
	}
	return true;
    }

    function DBLogin() {

	$this->connection = mysqli_connect($this->db_host, $this->username, $this->pwd);

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

    function Ensuretable() {
	$result = mysql_query("SHOW COLUMNS FROM $this->tablename");
	if (!$result || mysql_num_rows($result) <= 0) {
	    return $this->CreateTable();
	}
	return true;
    }

    function CreateTable() {
	$qry = "Create Table $this->tablename ("
		. "id_user INT NOT NULL AUTO_INCREMENT ,"
		. "name VARCHAR ( 64 ) NOT NULL ,"
		. "email VARCHAR ( 64 ) NOT NULL ,"
		. "phone_number VARCHAR ( 16 ) NOT NULL ,"
		. "username VARCHAR ( 32 ) NOT NULL ,"
		. "password VARCHAR ( 32 ) NOT NULL ,"
		. "confirmcode VARCHAR ( 32 ) NOT NULL ,"
		. "admin TINYINT ( 1 ) NOT NULL ,"
		. "PRIMARY KEY ( id_user )" . ")";

	if (!mysql_query($qry, $this->connection)) {
	    $this->HandleDBError("Error creating the table \nquery was\n $qry");
	    return false;
	}
	return true;
    }

    function InsertIntoDB(&$formvars) {

	$confirmcode = $this->MakeConfirmationMd5($formvars['email']);

	$formvars['confirmcode'] = $confirmcode;

	$insert_query = 'insert into ' . $this->tablename . '(
                name,
                email,
                phone_number,
                username,
                password,
                confirmcode,
		admin
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['name']) . '",
                "' . $this->SanitizeForSQL($formvars['email']) . '",
                "' . $this->SanitizeForSQL($formvars['phone_number']) . '",
                "' . $this->SanitizeForSQL($formvars['username']) . '",
                "' . md5($formvars['password']) . '",
                "' . $confirmcode . '",
		"0"
                )';
	if (!mysql_query($insert_query, $this->connection)) {
	    $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
	    return false;
	}
	return true;
    }

    function MakeConfirmationMd5($email) {
	$randno1 = rand();
	$randno2 = rand();
	return md5($email . $this->rand_key . $randno1 . '' . $randno2);
    }

    function SanitizeForSQL($str) {
	if (function_exists("mysql_real_escape_string")) {
	    $ret_str = mysql_real_escape_string($str);
	} else {
	    $ret_str = addslashes($str);
	}
	return $ret_str;
    }

    function Sanitize($str, $remove_nl = true) {
	$str = $this->StripSlashes($str);

	if ($remove_nl) {
	    $injections = array('/(\n+)/i', '/(\r+)/i', '/(\t+)/i', '/(%0A+)/i', '/(%0D+)/i', '/(%08+)/i', '/(%09+)/i');
	    $str = preg_replace($injections, '', $str);
	}

	return $str;
    }

    function StripSlashes($str) {
	if (get_magic_quotes_gpc()) {
	    $str = stripslashes($str);
	}
	return $str;
    }

}

?>
