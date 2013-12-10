<?php
/**
 * Created by PhpStorm.
 * User: micheal
 * Date: 11/28/13
 * Time: 9:10 AM
 */
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
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portal <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="TrackingSystemLogin.php">Login</a></li>

                        <?php
                        if(isset($_SESSION['loggedin']))
                        {
                            echo '<li class="divider"></li><li><a href="employeeCenter.php">Employee Portal</a></li>';
                            echo '<li><a href="viewShippments.php">Customer Portal</a></li>';
                        }
                        ?>

                    </ul>
                </li>
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
if($_SESSION['username'] != 'BWAdmin' and $_SESSION['loginType'] != 'employee')
{
    session_destroy();
    echo '<div class="display"><p><h2>You are not a Bestway employee so this page is not accessible to you!, <br><br>Sorry for the inconvenience</h2></p></div>';
    exit();
}
?>

<div class="form-container">
    <div class="form-display">
        <form class="form-group" action="submit.php" method="post" enctype="multipart/form-data">
        <table >
            <tr>
                <td><label for="companyName">Company Name:</label></td>
                <td>
                    <input type="text" name="companyName" placeholder="Company Name" class="form-control" required />
                </td>
            </tr>
            <tr>
                <td><label for="file">File to Upload:</label></td>
                <td>
                    <input type="file" name="file" class="form-control" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="docType">File Type:</label>
                </td>
                <td>
                    <input type="radio" name="docType" value="BOL" />Bill of Lading<br>
                    <input type="radio" name="docType" value="POD" />Proof of Delivery
                </td>
            </tr>
            <tr>
                <td><input type="hidden" name="submitfrom" value="upload" /> </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Upload" class="btn btn-success btn-block" />
                </td>
            </tr>


        </table>
        </form>
    </div>
</div>

<hr>

<footer>
    <p>&copy; BestWay Transfer & Storage Inc. 2013</p>
</footer>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>