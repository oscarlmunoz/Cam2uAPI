<?php

    // required headers to avoid Cross Origin Resource Sharing
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
    // Get the files route
    $data = json_decode(file_get_contents("php://input"));
    $directorio = $data->url;

    $ficheros = array();

    // We just look for .png files
    foreach (glob("./".$directorio."/*.png") as $fichero) {
        // Remove End of line from string (just in case)
        $fichero  = preg_replace('~[\r\n]+~', '', $fichero);
        // We add just the basename (not dir) without the extension.
        array_push($ficheros, basename($fichero , ".png"));
    }
    // File name
    echo json_encode($ficheros);
?>