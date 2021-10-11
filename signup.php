<?php
session_start();
// unset($_SESSION['name']);
// unset($_SESSION['user_id']);
require_once ('config.php');
require_once ('util.php');

if (isset($_POST['fname'])  && isset($_POST['lname'])  && isset($_POST['email'])  && isset($_POST['pno'])  && isset($_POST['cname'])  && isset($_POST['uname'])  && isset($_POST['pass'])){
  $msg = validateProfile();
  if (is_string($msg))
  {
    $_SESSION['error']=$msg;
      header("Location: signup.php");
    return;
  }
       $stmt = $pdo->prepare('INSERT INTO users1
        (ID,FirstName,LastName,email,Phone,college,username,password) VALUES ( :uid, :fn, :ln, :em, :po, :cn, :un, :pass)');
           $stmt->execute(array(
            ':uid' => $_SESSION['user_id'],
            ':fn' => $_POST['fname'],
            ':ln' => $_POST['lname'],
            ':em' => $_POST['email'],
            ':po' => $_POST['pno'],
            ':cn' => $_POST['cname'],
            ':un' => $_POST['uname'],
            ':pass' => $_POST['pass'],)
    );

    $_SESSION['success'] ='Registration done successfully';
    header("Location: index.php");
    return;
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
        <link rel="stylesheet" type="text/css" href="assets/styles/signup.css">
      </head>
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
                    <li><a href="#">About</a></li>
                    <li><a href="schedules.php">Schedule</a></li>
                    <?php
                    if ( ! isset( $_SESSION['user_id']) ) {
                    echo'<li class="active"><a href="signup.php">Sign up</a></li>';
                    }
                    ?>
                    <li><a href="register.php">Register</a></li>
              </ul>
            </div>
            </nav>
          </div>
          
          <div class="form-signup" id="myForm1">
            <form method="POST" class="form-container1" action="signup.php">
            <h2>SIGNUP FORM</h2>
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
           <label for="fname"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="fname" >
            <label for="lname"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="lname">
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email">
            <label for="number"><b>Phone Number</b></label>
            <input type="text" placeholder="Enter Phone number" name="pno" >
            <label for="cname"><b>College Name</b></label>
            <input type="text" placeholder="Enter college name" name="cname" >
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter username" name="uname" >
            <label for="pass"><b>Password</b></label>
            <input type="password" placeholder="Enter password" name="pass" >
            <label for="cpass"><b>Confirm Password</b></label>
            <input type="password" placeholder="Enter password" name="cpass" >
            <input type="submit"  name="create" >
         
         

            </form>
          </div>
</header>
<div class="form-popup" id="myForm">
    <form action="registration.php" method="post" class="form-container">
        <h1 span class="center">Login</span></h1>
              
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>
              
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
              
        <button type="submit" class="btn">LOGIN</button>
        <button type="submit" class="btn cancel" onclick="closeForm()">CLOSE</button>

        <hr class="mb-3">
        <a href="#"> Sign up for registration</a>
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
                        <li ><a href="index.php">Home</a></li>
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
        <script src="assets/js/index.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
       </body>
</html>