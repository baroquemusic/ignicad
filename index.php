<?PHP
require_once ("./include/membersite_config.php");

if (isset($_POST ['submitted_log'])) {
    if ($fgmembersite_log->Login()) {
	$fgmembersite_log->RedirectToURL("home.php");
    }
}

if (isset($_POST ['submitted'])) {
    if ($fgmembersite->RegisterUser()) {
	$fgmembersite->RedirectToURL("thank-you.php");
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang['HTML_LANG']; ?>" lang="<?php echo $lang['HTML_LANG']; ?>">
    <head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title><?php echo $lang['PAGE_TITLE']; ?></title>
	<script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
	<script type="text/javascript" src="scripts/pwdwidget.js"></script>
	<script type="text/javascript" src="scripts/jquery-1.9.1.min.js"></script>
	<link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
	<link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
    </head>
    <body>
	<div id="fg_index_container">
	    <div id="welcome">
		<fieldset><legend><object data="./images/ignicad_print.svg" type="image/svg+xml" style="position: relative; top: 11px;"></object></legend><h1 style="display: inline;"><?php echo $lang['WELCOME']; ?></h1><br><span style="color: #F60; font-weight: bold; font-size: 1.5em;"><?php echo $lang['WELCOME_SUB']; ?></span></fieldset>
	    </div>
	    <div style="float: left;">
		<div id='fg_membersite'>
		    <form id='login'
			  action='<?php echo $fgmembersite_log->GetSelfScript(); ?>'
			  method='post' accept-charset='UTF-8'>
			<fieldset>
			    <legend><?php echo $lang['LOG_IN']; ?></legend>

			    <input type='hidden' name='submitted_log' id='submitted_log'
				   value='1' />

			    <div class='short_explanation'><?php echo $lang['PLEASE_FILL_ALL_FIELDS']; ?></div>

			    <div>
				<span class='error'><?php echo $fgmembersite_log->GetErrorMessage(); ?></span>
			    </div>
			    <div class='container'>
				<label for='username'><?php echo $lang['USER_NAME']; ?></label><br /> <input
				    type='text' name='username' id='username'
				    value='<?php echo $fgmembersite_log->SafeDisplay('username') ?>'
				    maxlength="64" autofocus /><br /> <span id='login_username_errorloc'
				    class='error'></span>
			    </div>
			    <div class='container'>
				<label for='password'><?php echo $lang['PASSWORD']; ?></label><br /> <input
				    type='password' name='password' id='password' maxlength="32" /><br />
				<span id='login_password_errorloc' class='error'></span>
			    </div>

			    <div class='container'>
				<input type='submit' name='Submit' value='<?php echo $lang['LOG_IN']; ?>' />
			    </div>
			    <div class='short_explanation'>
				<a href='reset-pwd-req.php'><?php echo $lang['FORGOT_PASSWORD']; ?></a>
			    </div>
			</fieldset>
		    </form>
		</div>
		<div id='fg_membersite'><fieldset><legend>About igniCAD</legend>Coming soon...</fieldset></div>
	    </div>
	    <div style="display: inline-block;">
		<div id='fg_membersite'><fieldset><legend>Browser</legend><div id="chrome"></div></fieldset></div>
		<div id='fg_membersite'><fieldset><legend>User Manual</legend>
		    The igniCAD User Manual is available in MS Word format.<br>
		    <a href="./downloads/ignicad_manual_en.docx" target="_blank">Click here to download!</a></fieldset>
		</div>
	    </div>
	    <div style="float: right;">
		<div id='fg_membersite'>
		    <form id='register'
			  action='<?php echo $fgmembersite->GetSelfScript(); ?>'
			  method='post' accept-charset='UTF-8'>
			<fieldset>
			    <legend><?php echo $lang['REGISTRATION']; ?></legend>

			    <input type='hidden' name='submitted' id='submitted' value='1' />

			    <div class='short_explanation'><?php echo $lang['PLEASE_FILL_ALL_FIELDS']; ?></div>
			    <input type='text' class='spmhidip'
				   name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />

			    <div>
				<span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span>
			    </div>
			    <div class='container'>
				<label for='name'><?php echo $lang['FULL_NAME']; ?></label><br /> <input type='text'
													 name='name' id='name'
													 value='<?php echo $fgmembersite->SafeDisplay('name') ?>'
													 maxlength="64" /><br /> <span id='register_name_errorloc'
													 class='error'></span>
			    </div>
			    <div class='container'>
				<label for='email'><?php echo $lang['EMAIL_ADDR']; ?></label><br /> <input type='text'
													   name='email' id='email'
													   value='<?php echo $fgmembersite->SafeDisplay('email') ?>'
													   maxlength="64" /><br /> <span id='register_email_errorloc'
													   class='error'></span>
			    </div>
			    <div class='container'>
				<label for='phone_number'><?php echo $lang['PHONE_NUM']; ?></label><br />
				<input type='text' name='phone_number' id='phone_number'
				       value='<?php echo $fgmembersite->SafeDisplay('phone_number') ?>'
				       maxlength="16" /><br /> <span
				       id='register_phone_number_errorloc' class='error'></span>
			    </div>
			    <div class='container'>
				<label for='username'><?php echo $lang['USER_NAME']; ?></label><br /> <input
				    type='text' name='username' id='username'
				    value='<?php echo $fgmembersite->SafeDisplay('username') ?>'
				    maxlength="32" /><br /> <span id='register_username_errorloc'
				    class='error'></span>
			    </div>
			    <div class='container'>
				<label for='password'><?php echo $lang['PASSWORD']; ?></label><br />
				<div class='pwdwidgetdiv' id='thepwddiv'></div>
				<noscript>
				    <input type='password' name='password' id='password' maxlength="32" />
				</noscript>
				<div id='register_password_errorloc' class='error'
				     style='clear: both'></div>
			    </div>

			    <div class='container'>
				<input type='submit' name='Submit' value='<?php echo $lang['REGISTRATION']; ?>' />
			    </div>
			    <div class='short_explanation'>
				By clicking on the “Registration” button, you agree that you have read, understand, and accept the Terms and Conditions for all use of igniCAD’s services.
				    <a href="./downloads/ignicad_aszf.docx" target="_blank">You can download igniCAD Terms and Conditions by clicking here!</a>
			    </div>

			</fieldset>
		    </form>
		</div>
		<div id='fg_membersite'><fieldset><legend>Contact</legend>
		+36 20 256 4044<br>
		info (at) ignicad (dot) com<br>
		<b>Skype:</b> ignicad.com
		</fieldset></div>
	    </div>
	</div>

	<script type='text/javascript'>
	    $(function() {
		if (!/chrom(e|ium)/.test(navigator.userAgent.toLowerCase())) {
		    $("#chrome").html("We advise you to use Google Chrome browser for perfect visualization!<br>&nbsp;<br><a href='https://www.google.com/intl/en/chrome/browser/'>Please install Google Chrome by clicking here!</a>");
		} else {
		    $("#chrome").html("Thank you for using Google Chrome browser!");
		}
	    });
	    var pwdwidget = new PasswordWidget('thepwddiv', 'password');
	    pwdwidget.MakePWDWidget();

	    var frmvalidator = new Validator("register");
	    frmvalidator.EnableOnPageErrorDisplay();
	    frmvalidator.EnableMsgsTogether();
	    frmvalidator.addValidation("name", "req", "<?php echo $lang['PROVIDE_FULL_NAME']; ?>");
	    frmvalidator.addValidation("email", "req", "<?php echo $lang['PROVIDE_EMAIL_ADDR']; ?>");
	    frmvalidator.addValidation("email", "email", "<?php echo $lang['PROVIDE_VALID_EMAIL_ADDR']; ?>");
	    frmvalidator.addValidation("phone_number", "req", "<?php echo $lang['PROVIDE_PHONE_NUM']; ?>");
	    frmvalidator.addValidation("phone_number", "num", "<?php echo $lang['PROVIDE_VALID_PHONE_NUM']; ?>");
	    frmvalidator.addValidation("username", "req", "<?php echo $lang['PROVIDE_USER_NAME']; ?>");
	    frmvalidator.addValidation("password", "req", "<?php echo $lang['PROVIDE_PASSWORD']; ?>");

	    var frmvalidator = new Validator("login");
	    frmvalidator.EnableOnPageErrorDisplay();
	    frmvalidator.EnableMsgsTogether();
	    frmvalidator.addValidation("username", "req", "<?php echo $lang['PROVIDE_USER_NAME']; ?>");
	    frmvalidator.addValidation("password", "req", "<?php echo $lang['PROVIDE_PASSWORD']; ?>");
	</script>
	<script>
// GOOGLE ANALITYCS IDE JON
	</script>
    </body>
</html>