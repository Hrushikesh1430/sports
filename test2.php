<?php
session_start();
require_once ('config.php');
if (isset($_POST['first']) && $_POST['types'] && $_POST['singles'] ){
  $stmt = $pdo->prepare('INSERT INTO profile
  (ID,SPORT,Type,Player1,Player2) VALUES (:id,:sp,:ty,:p1,:p2)');
  $stmt->execute(array(
  ':id' => $_SESSION['user_id'],
':sp' => $_POST['first'],
':ty' => $_POST['types'],
':p1' => $_POST['singles'],
':p2' => $_POST['doubles'],)

);
}
?>






<!DOCTYPE html>
<html>
    <head>
        <title>GPL 2020</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
</head>
<form action="test.php" method="post"> 
    <select name="first" id="sports"> 
      <option value= "none">Select an option</option>
      <option value ="cricket">cricket</option>
      <option value ="badminton">badminton</option>
      <option value ="tt">tt</option>
      <option value ="chess">chess</option>
    </select> 
    <input type="submit" name="submit"> 
    <div id="showtype"></div>
       <div id="total"></div>
</form> 