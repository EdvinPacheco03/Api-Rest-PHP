<?php

use function PHPSTORM_META\elementType;

require_once 'clases/respuestas.class.php';
require_once 'clases/citas.class.php';

$_respuestas = new respuestas;
$_citas = new citas;

if($_SERVER['REQUEST_METHOD'] == "GET"){

    if(isset($_GET["iduser"]) && isset($_GET["token"])){
        $id = $_GET["iduser"];
        $token = $_GET["token"];
        if($token){
            $listaCitas = $_citas->listaCitas($id);
            header("Content-Type: application/json");
            echo json_encode($listaCitas);
            http_response_code(200);
        }else{
            return $_respuestas->error_401();
        }
    }else if(isset($_GET['id'])){
        $citaId = $_GET['id'];
        $datosCita = $_citas->obtenerCita($citaId);
        header("Content-Type: application/json");
        echo json_encode($datosCita);
        http_response_code(200);
    }else if(isset($_GET['idusuario']) && isset($_GET["token"])){
        $id = $_GET["idusuario"];
        $token = $_GET["token"];
        if($token){
            $citasToday = $_citas->citasToday($id);
            header("Content-Type: application/json");
            echo json_encode($citasToday);
            http_response_code(200);
        }else{
            return $_respuestas->error_401();
        }
    }

}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
    //enviamos los datos al manejador
    $datosArray = $_citas->post($postBody);
    //delvovemos una respuesta 
    header('Content-Type: application/json');
    if(isset($datosArray["result"]["error_id"])){
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    }else{
        http_response_code(200);
    }
    echo json_encode($datosArray);

}else if($_SERVER['REQUEST_METHOD'] == "PUT"){
    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
    //enviamos datos al manejador
    $datosArray = $_citas->put($postBody);
        //delvovemos una respuesta 
    header('Content-Type: application/json');
    if(isset($datosArray["result"]["error_id"])){
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    }else{
        http_response_code(200);
    }
    echo json_encode($datosArray);
}else if($_SERVER['REQUEST_METHOD'] == "DELETE"){
    $headers = getallheaders();
        if(isset($headers["token"]) && isset($headers["idcita"])){
            //recibimos los datos enviados por el header
            $send = [
                "token" => $headers["token"],
                "idcita" =>$headers["idcita"]
            ];
            $postBody = json_encode($send);
        }else{
            //recibimos los datos enviados
            $postBody = file_get_contents("php://input");
        }
        
        //enviamos datos al manejador
        $datosArray = $_citas->delete($postBody);
        //delvovemos una respuesta 
        header('Content-Type: application/json');
        if(isset($datosArray["result"]["error_id"])){
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        }else{
            http_response_code(200);
        }
        echo json_encode($datosArray);
}else{
    header('Content-Type: application/json');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
}



?>