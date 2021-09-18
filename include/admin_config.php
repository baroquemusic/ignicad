<?php
require_once ("./include/admin.php");

$admin = new KalyhaC3DAdmin();

session_start();

$admin -> session_user_id = $_SESSION['id_of_user'];

$admin -> initDB('eagleaircraftch.ipagemysql.com', 'ignicad_com', 'nxYrAf0p2D', 'ignicad_com', 'felhasznalok', 'utalasok', 'kuponok', 'projektek');

?>
