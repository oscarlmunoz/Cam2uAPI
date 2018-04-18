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
include_once '../objects/customer.php';
 
// instantiate database
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$customer = new Customer($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

$customer->dni = $data->dni;

// query customer
$stmt = $customer->search($data->dni);
$num = $stmt->rowCount();

if($num){

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $customer_item=array(
        "dni" => $dni,
        "nombre" => $nombre,
        "telefono" => $telefono,
        "direccion" => $direccion,
        "pass" => $pass,
        "activo" => $activo
    );
    $auth = password_verify($data->pass, $customer_item['pass']);
    if($auth){
        echo json_encode($customer_item);
    } else {
        echo json_encode("");
    }
} else {
    echo json_encode("");
}