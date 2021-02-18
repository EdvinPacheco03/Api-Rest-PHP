<?php 
require_once 'clases/respuestas.class.php';
require_once 'clases/token.class.php';

$_respuestas = new respuestas;
$_token = new token;

if($_SERVER['REQUEST_METHOD'] == "DELETE"){

    $headers = getallheaders();
    if(isset($headers["token"])){
        //recibimos los datos enviados por el header
        $send = [
            "token" => $headers["token"]
        ];
        $postBody = json_encode($send);
    }else{
        //recibimos los datos enviados por el body
        $postBody = file_get_contents("php://input");
    }
    
    //enviamos datos al manejador
    $datosArray = $_token->eliminarToken($postBody);
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
