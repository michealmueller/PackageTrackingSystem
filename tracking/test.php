<?php
/**
 * Created by PhpStorm.
 * User: micheal
 * Date: 12/7/13
 * Time: 2:08 AM
 */

require_once 'Backend\addClienta.php';
require_once 'Backend\Login.php';
require_once 'Backend\TrackingSystem.php';
require_once 'Backend\Redirect.php';
require_once 'Backend\upload.php';

$Redirect = new \Backend\Redirect();
$login = new \Backend\Login();
$companyAdd = new \Backend\addClient();
$tracking = new \Backend\TrackingSystem();
$upload = new \Backend\upload();
xdebug_break();
$login->checkLogin('comp1', 'Company1');