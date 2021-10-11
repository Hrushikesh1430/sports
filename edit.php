<?php
session_start();
require_once ('config.php');
?>
<?php // line added to turn on color syntax highlight



if (!isset($_REQUEST['profileID']))
{
    $_SESSION['error'] = "Missing profile id";
    header('Location:admin.php');
    return;

}


if (isset($_POST['sport']) && isset($_POST['type']) && isset($_POST['player1']) && isset($_POST['player2']) && isset($_POST['captian']) && isset($_POST['profileID']))
{  

    $sql = "UPDATE profile SET sport= :sp, type= :tp ,player1 =:p1, player2 =:p2,captian =:cp WHERE profileID=:profileID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':sp'=> $_POST['sport'],
        ':tp'=> $_POST['type'],
        ':p1'=> $_POST['player1'],
        ':p2'=> $_POST['player2'],
        ':cp'=> $_POST['captian'],
        ':profileID'=> $_POST['profileID']
    ));
  



    $_SESSION['success'] ='Record updated';
    header('Location:sports.php');
    return;

    

}
$stmt = $pdo->prepare("SELECT sport, type,player1,player2,captian,profileID from profile WHERE profileID= :xyz");
$stmt->execute (array (':xyz'=> $_GET['profileID']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false)
{
    $_SESSION['error']='BAD value for profileID';
    header('Location:admin.php');
}
$a = htmlentities($row['sport']);
$b = htmlentities($row['type']);
$c= htmlentities($row['player1']);
$d = htmlentities($row['player2']);
$k = htmlentities($row['captian']);
$profileID=$row['profileID'];


?>
<!DOCTYPE html>
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
<p>Editing Profile for me profile ID :  <?= $profileID ?></p>
<hr>
<form method="post">
<p><b>Sport:</b>
<input type="text" name="sport" value="<?= $a ?>"size="30"/></p>
<hr>
<p><b>Type:</b>
<input type="text" name="type" value="<?= $b ?>" size="30"/></p>
<hr>
<p><b>Player1:</b>
<input type="text" name="player1" value="<?= $c ?>"size="30"/></p>
<hr>
<p><b>Player2:</b>
<input type="text" name="player2" value="<?= $d ?>"size="30"/></p>
<hr>
<p><b>Captian</b>
<input type ="text" name="captian" value ="<?= $k ?>" size="30"></p>
<hr>


 <p><input type="submit" value="Save"/>
    <input type="hidden" name="profileID" value="<?= $profileID ?>">
    <a href="sports.php">Cancel</a></p>
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
</body>
</html>



 
