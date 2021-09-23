<?PHP
require_once ("./lang/lang.en.php");
require_once ("./include/fg_membersite.php");

$fgmembersite = new FGMembersite();

$fgmembersite -> SetWebsiteName('ignicad.atwebpages.com');

$fgmembersite -> SetAdminEmail('registration@ignicad.com');

$fgmembersite -> InitDB(/*hostname*/'fdb31.runhosting.com',
/*username*/'3943963_icad',
/*password*/'nxYrAf0p2D',
/*database name*/'3943963_icad',
/*table name*/'felhasznalok');

//http://tinyurl.com/randstr
$fgmembersite -> SetRandomKey('WFmxMracp5HYlxG');




$fgmembersite_log = new FGMembersite();

$fgmembersite_log -> SetWebsiteName('ignicad.atwebpages.com');

$fgmembersite_log -> SetAdminEmail('registration@ignicad.com');

$fgmembersite_log -> InitDB(/*hostname*/'fdb31.runhosting.com',
/*username*/'3943963_icad',
/*password*/'nxYrAf0p2D',
/*database name*/'3943963_icad',
/*table name*/'felhasznalok');

//http://tinyurl.com/randstr
$fgmembersite_log -> SetRandomKey('WFmxMracp5HYlxG');

?>
