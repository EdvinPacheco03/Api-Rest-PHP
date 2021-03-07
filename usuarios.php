<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/usuarios.class.php';
require_once 'clases/sesion.class.php';

$_respuestas = new respuestas;
$_usuarios = new usuarios;
$_sesion = new Session;  

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET["idrol"]) && isset($_GET["token"])){//Obtener todos los Usuarios
            $idrol = $_GET["idrol"];
            $token = $_GET["token"];
            if($token){
                if($idrol == 1){
                    $listaUsuarios = $_usuarios->listaUsuarios();
                    $resp = $_respuestas->response;
                    header("Content-Type: application/json");
                    echo json_encode($listaUsuarios);
                }else{
                    return $_respuestas->error_401();
                }
            }else{
                return $_respuestas->error_401();
            }
        }else if(isset($_GET['iduser'])){//Obtener un usuario por ID
            $idusuario = $_GET['iduser'];
            $datosUsuario = $_usuarios->obtenerUsuario($idusuario);
            header("Content-Type: application/json");
            echo json_encode($datosUsuario);
            http_response_code(200);
        }else if(isset($_GET['idrol'])){//Obtener el total de usuarios 
            $idrol = $_GET['idrol'];
            $datosUsuario = $_usuarios->obtenerTotalusuario($idrol);
            header("Content-Type: application/json");
            echo json_encode($datosUsuario);
            http_response_code(200);
        }else{
            return $_respuestas->error_401();
        }
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){
        //recibimos los datos enviados
        $postBody = file_get_contents("php://input");
        //enviamos los datos al manejador
        $datosArray = $_usuarios->post($postBody);
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
        $datosArray = $_usuarios->put($postBody);
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
            if(isset($headers["token"]) && isset($headers["idusuario"])){
                //recibimos los datos enviados por el header
                $send = [
                    "token" => $headers["token"],
                    "idusuario" =>$headers["idusuario"]
                ];
                $postBody = json_encode($send);
            }else{
                //recibimos los datos enviados
                $postBody = file_get_contents("php://input");
            }
            
            //enviamos datos al manejador
            $datosArray = $_usuarios->delete($postBody);
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