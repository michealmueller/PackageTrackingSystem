<?php
/**
 * Created by PhpStorm.
 * User: micheal
 * Date: 12/11/13
 * Time: 12:51 PM
 */

namespace Backend;
use PDO;
use PDOException;


class Edit {
    public $recordNum;

    function getRecord($record)
    {
        if (self::checkLogin() == False)
        {
            //redirect
        }
        else{
            $this->recordNum = $record;

            try{
                $pdo = new PDO('mysql:host=localhost;dbname=bestway_trackingSystem;charset=utf8', 'bestway_tracker', 'B3stTransfer1');
            } catch(PDOException $pdoE){
                die('Could not connect to Database: ' . $pdoE->getMessage());
            }
            $sql = "SELECT * FROM shipment_info WHERE id='$this->recordNum'";

            $query = $pdo->prepare($sql);
            $query->execute();

            $result = $query->fetchall(PDO::FETCH_ASSOC);

            return $result;
        }
    }

    function updateRecord()
    {

    }

    function checkLogin()
    {
        if($_SESSION['username'] != 'BWAdmin')
        {
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

} 