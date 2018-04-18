<?php
// required headers to avois Cross Origin Resource Sharing
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/article.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$article = new Article($db);
 
// query products
$statement = $article->read();
$num = $statement->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $articles_arr=array();
    $articles_arr["records"]=array();
 
    // retrieve our table contents
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
 
        $article_item=array(
            "id_articulo" => $id_articulo,
            "id_prenda" => $id_prenda,
            "tamano" => $tamano,
            "color" => $color,
            "precio" => $precio,
            "publicado" => $publicado,
            "imagen" => $imagen,
            "nombre" => $nombre
        );
 
        array_push($articles_arr["records"], $article_item);
    }
 
    echo json_encode($articles_arr);
}
 
else{
    echo json_encode(
        array("message" => "No se encontraron artículos.")
    );
}
?>