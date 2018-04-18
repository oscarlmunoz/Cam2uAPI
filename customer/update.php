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
include_once '../objects/customer.php'; 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare customer object
$customer = new Customer($db);
 
// get id of customer to be edited
$data = json_decode(file_get_contents("php://input"));

// set DNI property of Customer to be edited
$customer->dni = $data->dni;
 
// set other customer property values
$customer->nombre = $data->nombre;
$customer->telefono = $data->telefono;
$customer->direccion = $data->direccion;
$customer->pass = $data->pass;
$customer->activo = $data->activo;

// query customer
$stmt = $customer->search($data->dni);
$num = $stmt->rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
extract($row);

// if pass changed, let hash it again
if (strcmp ( $pass , $customer->pass ) != 0){
    $customer->pass = password_hash($customer->pass, PASSWORD_BCRYPT);
}

// update the customer
if($customer->update()){
    echo json_encode($customer); 
}
 
// if unable to update the customer, tell the user
else{
    echo '{';
        echo '"message": "Unable to update customer."'; 
    echo '}';
}

?>