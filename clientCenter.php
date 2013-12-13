<?php
/**
 * Created by PhpStorm.
 * User: micheal
 * Date: 11/30/13
 * Time: 12:36 PM
 */
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
    $notloggedin = '<div class="form-group"><input class="form-control input-sm" type="text" name="username" placeholder="Username"required></div><div class="form-group"><input class="form-control input-sm" type="password" name="password" placeholder="Password" required></div><input class="btn btn-primary btn-sm" type="submit" value="Submit">';
}

require_once 'Backend\TrackingSystem.php';

$trackingSystem = new \Backend\TrackingSystem();
$docs = $trackingSystem->getUploads();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BestWay - Company Center</title>
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
if($_SESSION['loginType'] != 'company')
{
    session_destroy();
    echo '<div class="display"><p><h2>You are not a Bestway Client so this page is not accessible to you!, <br><br>Sorry for the inconvenience</h2></p></div>';
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
                <li><a href="employeeCenter.php">Employee Center</a></li>
                <li class="active"><a href="clientCenter.php">Client Center</a></li>
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
<?php
if(isset($_POST['input']))
{
    $input = $_POST['input'];
}
?>
<form class="form-inline" action="" method="post">
    <div class="form-group-search">
        <div class="instructions"><h4>Enter your Pro Number or Company Name to view shipment(s).</h4></div>;
        <input class="form-control input-sm input-width" type="text" name="input" placeholder="ProNumber or Company Name" <?php if(isset($input)){echo 'value="' .$input. '"';} ?> autofocus>
        <input class="btn btn-success btn-sm" type="submit" name="submit" value="Search">
        <input type="hidden" name="submitfrom" value="">
    </div>
</form>
<div class="shipment-container">
    <div class="display ">
        <table class="table table-bordered">
            <tr>
                <td><b>Record Number</b></td>
                <td><b>Company Name</b></td>
                <td><b>ProNumber</b></td>
                <td><b>Service</b></td>
                <td><b>Equipment</b></td>
                <td><b>Status</b></td>
                <td><b>Picked Up Location</b></td>
                <td><b>Delivery Location</b></td>
                <td colspan="2"><b>Current Location</b></td>
                <?php
                if(is_numeric($input))
                {
                    $inputType = 1;
                    echo '<td><b>Documents</b></td>';
                }
                ?>
                <td><b>Edit</b></td>
            </tr>

            <?php
            if(isset($_POST['submit']))
            {
                $shipments = $trackingSystem->getShipment($_POST['input']);
                //make sure to end div!  //.$shipments['inputtype']

                //print_r($shipments['result']);

                if($shipments['inputtype'] == 0)
                {
                    echo '<tr>';
                    foreach($shipments['result'][0] as $value)
                    {
                        echo '<td>'.$value.'</td>';
                    }

                    echo '<td><a href="viewDocs.php?record='.$shipments['result'][0]['ProNumber'].'">View</a></td>';
                    echo '<td><b><a href="/bestway/edit.php?record='.$shipments['result'][0]['id'].'">Edit</a></b></td>';
                    echo '</tr>';
                }
                elseif($shipments['inputtype'] == 1)
                {
                    //get length of records
                    $arrlength = count($shipments['result']) - 1;

                    for($i=0;$i<=$arrlength;$i++)
                    {
                        echo '<tr>';
                        foreach($shipments['result'][$i] as $value)
                        {
                            echo '<td>'.$value.'</td>';
                        }
                        echo '<td><b><a href="/bestway/edit.php?record='.$shipments['result'][$i]['id'].'">Edit</a></b></td>';
                        echo '</tr>';
                    }

                }
            }
            ?>
        </table>
        <hr>
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