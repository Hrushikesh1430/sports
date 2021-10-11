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
        <title>GPL 2020</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/446b8dfd6c.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="assets/styles/styles.css">
      
        
    </head>
    <?php
              if ( isset($_SESSION['error']) ){
              // Look closely at the use of single and double quotes
             echo '<script>alert(" ' .htmlentities($_SESSION['error']). '")</script>'; 
              unset ($_SESSION['error']);

}
if ( isset($_SESSION['success']) ){
  // Look closely at the use of single and double quotes
  echo '<script>alert(" ' .htmlentities($_SESSION['success']). '")</script>'; 
  unset ($_SESSION['success']);

}
?>
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
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="schedules.php">Schedule</a></li>
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
            <div class="title">
                <h1>GPL 2020</h1>
            </div>
            <div class="loader-container">
                <div  class="loader"></div>
            </div>
</header>
<div class="adu">
<div class="intro">
  <div  class="ilogo">
    <img src="assets/images.png"></a>
  </div>
  <p>The most awaited tournament GPL 2020 is back again with more thrilling sports.<br>
     This is your chance to stand out from the crowd and make a mark.<br>
     
    </p>
</div>
</div>


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
<div class=quotes>
  <div class="muhammad">
  <p><span style="font-size:200%">"</span>IF My <span style="color: rgb(204, 235, 30)">MIND</span> can concieve it <br>
    And my <span style="color: rgb(130, 231, 36)">HEART</span> can believe it <br>
    -Then I can <span style="color:  rgb(130, 231, 36)">ACHIEVE</span> IT<span style="font-size:200%">"</span><br>
  -MUHAMMAD <span style="color: rgb(130, 231, 36)">ALI</span></p>
  </div>
</div>
<div class="slides">
  <h1>SPORTS OFFERED</h1>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel"  data-interval="3000">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="5" ></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="8"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="assets/sports/cricket3.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>CRICKET</h3>
      </div>
    </div>
    <div class="carousel-item ">
      <img class="d-block w-100" src="assets/sports/carrom.jpg"  alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>CARROM</h3>
      </div>
    </div>
    <div class="carousel-item ">
      <img class="d-block w-100" src="assets/sports/chess1.jpg"  alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>CHESS</h3>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="assets/sports/tt2.jpg" alt="fourth slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>TABLE TENNIS</h3>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="assets/sports/volleyball.jpg" alt="fifth  slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>VOLLEY BALL</h3>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="assets/sports/bad.jpg" alt="sixth slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>BADMINTON</h3>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="assets/sports/football1.jpg" alt="seventh slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>FOOTBALL</h3>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="assets/sports/kabadd1.jpg" alt="eighth slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>KABADDI</h3>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev " href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon " aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>

<div class="reg">
  <h2>HASSLE FREE REGISTRATION</h2>
<div class="container">
  <div class="reg1">
  <div class="row">
   <div class="col-lg-3">
      <i  class="fa fa-user-plus fa-6x " style="color:#6fc934f6;" aria-hidden="true">
      <p>Sign up and Login</p></i>
    </div>
    <div class="col-lg-2">
      <i class="fa fa-arrow-right fa-4x " style="color:#6fc934f6;"aria-hidden="true"></i>
      <i class="fa fa-arrow-down fa-4x " style="color:#6fc934f6; "aria-hidden="true"></i>
    
    </div>
    <div class="col-lg-3">
      <i class="fa fa-file-text-o fa-6x" style="color:#6fc934f6;" aria-hidden="true">
      <p>Register</p></i>
    </div>
    <div class="col-lg-2">
      <i class="fa fa-arrow-right fa-4x " style="color:#6fc934f6;"aria-hidden="true"></i>
      <i class="fa fa-arrow-down fa-4x " style="color:#6fc934f6;" aria-hidden="true"></i>
      </div>
      <div class="col-lg-2 ">
      <i class="fas fa-table-tennis fa-5x" style="color:#6fc934f6;">
      <p>Play</p></i>
    </div>
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
            <img src="assets/images.png"></a>
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