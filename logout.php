<?php // line added to turn on color syntax highlight

session_start();
session_destroy();
$_SESSION['error']='User successfully logged out';
header('Location: index.php');

?>