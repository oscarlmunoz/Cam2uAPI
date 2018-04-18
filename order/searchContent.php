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
    include_once '../objects/content.php';

    // instantiate database
    $database = new Database();
    $db = $database->getConnection();
    
    // initialize object
    $content = new Content($db);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));

    $content->id_pedido = $data->id_pedido;

    $stmt = $content->search($data->id_pedido);
    $num = $stmt->rowCount();

    if($num){
        
        $content_arr=array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);

            $content_item=array(
                "id_pedido" => $id_pedido,
                "id_articulo" => $id_articulo,
                "cantidad" => $cantidad
            );

            array_push($content_arr, $content_item);
        }

        echo json_encode($content_arr);

    } else {
        echo json_encode("");
    }

