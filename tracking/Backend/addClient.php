<?php
/**
 * Created by PhpStorm.
 * User: micheal
 * Date: 11/25/13
 * Time: 2:15 PM
 */

namespace Backend;
use PDO;
use PDOException;

class addClient
{
    function getInfo($compUser, $compPass, $companyname)
    {
        if (self::checkInput() == false)
        {
            //todo::echo out error
        }

        self::add($compUser, $compPass, $companyname);


    }

    function checkInput()
    {
        //todo::check userinput
    }

    function add($compUser, $compPass, $companyname)
    {
        $compPass = password_hash($compPass, PASSWORD_BCRYPT);

        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway_trackingSystem;charset=utf8', 'bestway_tracker', 'B3stTransfer1');
        } catch(PDOException $pdoE){
            die('Could not connect to Database: ' . $pdoE->getMessage());
        }

        $sql = "INSERT INTO cust_login (username, password, CompanyName) VALUES('$compUser', '$compPass', '$companyname')";
        $query = $pdo->prepare($sql);
        $query->execute();

    }
} 