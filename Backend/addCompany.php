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

class addCompany
{
    function getInfo($compUser, $compPass, $compName)
    {
        if (self::checkInput() == false)
        {
            //todo::echo out error
        }

        self::add($compUser, $compPass, $compName);


    }

    function checkInput()
    {
        //todo::check userinput
    }

    function add($compUser, $compPass, $compName)
    {
        $compPass = password_hash($compPass, PASSWORD_BCRYPT);

        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway;charset=utf8', 'root', 'Antimatter1024');
        } catch(PDOException $pdoE){
            die('Could not connect to Database: ' . $pdoE->getMessage());
        }

        $query = $pdo->prepare('INSERT INTO cust_login (username, password, company) VALUES (:compUser, :compPass, :compName)');
        $query->execute(array(':compUser'=>$compUser,
                        ':compPass'=>$compPass,
                        ':compName'=>$compName));

    }
} 