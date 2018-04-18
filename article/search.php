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
    include_once '../objects/article.php';
    
    // instantiate database
    $database = new Database();
    $db = $database->getConnection();
    
    // initialize object
    $article = new Article($db);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));

    $article->id_articulo = $data->id_articulo;

    // query customer

    $stmt = $article->search($data->id_articulo);
    $num = $stmt->rowCount();

    if($num){

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
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

        echo json_encode($article_item);



        

    } else {
        echo json_encode("");
    }

