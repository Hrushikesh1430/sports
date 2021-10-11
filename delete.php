<?php
require_once ('config.php');
session_start();
if (isset($_POST['delete']) && isset($_POST['profileID']) )
{
    $sql="DELETE FROM profile WHERE profileID = :zip";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['profileID']));
    $_SESSION['success']='Record deleted';
    header('Location:sports.php');
    return;
}
$stmt = $pdo->prepare("SELECT sport, type,player1,player2,captian,profileID from profile WHERE profileID= :xyz");
$stmt->execute (array (':xyz'=> $_GET['profileID']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false)
{
    $_SESSION['error']='BAD value for user id';
    header('Location:sports.php');
}
$a = htmlentities($row['sport']);
$b = htmlentities($row['type']);
$c= htmlentities($row['player1']);
$d = htmlentities($row['player2']);
$k = htmlentities($row['captian']);
$profileID=$row['profileID'];

?>



<html>
<head>
        <title>GPL 2020</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://kit.fontawesome.com/446b8dfd6c.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="assets/styles/admin.css">
      
        
    </head>
    <div class="row">
    <!-- uncomment code for absolute positioning tweek see top comment in css -->
    <!-- <div class="absolute-wrapper"> </div> -->
    <!-- Menu -->
    <div  class="logo"><a href="#"><img src="../project/assets/images.png"></a></div>

    <div class="side-menu">
    
    <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="brand-wrapper">
            <!-- Hamburger -->
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Brand -->
            <div class="brand-name-wrapper">
                <a class="navbar-brand" href="#">
                   GPL 2020 -
                   ADMIN PANEL
                </a>
            </div>

            <!-- Search -->
            

            <!-- Search body -->
            <div id="search" class="panel-collapse collapse">
                <div class="panel-body">
                </div>
            </div>
        </div>

    </div>

    <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">

            <li ><a href="admin.php"><span class="glyphicon glyphicon-home"></span> User registrations</a></li>
            <li class="active"><a href="sports.php"><span class="glyphicon glyphicon-edit"></span> Sports registrations</a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
          

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
    
    </div>
 <!-- Main Content -->
 <div class="container-fluid">
        <div class="side-body">
            <hr>
           <h1> GPL2020  </h1>
           <div class="container">
    <div class="row">
		
        
        <div class="col-md-12">
        <h4> Control Panel </h4>
        <div >
<body>
<div class="confirm">
<p>Confirm DELETING profileID: <?= htmlentities($row['profileID']) ?> </p>
<hr>
<p>Sport: <?= $a ?> </p>
<hr>
<p>Type: <?= $b ?> </p>
<hr>
<p>Player1:<?= $c ?> </p>
<hr>
<p>Player2: <?= $d  ?> </p>
<hr>
<p>Captain: <?= $k ?> </p>
<hr>
<form method="POST">
<input type="hidden" name="profileID" value="<?= $profileID ?>">
<input name="delete" type="submit" value="Delete">
<a href="sports.php">Cancel</a>

</form>
</div>
</div>
            
        </div>
	</div>
</div>
         
        </div>
    </div>
</div>
</body>
<script>
$(function () {
    $('.navbar-toggle').click(function () {
        $('.navbar-nav').toggleClass('slide-in');
        $('.side-body').toggleClass('body-slide-in');
        $('#search').removeClass('in').addClass('collapse').slideUp(200);

        /// uncomment code for absolute positioning tweek see top comment in css
        //$('.absolute-wrapper').toggleClass('slide-in');
        
    });
   
   // Remove menu for searching
   $('#search-trigger').click(function () {
        $('.navbar-nav').removeClass('slide-in');
        $('.side-body').removeClass('body-slide-in');

        /// uncomment code for absolute positioning tweek see top comment in css
        //$('.absolute-wrapper').removeClass('slide-in');

    });
});
</script>