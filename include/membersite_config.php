<?PHP
require_once ("./lang/lang.en.php");
require_once ("./include/fg_membersite.php");

$fgmembersite = new FGMembersite();

$fgmembersite -> SetWebsiteName('ignicad.com');

$fgmembersite -> SetAdminEmail('registration@ignicad.com');

$fgmembersite -> InitDB(/*hostname*/'eagleaircraftch.ipagemysql.com',
/*username*/'ignicad_com',
/*password*/'nxYrAf0p2D',
/*database name*/'ignicad_com',
/*table name*/'felhasznalok');

//http://tinyurl.com/randstr
$fgmembersite -> SetRandomKey('WFmxMracp5HYlxG');




$fgmembersite_log = new FGMembersite();

$fgmembersite_log -> SetWebsiteName('ignicad.com');

$fgmembersite_log -> SetAdminEmail('registration@ignicad.com');

$fgmembersite_log -> InitDB(/*hostname*/'eagleaircraftch.ipagemysql.com',
/*username*/'ignicad_com',
/*password*/'nxYrAf0p2D',
/*database name*/'ignicad_com',
/*table name*/'felhasznalok');

//http://tinyurl.com/randstr
$fgmembersite_log -> SetRandomKey('WFmxMracp5HYlxG');

?>