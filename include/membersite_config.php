<?PHP
require_once ("./lang/lang.en.php");
require_once ("./include/fg_membersite.php");

$fgmembersite = new FGMembersite();

$fgmembersite -> SetWebsiteName('ignicad.herokuapp.com');

$fgmembersite -> SetAdminEmail('registration@ignicad.com');

$fgmembersite -> InitDB(/*hostname*/'sql3.freesqldatabase.com',
/*username*/'sql3438272',
/*password*/'G6C7lXK5WM',
/*database name*/'sql3438272',
/*table name*/'felhasznalok');

//http://tinyurl.com/randstr
$fgmembersite -> SetRandomKey('WFmxMracp5HYlxG');




$fgmembersite_log = new FGMembersite();

$fgmembersite_log -> SetWebsiteName('ignicad.herokuapp.com');

$fgmembersite_log -> SetAdminEmail('registration@ignicad.com');

$fgmembersite_log -> InitDB(/*hostname*/'sql3.freesqldatabase.com',
/*username*/'sql3438272',
/*password*/'G6C7lXK5WM',
/*database name*/'sql3438272',
/*table name*/'felhasznalok');

//http://tinyurl.com/randstr
$fgmembersite_log -> SetRandomKey('WFmxMracp5HYlxG');

?>
