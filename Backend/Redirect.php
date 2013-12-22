<?php
/**
 * Created by PhpStorm.
 * User: micheal
 * Date: 11/30/13
 * Time: 11:50 AM
 */

namespace Backend;

session_start();

require_once 'Backend\TrackingSystem.php';

class Redirect
{
    protected $empoyeeRedirect;
    Protected $customerRedirect;

    function employeeRedirect()
    {
        header('Location: employeeCenter.php');
    }

    function customerRedirect()
    {
        header('Location: clientCenter.php');
    }

    function loginRedirect()
    {
        header('Location: index.php');
    }
    function uploadRedirect()
    {
        header('Location: viewDocs.php?record='.$_SESSION['record']);
    }
    function updateRecord($input)
    {
        $tracking = new \Backend\TrackingSystem();

        $shipments = $tracking->getShipment($input);
        $_SESSION['shipments'] = $shipments;

        header('Location: employeeCenter.php');
    }
} 