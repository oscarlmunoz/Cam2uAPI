<?php
// required headers to avoid Cross Origin Resource Sharing
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
// include article object
include_once '../objects/admin.php';
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare customer object
$admin = new Admin($db);

// get id of customer to be edited
$data = json_decode(file_get_contents("php://input"));

// set admin property values
$admin->nombre = $data->nombre;
$admin->pass = $data->pass;

// query customer
$stmt = $admin->search($data->nombre);
$num = $stmt->rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
extract($row);

// if pass changed, let hash it again
if (strcmp($pass, $admin->pass) != 0) {
    $admin->pass = password_hash($admin->pass, PASSWORD_BCRYPT);
}

// update the customer
if ($admin->update()) {
    echo json_encode($admin); 
}

// if unable to update the customer, tell the user
else {
    echo '{';
    echo '"message": "Unable to update admin."'; 
    echo '}';
}
