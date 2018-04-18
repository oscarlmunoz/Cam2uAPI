<?php

    // required headers to avoid Cross Origin Resource Sharing
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
    // instantiate article object
    include_once '../objects/category.php';

    
    $categoryArray = array ();

    $nombre_categoria = array();

    $directories = glob('garments/*' , GLOB_ONLYDIR);
    // We just look for .png files
    foreach ($directories as $dir) {
        // We add just the directories
        $category = new Category();
        $category->name = basename ($dir);
        array_push ( $categoryArray , $category );

    }
    
    // File name
    echo json_encode($categoryArray);

    ?>