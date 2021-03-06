<?PHP
require_once ("./include/membersite_config.php");

if (! $fgmembersite->CheckLogin ()) {
	$fgmembersite->RedirectToURL ( "login.php" );
	exit ();
}

if (isset ( $_POST ['submitted'] )) {
	if ($fgmembersite->ChangePassword ()) {
		$fgmembersite->RedirectToURL ( "changed-pwd.php" );
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
<link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
<script src="scripts/pwdwidget.js" type="text/javascript"></script>
</head>
<body>

	<div id="fg_container">
		<div id='fg_membersite'>
			<form id='changepwd'
				action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post'
				accept-charset='UTF-8'>
				<fieldset>
					<legend><?php echo $lang['RESET_PASSWORD']; ?></legend>

					<input type='hidden' name='submitted' id='submitted' value='1' />

					<div class='short_explanation'><?php echo $lang['PLEASE_FILL_ALL_FIELDS']; ?></div>

					<div>
						<span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span>
					</div>
					<div class='container'>
						<label for='oldpwd'><?php echo $lang['CURRENT_PASSWORD']; ?></label><br />
						<div class='pwdwidgetdiv' id='oldpwddiv'></div>
						<br />
						<noscript>
							<input type='password' name='oldpwd' id='oldpwd' maxlength="32" autofocus />
						</noscript>
						<span id='changepwd_oldpwd_errorloc' class='error'></span>
					</div>

					<div class='container'>
						<label for='newpwd'><?php echo $lang['NEW_PASSWORD']; ?></label><br />
						<div class='pwdwidgetdiv' id='newpwddiv'></div>
						<noscript>
							<input type='password' name='newpwd' id='newpwd' maxlength="32" />
							<br />
						</noscript>
						<span id='changepwd_newpwd_errorloc' class='error'></span>
					</div>
					<br />
					<div class='container'>
						<input type='submit' name='Submit'
							value='<?php echo $lang['SUBMIT']; ?>' />
					</div>

				</fieldset>
			</form>

<script type='text/javascript'>

    var pwdwidget = new PasswordWidget('oldpwddiv','oldpwd');
    pwdwidget.enableGenerate = false;
    pwdwidget.enableShowStrength=false;
    pwdwidget.enableShowStrengthStr =false;
    pwdwidget.MakePWDWidget();
    
    var pwdwidget = new PasswordWidget('newpwddiv','newpwd');
    pwdwidget.MakePWDWidget();
    
    
    var frmvalidator  = new Validator("changepwd");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("oldpwd","req","<?php echo $lang['PROVIDE_CURRENT_PASSWORD']; ?>");
    
    frmvalidator.addValidation("newpwd","req","<?php echo $lang['PROVIDE_NEW_PASSWORD']; ?>");


</script>

			<p>
				<a href='home.php'><b><?php echo $lang['BACK']; ?></b></a>
			</p>

		</div>
	</div>


</body>
</html>