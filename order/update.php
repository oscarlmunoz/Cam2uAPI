<?php
// required headers to avoid Cross Origin Resource Sharing
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
// include customer object
include_once '../objects/order.php'; 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare customer object
$order = new Order($db);
 
// get id of customer to be edited
$data = json_decode(file_get_contents("php://input"));

// set other order property values
$order->id_pedido = $data->id_pedido;
$order->estado = $data->estado;
$order->nifCliente = $data->nifCliente;

// update the customer
if($order->update()){
    echo json_encode($order);
}
 
// if unable to update the customer, tell the user
else{
    echo '{';
        echo '"message": "Unable to update order."';
    echo '}';
}