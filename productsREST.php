<?php
 
// include necessary classes 
include('products.php');


$products = new products();
$data = array_merge($_GET, $_POST);
$method = $data['action'];
$retlnk = '<br> <a href="index.html"> zur&uuml;ck zur Homeseite </a>';


 // create SQL based on HTTP method
switch ($method) 
{
  case 'GET':

    
    if(!empty($data['productID']))
    {
    	$sql = $products->getName($data['productID']);
        header('Content-type: application/json; charset=utf-8'); 
        echo json_encode($sql); 
        break;
    }
    

    else
    {
    	$sql = $products->getAllProducts();
        header('Content-type: application/json; charset=utf-8'); 
        echo json_encode($sql);
        break;
    }

    break;
}



?>

