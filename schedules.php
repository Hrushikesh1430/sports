<?php
require_once ('config.php');
session_start();
unset($_SESSION['name']);

?>
<?php
if (isset($_POST['uname']) && isset($_POST['pass']))
{
    $check = ($_POST['pass']);
    $stmt = $pdo->prepare('SELECT ID, Firstname FROM users1
    WHERE username = :em AND password = :pw');
    $stmt->execute(array( ':em' => $_POST['uname'], ':pw' => $check));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row !== false ) {
        $_SESSION['name'] = $row['Firstname'];
        $_SESSION['user_id'] = $row['ID'];
      }
    else{
        $_SESSION['error']='Incorrect username or password';
        header("Location: index.php");
        return;

    }
}
?>
<?php
if (isset($_POST['aname']) && isset($_POST['apass']))
{
    $check = ($_POST['apass']);
    $stmt = $pdo->prepare('SELECT ID FROM admin
    WHERE username = :em AND password = :pw');
    $stmt->execute(array( ':em' => $_POST['aname'], ':pw' => $check));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row !== false ) {
        $_SESSION['user_id'] = $row['ID'];
        header("Location: admin.php");
        return;
      }
    else{
        $_SESSION['error']='Incorrect username or password';
        header("Location: index.php");
        return;

    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>GPL2020</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/446b8dfd6c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="assets/styles/schedule1.css">
    <script src="https://kit.fontawesome.com/446b8dfd6c.js" crossorigin="anonymous"></script>
</head>
<body>
<body>
<header id="first">
            <nav class="navbar navbar-inverse navbar fixed-top ">
              <div class="container-fluid">
                    <div  class="logo"><a href="#"><img src="assets/images.png"></a></div>
                    <div class="progress-container">
                      <div class="progress-bar" id="myBar"></div>
                    </div>
                    <div class="nav1">
                    <ul>
                    <?php
                    if ( ! isset( $_SESSION['user_id']) ) {
                      echo'<li>';
                        echo'<div class="dropdown show">';
                        echo'<a class=" fa fa-user fa-2x" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>';
                        echo'<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">';
                        echo'<a class="dropdown-item" href="#" onclick="openaForm()">ADMIN LOGIN</a>';
                        echo'<a class="dropdown-item" href="#" onclick="openForm()">STUDENT LOGIN</a>';
                        echo'</div>';
                        echo'</div>';
                        echo'</li>';
                    }
                    ?>
                      <?php
                    if (  isset( $_SESSION['user_id']) ) {
                      echo'<li><a href="#"> '.$_SESSION['name'].'</a></li>';
                      echo'<li>';
                      echo'<div class="dropdown show">';
                      echo'<a class="dropdown-toggle fa fa-user fa-2x" target="_blank"  href="logout.php"role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>';
                      echo'<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">';
                      echo'<a class="dropdown-item"  href="logout.php">LOGOUT</a>';
                      echo'</div>';
                      echo'</div></li>';
                    }
                      ?>
                    <li>
                    <div class="dropdown show">
                      <li>
                        <a  class="fa fa-bars fa-2x"  href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="index.php">Home</a>
                          <a class="dropdown-item" href="about.php" >About</a>
                          <a class="dropdown-item" href="schedules.php">Schedule</a>
                          <?php
                          if ( ! isset( $_SESSION['user_id']) ) {
                         echo' <a class="dropdown-item" href="signup.php">Sign up</a>';
                          }
                          ?>
                          <a class="dropdown-item" href="register.php">Register</a>

                      </li>
                    </ul>
                  </div>
                  
                   <div class="nav2">
                <ul>
                    <li ><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li class="active"><a href="#">Schedule</a></li>
                    <?php
                    if ( ! isset( $_SESSION['user_id']) ) {
                    echo'<li><a href="signup.php">Sign up</a></li>';
                    }
                    ?>
                    <li><a href="register.php">Register</a></li>
                    <?php
                    if ( ! isset( $_SESSION['user_id']) ) {
                        echo'<li>';
                        echo'<div class="dropdown show">';
                        echo'<a class="dropdown-toggle fa fa-user fa-2x" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>';
                        echo'<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">';
                        echo'<a class="dropdown-item" href="#" onclick="adminformopen()">ADMIN LOGIN</a>';
                        echo'<a class="dropdown-item" href="#" onclick="openForm()">STUDENT LOGIN</a>';
                        echo'</div>';
                        echo'</div></li>';
                    }
                ?>
                     <?php
                    if ( isset( $_SESSION['user_id']) ) {
                        echo'<li><a href="#"> '.$_SESSION['name'].'</a></li>';
                        echo'<li>';
                        echo'<div class="dropdown show">';
                        echo'<a class="dropdown-toggle fa fa-user fa-2x" target="_blank"  href="logout.php"role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>';
                        echo'<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">';
                        echo'<a class="dropdown-item"  href="logout.php">LOGOUT</a>';
                        echo'</div>';
                        echo'</div></li>';
                    }
                ?>
              </ul>
            </div>
            </nav>
          </div>
            <div class="loader-container">
                <div  class="loader"></div>
            </div>
            <div class="container1">
    <div class="cricket">
        <a href="#" class="cricket">
        <img src="assets/sports/cricket3.jpg" alt="cricket"></a>
        <div >Cricket</div>
    </div>
    <div class="carrom">
        <a href="#" class="carrom">
        <img src="assets/sports/carrom.jpg" alt="carrom"></a>
        <div >Carrom</div>
    </div>
    <div class="football">
        <a href="#" class="football">
        <img src="assets/sports/football1.jpg" alt="football"></a>
        <div >Football</div>
    </div>
    <div class="chess">
        <a href="#" class="chess">
        <img src="assets/sports/chess1.jpg" alt="chess"></a>
        <div>Chess</div>
    </div>
    </div>

    <div class="container2">
        <div class="badminton">
            <a href="#" class="badminton">
                <img src="assets/sports/bad.jpg" alt="badminton">
            </a>
            <div>Badminton</div>
        </div>
        <div class="table_tennis">
            <a href="#" class="table_tennis">
                <img src="assets/sports/tt2.jpg" alt="table_tennis">
                </a>
                <div>Table Tennis</div>
        </div>
        <div class="kabaddi">
            <a href="#" class="kabaddi">
                <img src="assets/sports/kabadd1.jpg" alt="kabaddi">
            </a>
            <div >Kabaddi</div>
        </div>
        <div class="volleyball">
            <a href="#" class="volleyball">
                <img src="assets/sports/volleyball.jpg" alt="volleyball">
            </a>
            <div >Volleyball</div>
        </div>
    </div>
  </header>
  <div class="form-popup" id="myForm">
    <form action="index.php" method="post" class="form-container">
        <h1 span class="center">Login</span></h1>
              
        <label for="email"><b>Username</b></label>
        <input type="text" placeholder="Enter username" name="uname" required>
              
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="pass" required>
              
        <button type="submit" class="btn">LOGIN</button>
        <button type="submit" class="btn cancel" onclick="closeForm()">CLOSE</button>

        <hr class="mb-3">
        <a href="#"> Sign up for registration</a>
      </form>
</div>

<div class="form-popup" id="myadform">
    <form action="index.php" method="post" class="form-container">
        <h1 span class="center">Login</span></h1>
              
        <label for="aname"><b>Admin Username</b></label>
        <input type="text" placeholder="Enter username" name="aname"required >
              
        <label for="apass"><b>Admin Password</b></label>
        <input type="password" placeholder="Enter Password" name="apass" required >
              
        <button type="submit" class="btn">LOGIN</button>
        <button type="submit" class="btn cancel" onclick="adminformclose()">CLOSE</button>

        <hr class="mb-3">
        <a href="#"> Sign up for registration</a>
      </form>
</div>
  <div class="middle">
    <h3>FIXTURES FOR THE TOP 4 TEAMS</h3>
  </div>

<div class="background">

  <div class="container3">
      <div class="box1">
      <div class="qualifier1">QUALIFIER 1</div></div>
      <div class="team1">TEAM 1</div>
      <div class="team2">TEAM 2</div>
  </div>
  <div class="container4">
      <div class="box1">
      <div class="eliminator">ELIMINATOR</div></div>
      <div class="team3">TEAM 3</div>
      <div class="team4">TEAM 4</div>
  </div>
<div class="container5">
  <div class="box1">
  <div class="qualifier2">QUALIFIER 2</div></div>
  <div class="q1">Loser of qualifier 1</div>
  <div class="e1">Winner of eliminator</div>
</div>
<div class="container6">
  <div class="box1">
  <div class="finals">FINALS</div></div>
  <div class="q2">Winner of qualifier 1</div>
  <div class="e2">Winner of qualifier 2</div>
</div>
<div class="hr1"></div>
<div class="hr2"></div>
<div class="hr3"></div>
<div class="vl1"></div>
<div class="vl2"></div>
<div class="vl3"></div>

</div>
  </div>
</div>
</div>


    
    <footer>
  <div class="bottom">
    <div class="container">
      <div class="f1">
      <div class="row">
            <div class="col-lg-4">
              <div class="queries">
                <p>For volunteering  </p>
                <p>Drop your emaild  and we'll reach out to you</p>
                <hr>
                <form  method="post">
                <input type="text" placeholder="Enter Email" name="email" size="38" required>
                  </form>
              </div>
        </div>
        <div class="col-lg-3">
          <div class="fm">
          <h5>Follow us</h5>
          <div class="icons">
          <a href="https://www.instagram.com/kggc_11/"><i class="fa fa-facebook fa-lg" style="color: #000000"></i></a>
          <a href="https://www.instagram.com/kggc_11/" class="fa fa-instagram fa-lg " style="color:#000000;" ></a>
          <a href="https://www.youtube.com/channel/UCfctE9wIF-ZB0fRV375UAsA" class="fa fa-twitter fa-lg" style="color:#000000;" ></a>
        </div>
        <div class="contact">
          <h5>Contact</h5>
          <p><b>gpl2020@gmail.com</b></p>
          <p><b>9892563547</b></p>
        </div>
        </div>
      </div>
        <div class="col-lg-3">
          <div class="smallnav">
            <ul >
              <li ><a href="#">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Schedule</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-1">
          <div  class="logof">
            <img src="assets\images.png"></a>
            </div>
          </div>
         </div>
    </div>
    </div>

</footer>
</body>
<script src="assets/js/index.js"></script>
        <script>
          function adminformopen(){
  document.getElementById("first").style.filter = "blur(8px)";
  document.getElementById("myadform").style.display = "block";
}
function adminformclose(){
  document.getElementById("myadform").style.display = "none";
  document.getElementById("first").style.filter = "none";
  document.getElementById("first").style.transition = "none";
}

          </script>
       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
</html>