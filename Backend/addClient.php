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
    function getInfo($compUser, $compPass, $email)
    {
        if (self::checkInput() == false)
        {
            //todo::echo out error
        }

        self::add($compUser, $compPass, $email);


    }

    function checkInput()
    {
        //todo::check userinput
    }

    function add($compUser, $compPass, $email)
    {
        $compPass = password_hash($compPass, PASSWORD_BCRYPT);

        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway;charset=utf8', 'root', 'Antimatter1024');
        } catch(PDOException $pdoE){
            die('Could not connect to Database: ' . $pdoE->getMessage());
        }

        $sql = "INSERT INTO cust_login (username, password, email) VALUES('$compUser', '$compPass', '$email')";
        $query = $pdo->prepare($sql);
        $query->execute();

    }
} 