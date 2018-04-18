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
include_once '../objects/content.php';
 
$database = new Database();
$db = $database->getConnection();
 
$content = new Content($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$content->id_pedido = $data->id_pedido;
$content->id_articulo = $data->id_articulo;
$content->cantidad = $data->cantidad;
// create the product
if($content->create()){
    echo json_encode($data);
}
 
// if unable to create the product, tell the user
else{
    echo json_encode("");
}
?>