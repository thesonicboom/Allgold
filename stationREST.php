<?php
 
// include necessary classes 
include('station.php');


$station = new station();
$data = array_merge($_GET, $_POST);
$method = $data['action'];
$retlnk = '<br> <a href="index.html"> zur&uuml;ck zur Homeseite </a>';


 // create SQL based on HTTP method
switch ($method) 
{
  case 'GET':

    if(!empty($data['stationID']))
    {
    	$sql = $station->getCoordinates($data['stationID']);
        header('Content-type: application/json; charset=utf-8'); 
        echo json_encode($sql); 
        break;
    }

    if(!empty($data['location']))
    {
        $sql = $station->findByLocation($data['location']);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($sql);
        break;
    }

    else
    {
    	$sql = $station->getAllStations();
        header('Content-type: application/json; charset=utf-8'); 
        echo json_encode($sql);
        break;
    }

    break;

  case 'POST':
    $sql = $station->addStation($data); 
    echo "Antwort: ".$sql.$retlnk;
    break;

  case 'PUT':
    $sql = $station->updateStation($data);
    if($sql == "OK")
    {
    	$send = $station->getAllStations();
        header('Content-type: application/json; charset=utf-8'); 
        echo json_encode($send);    	
    } 
    else
    {
    	echo $sql;
    }
    break;

  case 'DELETE':
    $sql = $station->removeStation($data['stationID']); 
    echo $sql.$retlnk;
    break;
}



?>

