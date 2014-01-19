<?php
/**
 * Created by PhpStorm.
 * User: Micheal
 * Date: 12/22/13
 * Time: 12:54 PM
 */

//require_once 'AddClienta.php';

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
    $notloggedin = '<div class="form-group"><input class="form-control input-sm" type="text" name="username" placeholder="Username"required></div><div class="form-group"><input class="form-control input-sm" type="password" name="password" placeholder="Password" required></div><input class="btn btn-primary btn-sm" type="submit" value="Submit">';
}

require_once 'Backend/TrackingSystem.php';

$trackingSystem = new \Backend\TrackingSystem();
$docs = $trackingSystem->getUploads();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BestWay - Employee Center</title>
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
<?php
if($_SESSION['loginType'] != 'employee')
{
    session_destroy();
    echo '<div class="display"><p><h2>You are not a Bestway employee so this page is not accessible to you!, <br><br>Sorry for the inconvenience</h2></p></div>';
    exit();
}
?>
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
                <li><a href="/">Home</a></li>
                <li class="active"><a href="employeeCenter.php">Employee Center</a></li>
                <li><a href="addShipment.php">Add Shipment</a></li>
                <li class="active"><a href="addClient.php">Add Client</a></li>
                <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portal <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Login</a></li>
                    </ul>
                </li>-->
            </ul>
            <!--NavBar Login-->
            <form class="navbar-form navbar-right" action="submit.php" method="post">
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
    <div class="display display-update">
        <h3 class="form-signin-heading">Add Client</h3>
        <form class="form-container" action="submit.php" method="post">
            <table class="table table-bordered">
                <tr>
                    <td><label>Username:</label></td>
                    <td>
                        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Password:</label>
                    </td>
                    <td>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Company Name:</label>
                    </td>
                    <td>
                        <input type="text" name="companyname" class="form-control" placeholder="Company Name" required >
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="submitfrom" value="addClient">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit">
                    </td>
                </tr>
            </table>
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
