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

$article->id_articulo = $data->id_articulo ;

$stmt = $article->search($data->id_articulo); // For security reasons (not abe to delete non-existent article)
$num = $stmt->rowCount();

if($num){
    if($article->delete()){
        echo json_encode($data);
    }
} 
// if unable to delete the product, let us know  ;)
else {
    echo json_encode("");
}

 


