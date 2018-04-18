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
include_once '../objects/article.php'; 
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare article object
$article = new Article($db);

// get id of article to be edited
$data = json_decode(file_get_contents("php://input"));

$article->id_articulo = $data->id_articulo ;
// $article->id_prenda = $data->id_prenda ;
// $article->tamano = $data->tamano;
// $article->color = $data->color;
$article->precio = $data->precio;
$article->publicado = $data->publicado;
// $article->imagen = $data->imagen;
$article->nombre = $data->nombre;

// update the article
if($article->update()){
    echo json_encode($article); 
}
 
// if unable to update the customer, tell the user
else{
    echo '{';
        echo '"message": "Unable to update customer."';
    echo '}';
}