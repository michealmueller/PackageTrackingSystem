<?php
session_start();

if(isset($_SESSION['loggedin']) == TRUE)
{
    if($_SESSION['loginType'] == 'employee')
    {
        $logedin = '<div><a href="employeeCenter.php"> Welcome, '.$_SESSION["username"].'</a> <div class="form-group"><a href="Backend/logout.php"><button class="btn btn-danger btn-sm btn-block" type="button">Log Out</button></a></div></div>';
    }
    else{
        $logedin = '<div><a href="companyCenter.php"> Welcome, '.$_SESSION["username"].'</a> <div class="form-group"><a href="Backend/logout.php"><button class="btn btn-danger btn-sm btn-block" type="button">Log Out</button></a></div></div>';
    }
}
else{
    $notloggedin = '<div class="form-group">
                        <input class="form-control input-sm" type="text" name="username" placeholder="Username"required>
                        </div>
                        <div class="form-group">
                            <input class="form-control input-sm" type="password" name="password" placeholder="Password" required>
                        </div>
                            <input type="hidden" name="submitfrom" value="standardLogin"/>
                            <input class="btn btn-primary btn-sm" type="submit" value="Submit">';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BestWay</title>
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

<div class="jumbotron">
    <div class="container">
        <h1>Bestway</h1>
        <p>A safe and financially secure organization that Pride itself on communication with you - the customer. Whether it's a request for general information, rates or tracing - we handle it all in a prompt and professional manner and We provide you with a complete transportation package.</p>
        <p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h2>Heading</h2>
            <p>Some basic information about this heading.</p>
        </div>
        <div class="col-md-4">
            <h2>Heading</h2>
            <p>Some basic information about this heading.</p>
        </div>
        <div class="col-md-4">
            <h2>Heading</h2>
            <p>Some basic information about this heading.</p>
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