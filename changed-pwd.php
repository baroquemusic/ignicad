<?php require_once ("./lang/lang.en.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang['HTML_LANG']; ?>" lang="<?php echo $lang['HTML_LANG']; ?>">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title><?php echo $lang['PAGE_TITLE']; ?></title>
<link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">

</head>
<body>
	<div id='fg_membersite_content'>
		<h2><?php echo $lang['PASSWORD_CHANGED']; ?></h2>
		<?php echo $lang['YOUR_PASSWORD_CHANGED']; ?>

		<p>
			<a href='logout.php'><?php echo $lang['LOGOUT']; ?></a>
		</p>

	</div>
</body>
</html>
