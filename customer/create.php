<?php
// required headers to avoi Cross Origin Resource Sharing
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';

// instantiate customer object
include_once '../objects/validators.php';
 
// instantiate customer object
include_once '../objects/customer.php';

$validator = new validators();

$database = new Database();
$db = $database->getConnection();
 
$customer = new Customer($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set customer property values
$customer->dni = $data->dni;
$customer->nombre = $data->nombre;
$customer->telefono = $data->telefono;
$customer->direccion = $data->direccion;
$customer->pass = $data->pass;
$customer->activo = $data->activo;

    // create the product
    if($validator->dniValid($customer->dni) && $validator->strongPass($customer->pass)){
        if($customer->dni && $customer->create()){
            echo json_encode($customer);
        } else {
            echo json_encode("");
        }
    }
    
    // if unable to create the product, tell the user
    else{
        echo json_encode("");
    }
?>
