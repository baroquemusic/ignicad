<?php
require_once ("./include/kalyha.php");

$kalyha = new KalyhaC3D();

session_start();

$kalyha -> session_user_id = $_SESSION['id_of_user'];

$kalyha -> initDB('fdb31.runhosting.com', '3943963_icad', 'nxYrAf0p2D', '3943963_icad', 'felhasznalok', 'projektek', 'fustjaratok');

?>
