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
            $sql = "SELECT id, Client_Name, ProNumber, Service, Equipment, Status, Pickup_Location, Delivery_Location, CurrentLocationCity, CurrentLocationState FROM Shipment_Info WHERE ProNumber = '$input'";
        }
        elseif($inputtype == 1)
        {
            $sql = "SELECT id, Client_Name, ProNumber, Service, Equipment, Status, Pickup_Location, Delivery_Location, CurrentLocationCity, CurrentLocationState FROM Shipment_Info WHERE Client_Name = '$input'";
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

    function addShipmentInfo($pronumber, $status, $pickuplocation, $deliverylocation, $service, $equipment,
                             $clientname, $currentLocationCity, $currentLocationState)
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway;charset=utf8', 'root', 'Antimatter1024');
        } catch(PDOException $pdoE){
            die('Could not connect to Database: ' . $pdoE->getMessage());
        }
        $sql = "INSERT INTO shipment_info (Client_Name, ProNumber, Service, Equipment, Status, Pickup_Location,
                Delivery_Location, CurrentLocationCity, CurrentLocationState) VALUES ('$clientname', '$pronumber',
                '$service', '$equipment', '$status', '$pickuplocation', '$deliverylocation', '$currentLocationCity',
                '$currentLocationState'
                )";

        $query = $pdo->prepare($sql);
        $query->execute();

        //$pdo = NULL;
    }

    function updateShipmentInfo($recordNumber, $pronumber, $status, $pickuplocation, $deliverylocation, $service,
                                $equipment, $clientname, $currentLocationCity, $currentLocationState)
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway;charset=utf8', 'root', 'Antimatter1024');
        } catch(PDOException $pdoE){
            die('Could not connect to Database: ' . $pdoE->getMessage());
        }

        $sql = "UPDATE shipment_info SET Client_Name='$clientname', ProNumber='$pronumber', Service='$service',
                        Equipment='$equipment', Status='$status', currentLocationCity='$currentLocationCity',
                        CurrentLocationState='$currentLocationState', Pickup_Location='$pickuplocation',
                        Delivery_Location='$deliverylocation' WHERE id='$recordNumber'";

        $query = $pdo->prepare($sql);
        $query->execute();

        $pdo = NULL;

        $_SESSION['ProNumber'] = $_POST['pronumber'];
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
            ':location'=>$location
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

            if($record != 0)
            {
                $sql = "SELECT ProNumber, Document_Type, Location FROM uploads WHERE ProNumber ='$record'";
            }
            else{
                $sql = "SELECT ProNumber, Document_Type, Location FROM uploads";
            }
        $query = $pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $pdo = NULL;

        return $result;
    }
} 