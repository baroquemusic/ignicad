<?PHP
require_once ("./include/membersite_config.php");

if (isset ( $_GET ['code'] )) {
	if ($fgmembersite->ConfirmUser ()) {
		$fgmembersite->RedirectToURL ( "thank-you-regd.php" );
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
			<h2><?php echo $lang['ALREADY_CONFIRMED_REGISTRATION']; ?></h2>


			<form id='confirm'
				action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='get'
				accept-charset='UTF-8'>
				<div class='short_explanation'><?php echo $lang['PLEASE_FILL_ALL_FIELDS']; ?></div>
				<div>
					<span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span>
				</div>
				<div class='container'>
					<label for='code'><?php echo $lang['CONFIRM_CODE']; ?></label><br />
					<input type='text' name='code' id='code' maxlength="50" /><br /> <span
						id='register_code_errorloc' class='error'></span>
				</div>
				<div class='container'>
					<input type='submit' name='Submit'
						value='<?php echo $lang['SUBMIT']; ?>' />
				</div>

			</form>
		</div>
	</div>

<script type='text/javascript'>

    var frmvalidator  = new Validator("confirm");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("code", "req", "<?php echo $lang['PROVIDE_CONFIRM_CODE']; ?>");

</script>


</body>
</html>