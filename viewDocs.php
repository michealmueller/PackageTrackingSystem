<?php
/**
 * Created by PhpStorm.
 * User: micheal
 * Date: 12/5/13
 * Time: 11:11 PM
 */
session_start();

if(isset($_SESSION['loggedin']) == TRUE)
{
    $logedin = '<div> Welcome, '. $_SESSION["username"] . ' <div class="form-group"><a href="Backend/logout.php"><button class="btn btn-danger btn-sm btn-block" type="button">Log Out</button></a></div></div>';
}
else{
    $notloggedin = '<div class="form-group"><input class="form-control input-sm" type="text" name="username" placeholder="Username"required></div><div class="form-group"><input class="form-control input-sm" type="password" name="password" placeholder="Password" required></div><input class="btn btn-primary btn-sm" type="submit" value="Submit">';
}

require_once 'Backend\TrackingSystem.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BestWay - File Upload</title>
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
if($_SESSION['loggedin'] != TRUE)
{
    session_destroy();
    echo '<div class="display"><p><h2>You are not a Bestway employee or a Bestway Customer, so this page is not accessible to you!, <br><br>Sorry for the inconvenience</h2></p></div>';
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
                <li class="active"><a href="/">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
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
    <div class="displayDocs">
        <p class="text-center text-primary"><h4>Uploaded Documents</h4></p>
        <table class="table table-hover">
            <tr>
                <td>Company Name</td>
                <td>Document Type</td>
                <td>View File</td>
            </tr>
            <?php
                $trackingSystem = new Backend\TrackingSystem();
                $docs = $trackingSystem->getUploads();

                $arrLength = count($docs)-1;
                for($i=0; $i <= $arrLength; $i++)
                {
                    echo '<tr>';
                    foreach($docs[$i] as $value)
                    {
                        echo '<td>'.$value.'</td>';
                    }
                    echo '</tr>';
                }
            ?>
        </table>
    </div>
</div>

</body>
</html>