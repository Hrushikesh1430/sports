<?php
 session_start();
 if ( ! isset( $_SESSION['user_id']) ) {
     die('Please signup and login then register');
  }
  ?>
<?php
require_once ('config.php');

if (isset($_POST['first'])){
  if ( $_POST['first'] == 'none')
  {
    $_SESSION['error'] ='Enter valid data';
    header("Location: register.php");
    return;
  }
  $stmt = $pdo->prepare('INSERT INTO profile
  (ID,SPORT,Type,Player1,Player2,captian) VALUES (:id,:sp,:ty,:p1,:p2,:cp)');
  $stmt->execute(array(
  ':id' => $_SESSION['user_id'],
':sp' => $_POST['first'],
':ty' => $_POST['types'],
':cp' => $_POST['captian'],
':p1' => $_POST['singles'],
':p2' => $_POST['doubles'],)

);
$_SESSION['success'] ='Registration done successfully';
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
        <link rel="stylesheet" type="text/css" href="assets/styles/register.css">


        
      
        
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
                    <li><a href="schedules.php">Schedule</a></li>
                    <?php
                    if ( ! isset( $_SESSION['user_id']) ) {
                    echo'<li><a href="signup.php">Sign up</a></li>';
                    }
                    ?>
                    <li class="active"><a href="register.php">Register</a></li>
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
</header>
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
  <div class="form-signup" id="myForm">
  <form method="post" class="form-container" action="register.php">
    <h2>Registration</h2>
    <label for="first"><b>SELECT YOUR SPORT</b></label>
    <select name="first" id="sports"> 
      <option value= "none">Select an option</option>
      <option value ="cricket">Cricket</option>
      <option value ="badminton">Badminton</option>
      <option value ="tt">Table tennis</option>
      <option value ="chess">Chess</option>
    </select> 
    <div id="showtype"></div>
       <div id="total"></div>
       <input type="submit" name="submit"> 
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
            <img src="assets\images.png"></a>
            </div>
          </div>
         </div>
    </div>
    </div>

</footer>
<script>
  $("select#sports").on("change", function () {
    var number = $(this).children("option:selected").val();
    var players = "<label><b>No. of players</label>";  
    var players2 =   "<label><b>Select type</b></label>";
    var cricket1 =  '<select ><option value="0">11</option></select>';
    var chess1  =  '<select ><option value="0">1</option></select>';
    var tt1  =  '<select id="types" name="types"><option value="0">Select an option</option><option value="singles">Singles</option><option value="doubles">Doubles</option></select>';
    var bad1  =  '<select id="types" name="types"><option value="0">Select an option</option><option value="singles">Singles</option><option value="doubles">Doubles</option></select>';
    $("#showtype").html('');
    $("#total").html('');
    var html = '';

    if (number === "none"){
      alert ('Select a valid option');

    }
    if (number === "cricket"){
      $('#total label').remove();
    var singlelabel = '<div id="pn"><label for="captian"><b>Enter player Name</b></label>';
    var single = '</p><input type="text" placeholder="Enter Player name" id="single" name="captian" required></div><br>';
    var add = '';
    html = players + cricket1 ;
    add = singlelabel + single;
    amount = '<label><b>Amount per player is ₹30 </label></br><label> Total amount to be paid is ₹330<b></label>';
    $('#showtype').append(html+add);
    $("#total").append(amount);
      
    }
    else if(number  === "badminton"){
      html = players2 + bad1;
      $('#showtype').append(html);
      var add = '';
      var add1 = '';
      
      $("select#types").on("change", function () {
        
        var aakda = $(this).children("option:selected").val();
        var singlelabel = '<div id="pn"><label for="single"><b>Enter player Name</b></label>';
        var single = '</p><input type="text" placeholder="Enter Player name" id="single" name="singles" required></div><br>';
        var doublelabel = '<div id="pn"><label for="single"><b>Enter player Name</b></label>';
        var double = '</p><input type="text" placeholder="Enter Player name" id="single" name="doubles" required></div><br>';
        if (aakda === "none"){
          
            alert ('Select a valid option');
            $('#showtype div').remove(); 
          } 
       else if (aakda === "singles"){
        $('#showtype div').remove(); 
        $('#total label').remove();
            amount = '<label><b>Amount per player is ₹30 </label></br><label> Total amount to be paid is ₹30<b></label>';
            add = singlelabel + single;
            $('#showtype').append(add);
            $("#total").append(amount);
          }
          else if(aakda === "doubles"){
            $('#showtype div').remove(); 
            $('#total label').remove();
            amount = '<label><b>Amount per player is ₹30 </label></br><label> Total amount to be paid is ₹60<b></label>';
            add = singlelabel + single;
            add1 = doublelabel + double;
            $('#showtype').append(add + add1);
            $("#total").append(amount);
          }
          else{
            alert ('Select a valid option');
            $('#showtype div').remove(); 
          }
          });
     
  
     
    }
    else if(number === "tt"){
       html = players2 + tt1;
       $('#showtype').append(html);
      var add = '';
      var add1 = '';
      var amount = '';
      
      $("select#types").on("change", function () {
        
        var aakda = $(this).children("option:selected").val();
        var singlelabel = '<div id="pn"><label for="single"><b>Enter player Name</b></label>';
        var single = '</p><input type="text" placeholder="Enter Player name" id="single" name="singles" required></div><br>';
        var doublelabel = '<div id="pn"><label for="single"><b>Enter player Name</b></label>';
        var double = '</p><input type="text" placeholder="Enter Player name" id="single" name="doubles" required></div><br>';
        if (aakda == 0){
          
            alert ('Select a valid option');
            $('#showtype div').remove(); 
          } 
       else if (aakda === "singles"){
        $('#showtype div').remove(); 
        $('#total label').remove();
            amount = '<label><b>Amount per player is ₹30 </label></br><label> Total amount to be paid is ₹30<b></label>';
            add = singlelabel + single;
            $('#showtype').append(add);
            $("#total").append(amount);
          }
          else if(aakda === "doubles"){
            $('#showtype div').remove(); 
            $('#total label').remove();
            amount = '<label><b>Amount per player is ₹30 </label></br><label> Total amount to be paid is ₹60<b></label>';
            add = singlelabel + single;
            add1 = doublelabel + double;
            $('#showtype').append(add + add1);
            $("#total").append(amount);
          }
          else{
            alert ('Select a valid option');
            $('#showtype div').remove(); 
          }
          });
     
  
     
    }
    else if(number === "chess"){
      $('#total label').remove();
      var singlelabel = '<div id="pn"><label for="captian"><b>Enter player Name</b></label>';
    var single = '</p><input type="text" placeholder="Enter Player name" id="single" name="captian" required></div><br>';
    var add = '';
    html = players + chess1 ;
    add = singlelabel + single;
      amount = '<label><b>Amount per player is ₹30 </label></br><label> Total amount to be paid is ₹30<b></label>';
      $('#showtype').append(html+add);
      $("#total").append(amount);
    }
    else {
     alert('Select a valid option to proceed');
      
    }
 });
</script>
 <script src="assets/js/index.js"></script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>