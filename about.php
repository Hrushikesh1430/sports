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
    <link rel="stylesheet" type="text/css" href="assets/styles/about.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/446b8dfd6c.js" crossorigin="anonymous"></script>

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
                          <a class="dropdown-item" href="#" >About</a>
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
                    <li class="active"><a href="about.php">About</a></li>
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
            <div class="loader-container">
                <div  class="loader"></div>
            </div>
<br>
<br>
<br>
<br>
<br>
<br>
        <section id="about">
            <div class="container">
                <h2 data-aos="fade-right" data-aos-delay="100">ABOUT GPL</h2>
                <div class="border">

                </div>
                <div class=row>
                    <div class="col-lg-3 md-4">
                        <img src="assets/images.png" alt="">
                    </div>
                    <div class="col-lg-9 pt-4 pt-lg-0 md-8 pt-4 pt-md-0 content">
                        <p>Encouraging one and all to adopt sports as an integral part of routine to discipline oneself,
                            to persevere to meet a goal, strengthen relation, instill self-confidence and above all
                            release stress, anxiety. The much awaited sport event GPL 2020 is going to held on December 15
                             to December 30, with great zeal and excitement atmosphere.
                            <br>
                            Sports day include various games competition including indoor and outdoor game like Table
                            Tennis, Badminton, Chess, Carrom, Football, Badminton , Cricket, Volley ball, etc.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        


        <section id="location">
            <div class="container">
                <h2 data-aos="fade-right" data-aos-delay="100">LOCATION</h2>
               
                <div class=row>
                    <div class="border">

                    </div>
                    <div class="col-lg-5 md-4" id="l1">
                        <p class="text-lg-left">K C College Of Engineering Management Studies And Research<br>Sadguru
                            Gardens, Mithbunder Rd, near Kopri, Valmiki Nagar, Thane (E), Mumbai, Maharashtra 400603</p>
                    </div>
                    <div class="col-lg-7 pt-4 pt-lg-0 md-8 pt-4 pt-md-0 content" id="l2">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3768.349739286565!2d72.97797955073082!3d19.179920886964698!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b8da14eacea9%3A0xb4f1e032d9e4fc41!2sK%20C%20College%20Of%20Engineering%20Management%20Studies%20And%20Research!5e0!3m2!1sen!2sin!4v1605281510485!5m2!1sen!2sin"
                            width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""
                            aria-hidden="false" tabindex="0">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>

        <section id="ourteam">
            <div class="container">
                <h2 data-aos="fade-right" data-aos-delay="100">OUR TEAM</h2>
                <div class="border">

                </div>
                <div class=row>
                    <div class="col-lg-4">
                        <a href="#p1" onclick="showp1()"><img src="assets/team/hrushi.jpg"></a>
                        <div class="section" id="p1">
                            <h3>Hrushikesh Tawde</h3>
                            <h3>Sports director</h3>
                            <p> Hrushikesh is the core and backbone of GPL2020 . All the major decisions are taken by him to grow the tournament to this extent. GPL2020 is a step by Hrushikesh  to expand the reach of sports and its values to each and every child in the country. </p>
                       
                        </div>


                    </div>
                    <div class="col-lg-4 ">
                        <a href="#p2" onclick="showp2()"><img src="assets/team/aumkar.jpg"></a>
                        <div class="section" id="p2">
                            <h3>Aumkar Ringe</h3>
                            <h3>Joint Sports Director</h3>
                            <p>Aumkar has been the guiding light for GPL 2020 since the past 5 years. His extremely helpful nature has drived GPL 2020 to its success and we believe this year is no different for him.  </p>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <a href="#p3" onclick="showp3()"><img src="assets/team/advait.jpg"></a>
                        <div class="section" id="p3">
                            <h3>Advait Raorane</h3>
                            <h3>Treasurer</h3>
                            <p> Advait's knowledge of finances has helped GPL2020 to manage the event smoothly without any financial hurdles. His enthusiasm motivates each and every organizing member of GPL2020 to contribute their part to the tournament </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</header>
<div class="form-popup" id="myForm">
    <form action="index.php" method="post" class="form-container">
        <h2 span class="center">Login</span></h2>
              
        <label for="email"><b>Username</b></label>
        <input type="text" placeholder="Enter username" name="uname" required>
              
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="pass" required>
              
        <button type="submit" class="btn">LOGIN</button>
        <button type="submit" class="btn cancel" onclick="closeForm()">CLOSE</button>

        <hr class="mb-3">
        <a href="signup.php"> Sign up for registration</a>
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
        <a href="signup.php"> Sign up for registration</a>
      </form>
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