<?php
require_once ("./include/kalyha.php");

$kalyha = new KalyhaC3D();

session_start();

$kalyha -> session_user_id = $_SESSION['id_of_user'];

$kalyha -> initDB('sql3.freesqldatabase.com', 'sql3438272', 'G6C7lXK5WM', 'sql3438272', 'felhasznalok', 'projektek', 'fustjaratok');

?>
