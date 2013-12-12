<?php
/**
 * Created by PhpStorm.
 * User: micheal
 * Date: 11/28/13
 * Time: 5:52 PM
 */

namespace Backend;
use PDO;
use PDOException;
class TrackingSystem
{

    function getShipment($input)
    {
        //check input

        // 0 for pro number
        // 1 for company name
        if(is_numeric($input) == FALSE )
        {
            if(is_string($input) != FALSE)
            {
                $inputtype = 1;
            }
        }
        else{
            $inputtype = 0;
        }

        if($inputtype == 0)
        {
            $sql = "SELECT id, Company_Name, ProNumber, Service, Equipment, Status, Pickup_Location, Delivery_Location, CurrentLocationCity, CurrentLocationState FROM Shipment_Info WHERE ProNumber = '$input'";
        }
        elseif($inputtype == 1)
        {
            $sql = "SELECT id, Company_Name, ProNumber, Service, Equipment, Status, Pickup_Location, Delivery_Location, CurrentLocationCity, CurrentLocationState FROM Shipment_Info WHERE Company_Name = '$input'";
        }

        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway;charset=utf8', 'root', 'Antimatter1024');
        } catch(PDOException $pdoE){
            die('Could not connect to Database: ' . $pdoE->getMessage());
        }
        $query = $pdo->prepare($sql);
        $query->execute();

        $result = $query->fetchall(PDO::FETCH_ASSOC);
        if(empty($result))
        {
            exit('There Are no results for the information you have given, Please check your input.');
        }

        $pdo = NULL;

        return array('result'=>$result, 'inputtype'=>$inputtype);
    }

    function addShipmentInfo($pronumber, $status, $pickuplocation, $deliverylocation, $service, $equipment, $companyname, $currentLocationCity, $currentLocationState)
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway;charset=utf8', 'root', '');
        } catch(PDOException $pdoE){
            die('Could not connect to Database: ' . $pdoE->getMessage());
        }

        $query = $pdo->prepare('INSERT INTO Shipment_Info (Company_Name, ProNumber, Service, Equipment, Status, Pickup_Location, Delivery_Location, CurrentLocationCity, CurrentLocationState, entryDate) VALUES (:companyname, :pronumber, :service, :equipment, :status, :pickuplocation, :deliverylocation, :CurrentLocation-City, :CurrentLocation-State, :time)');
        $query->execute(array(':companyname'=>$companyname,
        ':pronumber'=>$pronumber,
            ':service'=>$service,
            ':equipment'=>$equipment,
            ':status'=>$status,
            ':pickuplocation'=>$pickuplocation,
            ':deliverylocation'=>$deliverylocation,
            ':CurrentLocation-City'=>$currentLocationCity,
            ':CurrentLocation-State'=>$currentLocationState,
            ':time'=>time()
            ));
        $pdo = NULL;
    }

    function updateShipmentInfo()
    {
        //todo::use SQL UPDATE to update shipment status!!!!!!!!!!!!!!!!!
    }

    function UploadtoDB($ProNumber, $doctype, $location)
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway;charset=utf8', 'root', 'Antimatter1024');
        } catch(PDOException $pdoE){
            die('Could not connect to Database: ' . $pdoE->getMessage());
        }

        $query = $pdo->prepare('INSERT INTO uploads (ProNumber, Document_Type, Location) VALUES (:ProNumber, :documenttype, :location)');
        $query->execute(array(':ProNumber'=>$ProNumber,
            ':documenttype'=>$doctype,
            ':location'=>'upload/'.$location
        ));
        $pdo = NULL;
    }

    function getUploads($record=0)
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway;charset=utf8', 'root', 'Antimatter1024');
        } catch(PDOException $pdoE){
            die('Could not connect to Database: ' . $pdoE->getMessage());
        }

        $username = $_SESSION['username'];

        if($_SESSION['loginType'] == 'employee')
        {
            if($record != 0)
            {
                $sql = "SELECT ProNumber, Document_Type, Location FROM uploads WHERE ProNumber ='$record'";
            }
            else{
                $sql = "SELECT ProNumber, Document_Type, Location FROM uploads";
            }
        }
        else{
            $sql = "SELECT ProNumber, Document_Type, Location FROM uploads WHERE Company_Name = '$username'";
        }
        $query = $pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $pdo = NULL;

        return $result;
    }
} 