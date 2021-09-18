<?php
require_once ("./include/kalyha.php");

$kalyha = new KalyhaC3D();

session_start();

$kalyha -> session_user_id = $_SESSION['id_of_user'];

$kalyha -> initDB('eagleaircraftch.ipagemysql.com', 'ignicad_com', 'nxYrAf0p2D', 'ignicad_com', 'felhasznalok', 'projektek', 'fustjaratok');

?>
