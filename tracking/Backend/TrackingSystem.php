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
            $sql = "SELECT id, Client_Name, ProNumber, Service, Equipment, Status, Pickup_Location, Pickup_Locationstate, Delivery_Location, Delivery_Locationstate,CurrentLocationCity, CurrentLocationState FROM shipment_info WHERE ProNumber = '$input'";
        }
        elseif($inputtype == 1)
        {
            $sql = "SELECT id, Client_Name, ProNumber, Status, Pickup_Location, Pickup_Locationstate, Delivery_Location, CurrentLocationCity, Delivery_Locationstate, CurrentLocationState FROM shipment_info WHERE Client_Name = '$input'";
        }

        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway_trackingSystem;charset=utf8', 'bestway_tracker', 'B3stTransfer1');
        } catch(PDOException $pdoE){
            die('Could not connect to Database: ' . $pdoE->getMessage());
        }
        $query = $pdo->prepare($sql);
        $query->execute();

        $result = $query->fetchall(PDO::FETCH_ASSOC);
        if(empty($result))
        {
            exit('There are no results for the information you have given, Please check your input.');
        }

        $pdo = NULL;

        return array('result'=>$result, 'inputtype'=>$inputtype);
    }

    function addShipmentInfo($pronumber, $status, $pickuplocation, $pickuplocationstate, $deliverylocation, $deliverylocationstate, $service, $equipment,
                             $clientname, $currentLocationCity, $currentLocationState)
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway_trackingSystem;charset=utf8', 'bestway_tracker', 'B3stTransfer1');
        } catch(PDOException $pdoE){
            die('Could not connect to Database: ' . $pdoE->getMessage());
        }
        $sql = "INSERT INTO shipment_info (Client_Name, ProNumber, Service, Equipment, Status, Pickup_Location,Pickup_Locationstate,
                Delivery_Location, Delivery_Locationstate, CurrentLocationCity, CurrentLocationState) VALUES ('$clientname', '$pronumber',
                '$service', '$equipment', '$status', '$pickuplocation', '$pickuplocationstate', '$deliverylocation', '$deliverylocationstate', '$currentLocationCity',
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
            $pdo = new PDO('mysql:host=localhost;dbname=bestway_trackingSystem;charset=utf8', 'bestway_tracker', 'B3stTransfer1');
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
            $pdo = new PDO('mysql:host=localhost;dbname=bestway_trackingSystem;charset=utf8', 'bestway_tracker', 'B3stTransfer1');
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
            $pdo = new PDO('mysql:host=localhost;dbname=bestway_trackingSystem;charset=utf8', 'bestway_tracker', 'B3stTransfer1');
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
    function getClients()
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway_trackingSystem;charset=utf8', 'bestway_tracker', 'B3stTransfer1');
        } catch(PDOException $pdoE){
            die('Could not connect to Database: ' . $pdoE->getMessage());
        }

        $sql = "SELECT CompanyName FROM cust_login";
        $query = $pdo->prepare($sql);
        $query->execute();

        $clients = $query->fetchAll(PDO::FETCH_COLUMN);

        return $clients;
    }

    function deleteRecord($recordNumber)
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=bestway_trackingSystem;charset=utf8', 'bestway_tracker', 'B3stTransfer1');
        } catch(PDOException $pdoE){
            die('Could not connect to Database: ' . $pdoE->getMessage());
        }

        $sql = "DELETE FROM shipment_info WHERE id='$recordNumber'";
        $query = $pdo->prepare($sql);
        $query->execute();
    }
} 