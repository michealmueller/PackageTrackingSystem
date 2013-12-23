<?php
/**
 * Created by PhpStorm.
 * User: micheal
 * Date: 11/23/13
 * Time: 8:17 AM
 */

namespace Backend;
use PDO;
use PDOException;

class Login
{
    function checkLogin($username, $password)
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway_trackingSystem', 'bestway_tracker', 'B3stTransfer1');
        }catch (PDOException $pdoE){
            die("Could not connect: ". $pdoE->getMessage());
        }

        $sql = "SELECT username, password FROM cust_login WHERE username=:username";
        $query = $pdo->prepare($sql);
        $query->execute(array(':username'=>$username));

        if(!$query)
        {
            die("Execute query error, because: ". $pdo->errorInfo());
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);



       if(!password_verify($password, $result[0]['password']))
        {
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
} 