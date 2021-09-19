<?php
require_once ("./include/admin.php");

$admin = new KalyhaC3DAdmin();

session_start();

$admin -> session_user_id = $_SESSION['id_of_user'];

$admin -> initDB('sql3.freesqldatabase.com', 'sql3438272', 'G6C7lXK5WM', 'sql3438272', 'felhasznalok', 'utalasok', 'kuponok', 'projektek');

?>
