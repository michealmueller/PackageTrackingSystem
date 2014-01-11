<?php
session_start();

if(isset($_SESSION['loggedin']) == TRUE)
{
    if($_SESSION['loginType'] == 'employee')
    {
        $logedin = '<div><a href="employeeCenter.php"> Welcome, '.$_SESSION["username"].'</a> <div class="form-group">
        <table><tr><td><a href="Backend/logout.php"><a href="Backend/logout.php" class="btn btn-danger btn-sm" role="button">Log Out </a></td></tr></table></div></div>';
    }
    else{
        $logedin = '<div><a href="clientCenter.php"> Welcome, '.$_SESSION["username"].'</a> <div class="form-group">
        <table><tr><td><a href="Backend/logout.php"><a href="Backend/logout.php" class="btn btn-danger btn-sm" role="button">Log Out </a></td></tr></table></div></div>';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BestWay Transfer & Storage Inc.</title>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/jumbotron.css" type="text/css">
    <link rel="stylesheet" href="css/FixedNav.css" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

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
                <li class="active"><a href="#">Home</a></li>
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
<div class="shipment-container">
    <div class="display ">
        <div class="jumbotron">
            <div class="container text-center">
                <h1>Bestway Tracking Center</h1>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Multiple tracking options</h2>
                    <p>Track your packages by client name, or ProNumber!</p>
                </div>
                <div class="col-sm-4">

                </div>
                <div class="col-md-4">
                    <h2>Document Storage</h2>
                    <p>Upload and store your documents for quick viewing!</p>
                </div>
            </div>
            <footer>
                <p>&copy; BestWay Transfer & Storage Inc. 2013</p>
            </footer>
        </div>
        </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>