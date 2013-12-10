<?php
/**
 * Created by PhpStorm.
 * User: micheal
 * Date: 12/4/13
 * Time: 9:13 AM
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
<?php
if($_SESSION['username'] != 'BWAdmin' and $_SESSION['loginType'] != 'employee')
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

<div class="form-container">
    <div class="form-display-add-update form-group">

        <form class="form-container" action="submit.php" method="post">
            <table>
                <tr>
                    <td><label>Company Name: </label></td>
                    <td>
                        <input class="form-control input-sm" type="text" name="companyname" />
                    </td>
                </tr>
                <tr>
                    <td><label>ProNumber: </label></td>
                    <td>
                        <input class="form-control input-sm" type="number" name="pronumber" />
                    </td>
                </tr>
                <tr>
                    <td><label>Service: </label></td>
                    <td>
                        <select class="form-control input-sm" name="service">
                            <option value="0">Long Haul</option>
                            <option value="1">Short Haul</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Equipment: </label></td>
                    <td>
                        <select class="form-control input-sm" name="equipment">
                            <option>Van</option>
                            <option>Flatbed</option>
                            <option>Conestoga</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Status: </label></td>
                    <td>
                        <select class="form-control input-sm" name="status">
                            <option value="0">Picked Up</option>
                            <option value="1">In Transit</option>
                            <option value="2">Delivered</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Current Location City: </label></td>
                    <td>
                        <input class="form-control input-sm" type="text" name="currentlocationcity" />
                    </td>
                </tr>
                <tr>
                    <td><label>State: </label></td>
                    <td>
                        <select class="form-control input-sm" name="currentlocationstate">
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District Of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="submitfrom" value="employee_add_update" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="btn btn-block btn-success" type="submit" name="submit" value="Add Shipment" />
                    </td>
                </tr>
            </table>
        </form>
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