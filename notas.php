<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/notas.class.php';
require_once 'clases/sesion.class.php';

$_respuestas = new respuestas;
$_notas = new notas;
$_sesion = new Session;  
    if($_SERVER['REQUEST_METHOD'] == "GET"){

        if(isset($_GET["iduser"]) && isset($_GET["token"])){//Obtener la lista completa de notas por usuarios logueado
            $id = $_GET["iduser"];
            $token = $_GET["token"];
            if($token){
                $listaNotas = $_notas->listaNotas($id);
                header("Content-Type: application/json");
                echo json_encode($listaNotas);
                http_response_code(200);
            }else{
                return $_respuestas->error_401();
            }
        }else if(isset($_GET['id'])){//Obtener una nota al obtener un parametro id
            $idnotas = $_GET['id'];
            $datosNota = $_notas->obtenerNota($idnotas);
            header("Content-Type: application/json");
            echo json_encode($datosNota);
            http_response_code(200);
        }else if(isset($_GET['idusuario'])){//Obtener el total de notas por usuario
            $idusuario = $_GET['idusuario'];
            $obtenerTotalnotas = $_notas->obtenerTotalnotas($idusuario);
            header("Content-Type: application/json");
            echo json_encode($obtenerTotalnotas);
            http_response_code(200);
        }
        
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){
        //recibimos los datos enviados
        $postBody = file_get_contents("php://input");
        //enviamos los datos al manejador
        $datosArray = $_notas->post($postBody);
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
        $datosArray = $_notas->put($postBody);
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
            if(isset($headers["token"]) && isset($headers["idnotas"])){
                //recibimos los datos enviados por el header
                $send = [
                    "token" => $headers["token"],
                    "idnotas" =>$headers["idnotas"]
                ];
                $postBody = json_encode($send);
            }else{
                //recibimos los datos enviados
                $postBody = file_get_contents("php://input");
            }
            
            //enviamos datos al manejador
            $datosArray = $_notas->delete($postBody);
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