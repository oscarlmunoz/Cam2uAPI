<?php
// required headers to avois Cross Origin Resource Sharing
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/order.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$order = new Order($db);

// query products
$statement = $order->readOrdersForPrinter();
$num = $statement->rowCount();

// check if more than 0 record found
if($num>0){
 
    // products array
    $order_arr=array();

    // retrieve our table contents
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);

        $order_item=array(
            "id_pedido" => $id_pedido,
            "estado" => $estado,
            "nifCliente" => $nifCliente
        );

        array_push($order_arr, $order_item);
    }

    echo json_encode($order_arr);
} else {
    echo json_encode(
        array("message" => "No se encontraron pedidos")
    );
}