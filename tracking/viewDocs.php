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

if(isset($_GET['record']))
{
    $record = $_GET['record'];
    $_SESSION['record'] = $_GET['record'];
}
else{
    $record = 0;
}

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
                <li><a href="clientCenter.php">Client Center</a></li>
                <li><a href="addShipment.php">Add Shipment</a></li>
                <li><a href="">Add Client</a></li>
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
    <div class="display">
        <div class="pull-left">
            <?php
                if($_SESSION['loginType'] == 'employee')
                {
                    echo '<a href="employeeCenter.php" class="btn btn-primary btn-md" role="button">&laquo; Back </a>';
                }
                elseif($_SESSION['loginType'] == 'company')
                {
                    echo '<a href="clientCenter.php" class="btn btn-primary btn-md" role="button">&laquo; Back </a>';
                }
            ?>
        </div>
        <div class="pull-right">
            <a href="uploadDocs.php?pronumber=<?php echo $_GET['record']; ?>" class="btn btn-primary btn-md" role="button">Upload Document &raquo;</a>
        </div>

        <p class="text-center text-primary"><h3><b>Uploaded Documents</b></h3></p>
        <table class="table table-hover">
            <tr>
                <td><b>Company Name</b></td>
                <td><b>Document Type</td>
                <td><b>File Name</b></td>
                <td><b>View</b></td>
            </tr>
            <?php
                $trackingSystem = new Backend\TrackingSystem();
                $docs = $trackingSystem->getUploads($record);
                $arrLength = count($docs)-1;
            if($docs == NULL)
            {
                echo '<h2>There are no documents for this ProNumber!</h2>';
            }
            else{
                for($i=0; $i <= $arrLength; $i++)
                {
                    echo '<tr>';
                    foreach($docs[$i] as $value)
                    {
                        echo '<td>'.$value.'</td>';
                    }
                    echo '<td><a href="/tracking/upload/'.$docs[$i]['Location'].'">View</a></td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>