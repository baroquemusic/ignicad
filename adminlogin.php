<?PHP
require_once ("./include/membersite_config.php");

if (isset ( $_POST ['submitted'] )) {
	if ($fgmembersite->AdminLogin ()) {
		$fgmembersite->RedirectToURL ( "adminhome.php" );
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang['HTML_LANG']; ?>" lang="<?php echo $lang['HTML_LANG']; ?>">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title><?php echo $lang['PAGE_TITLE']; ?></title>
<link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
<script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
</head>
<body>

	<div id="fg_container">
		<div id='fg_membersite'>
			<form id='login'
				action='<?php echo $fgmembersite -> GetSelfScript(); ?>'
				method='post' accept-charset='UTF-8'>
				<fieldset>
					<legend><?php echo $lang['ADMIN_LOG_IN']; ?></legend>

					<input type='hidden' name='submitted' id='submitted' value='1' />

					<div class='short_explanation'><?php echo $lang['PLEASE_FILL_ALL_FIELDS']; ?></div>

					<div>
						<span class='error'><?php echo $fgmembersite -> GetErrorMessage(); ?></span>
					</div>
					<div class='container'>
						<label for='username'><?php echo $lang['USER_NAME']; ?></label><br />
						<input type='text' name='username' id='username'
							value='<?php echo $fgmembersite->SafeDisplay('username') ?>'
							maxlength="32" autofocus /><br /> <span id='login_username_errorloc'
							class='error'></span>
					</div>
					<div class='container'>
						<label for='password'><?php echo $lang['PASSWORD']; ?></label><br />
						<input type='password' name='password' id='password'
							maxlength="32" /><br /> <span id='login_password_errorloc'
							class='error'></span>
					</div>

					<div class='container'>
						<input type='submit' name='Submit'
							value='<?php echo $lang['LOG_IN']; ?>' />
					</div>
					<div class='short_explanation'>
						<a href='reset-pwd-req.php'><?php echo $lang['FORGOT_PASSWORD']; ?></a>
					</div>
				</fieldset>
			</form>

			<script type='text/javascript'>
	var frmvalidator = new Validator("login");
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();
	frmvalidator.addValidation("username", "req", "<?php echo $lang['PROVIDE_USER_NAME']; ?>");
	frmvalidator.addValidation("password", "req", "<?php echo $lang['PROVIDE_PASSWORD']; ?>");
</script>
		</div>
	</div>

</body>
</html>