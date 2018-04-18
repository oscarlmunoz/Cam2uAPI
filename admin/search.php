<?php
// required headers to avoid Cross Origin Resource Sharing
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// get database connection
include_once '../config/database.php';
 
// include admin object
include_once '../objects/admin.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();

// initialize object
$admin = new Admin($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

$admin->nombre = $data->nombre;
$admin->pass = $data->pass;

// echo json_encode($data->nombre);

// Query
$stmt = $admin->search($data->nombre);
$num = $stmt->rowCount();

if($num){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $admin_item=array(
        "nombre" => $nombre,
        "pass" => $pass
    );
    $auth = password_verify($data->pass, $admin_item['pass']);
    if($auth){
        echo json_encode($admin_item);
    } else {
        echo json_encode("");
    }
}else{
    echo json_encode("");
}