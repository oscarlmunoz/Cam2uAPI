<?php
// required headers to avoid Cross Origin Resource Sharing
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// get database connection
include_once '../config/database.php';

// include customer object
include_once '../objects/order.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();

// initialize object
$order = new Order($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

$order->dni = $data->dni;


// query customer
$stmt = $order->searchAllOf($data->dni);
$num = $stmt->rowCount();


if($num){

    // products array
    $orders_arr=array();
    $orders_arr["records"]=array();
    
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $order_item=array(
            "id_pedido" => $id_pedido,
            "estado" => $estado,
        );

        array_push($orders_arr["records"], $order_item);
    }

    echo json_encode($orders_arr);

} else {
    echo json_encode(
        array("message" => "No se encontraron pedidos".$order->dni)
    );
}