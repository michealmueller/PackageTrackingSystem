<?php
/**
 * Created by PhpStorm.
 * User: micheal
 * Date: 11/30/13
 * Time: 11:50 AM
 */

namespace Backend;


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
        header('Location: companyCenter.php');
    }

    function loginRedirect()
    {
        header('Location: index.php');
    }
} 