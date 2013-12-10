<?php
session_start();

if(isset($_SESSION['loggedin']) == TRUE)
{
    $logedin = '<div> Welcome, '. $_SESSION["username"] . ' <div class="form-group"><a href="Backend/logout.php"><button class="btn btn-danger btn-sm btn-block" type="button">Log Out</button></a></div></div>';
}
else{
    $notloggedin = '<div class="form-group"><input class="form-control input-sm" type="text" name="username" placeholder="Username"required></div><div class="form-group"><input class="form-control input-sm" type="password" name="password" placeholder="Password" required></div><input class="btn btn-primary btn-sm" type="submit" value="Submit">';
}
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <title>title</title>
     <link href="css/bootstrap.css" rel="stylesheet">
     <link href="css/signin.css" rel="stylesheet">
     <link href="css/jumbotron.css" rel="stylesheet">
 </head>
 <body>
 <!--NAvBar-->
 <div class="navbar navbar-default navbar-fixed-top" role="navigation">
     <div class="container">
         <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                 <span class="sr-only">Toggle navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
             </button>
             <a class="navbar-brand" href="/">BestWay Transfer & Storage Inc.</a>
         </div>
         <div class="navbar-collapse collapse">
             <ul class="nav navbar-nav">
                 <li class="active"><a href="/">Home</a></li>
                 <li><a href="#about">About</a></li>
                 <li><a href="#contact">Contact</a></li>
                 <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portal <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Login</a></li>
                        <?php
                        /*if(isset($_SESSION['loggedin']) && isset($_SESSION['loginType']) == 'employee')
                        {
                            echo '<li class="divider"></li><li><a href="employeeCenter.php">Employee Portal</a></li>';
                        }
                        elseif(isset($_SESSION['loggedin']) && isset($_SESSION['loginType']) == 'company')
                        {
                            echo '<li class="divider"></li><li><a href="viewShippments.php">Customer Portal</a></li>';
                        }*/
                        ?>

                    </ul>
                </li>-->
             </ul>
         </div><!--/.nav-collapse -->
     </div>
 </div>
 <!--NavBar End-->

 <div class="container shipment-container">
    <div class="display">
        <form class="form-signin" action="submit.php" method="post">
            <h3 class="form-signin-heading">Bestway Package Tracking System Login.</h3>
            <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit">
        </form>
    </div>
     <hr>
<div>
     <footer>
         <p>&copy; BestWay Transfer & Storage Inc. 2013</p>
     </footer>
</div>
 </div>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 <script src="https://code.jquery.com/jquery.js"></script>
 <!-- Include all compiled plugins (below), or include individual files as needed -->
 <script src="js/bootstrap.min.js"></script>
 </body>
</html>