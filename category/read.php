<?php
// required headers to avois Cross Origin Resource Sharing
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/category.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$category = new Category($db);
 
// query products
$statement = $category->read();
$num = $statement->rowCount();

if($num>0){

    // category array
    $category_arr=array();
    // $category_arr["records"]=array();
 
    // retrieve our table contents
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);

        $category_item=array(
            "id_tipo" => $id_tipo,
            "tipo" => $tipo,
            "genero" => $genero,
            "precio" => $precio
        );
        array_push($category_arr, $category_item);
    }
    echo json_encode($category_arr);
}
 
else{
    echo json_encode(
        array("message" => "No se encontraron categorias.")
    );
}