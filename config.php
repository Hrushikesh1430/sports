<?php
$db_user="root";
$db_pass="";
$db_name="useraccounts";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=useraccounts', $db_user, $db_pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

