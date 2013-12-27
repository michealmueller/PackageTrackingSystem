<?php
/**
 * Created by PhpStorm.
 * User: Micheal
 * Date: 12/27/13
 * Time: 12:57 PM
 */
require_once 'Backend/TrackingSystem.php';

$tracking = new Backend\TrackingSystem();
$input = $_GET['pronumber'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BestWay - Client Center</title>
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
                <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portal <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Login</a></li>
                    </ul>
                </li>-->
            </ul>
            <!--NavBar Login-->
            <form class="navbar-form navbar-right" action="submit.php" method="post">
            </form>
            <!--/NavBar Login-->
        </div><!--/.nav-collapse -->
    </div>
</div>
<!--NavBar End-->
<form class="form-inline" action="" method="post">
    <div class="form-group-search">
        <div class="instructions"><h4>Enter your Pro Number or Company Name to view shipment(s).</h4></div>
        <input class="form-control input-sm input-width" type="text" name="input"
               placeholder="ProNumber" autofocus>

        <input class="btn btn-success btn-sm" type="submit" name="submit" value="Search">
    </div>
</form>

<div class="shipment-container">
    <div class="display ">
        <table class="table table-bordered">
            <tr>
                <td><b>ProNumber</b></td>
                <td><b>Status</b></td>
                <td><b>Picked Up Location</b></td>
                <td><b>Delivery Location</b></td>
                <td colspan="2"><b>Current Location</b></td>
            </tr>
            <?php
            if(isset($_POST['submit']))
            {
                $shipments = $tracking->getShipment($_POST['input']);

                echo '<tr><td>'. $shipments['result'][0]['ProNumber'].'</td>
                    <td>'.$shipments['result'][0]['Status'].'</td>
                    <td>'.$shipments['result'][0]['Pickup_Location'].'</td>
                    <td>'.$shipments['result'][0]['Delivery_Location'].'</td>
                    <td>'.$shipments['result'][0]['CurrentLocationCity'].'</td>
                    <td>'.$shipments['result'][0]['CurrentLocationState'].'</td>
                </tr>';
            }
            else{
                $shipments = $tracking->getShipment($input);

                echo '<tr><td>'. $shipments['result'][0]['ProNumber'].'</td>
                    <td>'.$shipments['result'][0]['Status'].'</td>
                    <td>'.$shipments['result'][0]['Pickup_Location'].'</td>
                    <td>'.$shipments['result'][0]['Delivery_Location'].'</td>
                    <td>'.$shipments['result'][0]['CurrentLocationCity'].'</td>
                    <td>'.$shipments['result'][0]['CurrentLocationState'].'</td>
                </tr>';
            }
            ?>
        </table>
        <hr>
        <footer>
            <p>&copy; BestWay Transfer & Storage Inc. 2013</p>
        </footer>
    </div>
</div>