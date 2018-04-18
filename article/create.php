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
include_once '../objects/article.php';
 
$database = new Database();
$db = $database->getConnection();
 
$article = new Article($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$article->id_prenda = $data->id_prenda;
$article->tamano = $data->tamano;
$article->color = $data->color;
$article->precio = $data->precio;
$article->publicado = $data->publicado;
$article->imagen = $data->imagen;
$article->nombre = $data->nombre;

 
// create the product
if($article->nombre && $article->create()){
    echo json_encode($data);
}
 
// if unable to create the product, tell the user
else{
    echo json_encode("");
}
?>