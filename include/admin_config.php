<?php
require_once ("./include/admin.php");

$admin = new KalyhaC3DAdmin();

session_start();

$admin -> session_user_id = $_SESSION['id_of_user'];

$admin -> initDB('fdb31.runhosting.com', '3943963_icad', 'nxYrAf0p2D', '3943963_icad', 'felhasznalok', 'utalasok', 'kuponok', 'projektek');

?>
