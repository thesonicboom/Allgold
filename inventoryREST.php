<?php
 
// include necessary classes 

include('inventory.php');


$inventory = new inventory();
$data = array_merge($_GET, $_POST);
$method = $data['action'];
/*var_dump($_GET);*/

 // create SQL based on HTTP method
switch ($method) 
{
  case 'GET':

    if(!empty($data['stationID']))
    {
        error_log(print_r($data,true));
        $sql = $inventory->findByStationID($data['stationID']);
        header('Content-type: application/json; charset=utf-8'); /*header nachlesen*/
        echo json_encode($sql);
        break;
    }

    else
    {
        $sql = $inventory->getInventory(); 
        header('Content-type: application/json; charset=utf-8'); 
        echo json_encode($sql);
        break;
    }

    break;

}

?>