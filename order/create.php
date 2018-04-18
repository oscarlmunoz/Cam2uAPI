<?php
// required headers to avoid Cross Origin Resource Sharing
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate article object
include_once '../objects/order.php';
 
$database = new Database();
$db = $database->getConnection();
 
$order = new Order($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$order->estado = $data->estado;
$order->nifCliente = $data->nifCliente;

$stmt = $order->create();

// check control
if($order->nifCliente && $stmt){
    // If the order is created we get the id
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);

    $id2return = array(
        "id_pedido" => $id_pedido
    );

    // Return the id_pedido
    echo json_encode($id2return);
}
 
// if unable to create the product, tell the user
else{
    echo json_encode("");
}
?>