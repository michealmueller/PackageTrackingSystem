<?php
session_start();
if(isset($_SESSION['loggedin']) == TRUE)
{
    if($_SESSION['loginType'] == 'employee')
    {
        $logedin = '<div><a href="employeeCenter.php"> Welcome, '.$_SESSION["username"].'</a> <div class="form-group"><a href="Backend/logout.php"><button class="btn btn-danger btn-sm btn-block" type="button">Log Out</button></a></div></div>';
    }
    else{
        $logedin = '<div><a href="clientCenter.php"> Welcome, '.$_SESSION["username"].'</a> <div class="form-group"><a href="Backend/logout.php"><button class="btn btn-danger btn-sm btn-block" type="button">Log Out</button></a></div></div>';
    }
}
else{
    $notloggedin = '<table><tr><td><div class="form-group">
                        <input class="form-control input-sm" type="text" name="pronumber" placeholder="ProNumber" required>
                    </div></td>
                        <td>&nbsp;</td>
                        <td><input class="btn btn-primary btn-sm" type="submit" value="Submit"></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><a href="TrackingSystemLogin.php" class="btn btn-success btn-sm" role="button">Login </a></td></tr></table>';
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
                 <span class="sr-only">Toggle Navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
             </button>
             <a class="navbar-brand" href="/">BestWay Transfer & Storage Inc.</a>
         </div>
         <div class="navbar-collapse collapse">
             <ul class="nav navbar-nav">
                 <li><a href="/">Home</a></li>
                 <?php
                 if(isset($_SESSION['loggedin']))
                 {
                     if($_SESSION['loginType'] == 'employee')
                     {
                         echo '<li><a href="employeeCenter.php">Employee Center</a></li>';
                     }
                     elseif($_SESSION['loginType'] == 'company')
                     {
                         echo '<li><a href="clientCenter.php">Client Center</a></li>';
                     }
                 }
                 else
                 {
                     echo '
                                <li><a href="TrackingSystemLogin.php">Employee Center</a></li>
                                <li><a href="TrackingSystemLogin.php">Client Center</a></li>
                            ';
                 }
                 ?>


             </ul>
             <!--NavBar Login-->
             <form class="navbar-form navbar-right" action="basicsearch.php" method="get">
                 <?php
                 if(!isset($logedin))
                 {
                     echo $notloggedin;
                 }
                 else{
                     echo $logedin;
                 }
                 ?>
             </form>
             <!--/NavBar Login-->
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