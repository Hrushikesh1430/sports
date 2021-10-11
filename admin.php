  
<?php
require_once ('config.php');
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
    <div  class="logo"><a href="#"><img src="../project/assets/images.png"></a>
</div>

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
                GPL 2020 </br>
                   <br>
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

            <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span> User registrations</a></li>
            <li><a href="sports.php"><span class="glyphicon glyphicon-edit"></span> Sports registrations</a></li>
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
        <div class="scrollit">
              <table id="mytable" class="table table-bordred table-striped">
                   <thead>
                   
                   <th>ID</th>
                     <th>FirstName</th>
                     <th>LastName</th>
                     <th>Email</th>
                     <th>Contact</th>
                     <th>username</th>
                     <th>password</th>
                   </thead>
    <tbody>
    <?php
    $stmt=$pdo->query("SELECT ID,FirstName,LastName,email,phone,username,password FROM users1");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {  echo "<tr><td>";
    echo(htmlentities($row['ID']));
    echo("</td><td>");
    echo(htmlentities($row['FirstName']));
    echo("</td><td>");
    echo(htmlentities($row['LastName']));
    echo("</td><td>");
    echo(htmlentities($row['email']));
    echo("</td><td>");
    echo(htmlentities($row['phone']));
    echo("</td><td>");
    echo(htmlentities($row['username']));
    echo("</td><td>");
    echo(htmlentities($row['password']));
    echo"</td></tr>";
  }
  ?>  
    </tbody>
        
</table>
</div>

                
            </div>
            
        </div>
	</div>
</div>
         
        </div>
    </div>
</div>
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
 