<?PHP
require_once ("./include/membersite_config.php");

$fgmembersite->LogOut ();
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
	<div id='fg_membersite_content'>
		<h2>Admin! <?php echo $lang['SUCCESSFULLY_LOGGED_OUT']; ?></h2>
		<p>
		    <a href='adminlogin.php'><?php echo $lang['LOG_IN']; ?></a>
		</p>
	</div>
</body>
</html>