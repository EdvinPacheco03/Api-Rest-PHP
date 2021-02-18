<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/pacientes.class.php';
require_once 'clases/sesion.class.php';

$_respuestas = new respuestas;
$_pacientes = new pacientes;
$_sesion = new Session;  
    if($_SERVER['REQUEST_METHOD'] == "GET"){

        if(isset($_GET["iduser"]) && isset($_GET["token"])){//Obtener todos los pacientes por usuarios
            $id = $_GET["iduser"];
            $token = $_GET["token"];
            if($token){
                $listaPacientes = $_pacientes->listaPacientes($id);
                $resp = $_respuestas->response;
                header("Content-Type: application/json");
                echo json_encode($listaPacientes);
            }else{
                return $_respuestas->error_401();
            }
        }else if(isset($_GET['id'])){//Obtener un paciente por Id
            $pacienteid = $_GET['id'];
            $datosPaciente = $_pacientes->obtenerPaciente($pacienteid);
            header("Content-Type: application/json");
            echo json_encode($datosPaciente);
            http_response_code(200);
        }else if(isset($_GET['dpi'])){//Filtrar Paciente por DPI
            $dpi = $_GET['dpi'];
            $datosPaciente = $_pacientes->obtenerPacienteName($dpi);
            header("Content-Type: application/json");
            echo json_encode($datosPaciente);
            http_response_code(200);
        }else if(isset($_GET['idusuario'])){//Obtener el total de pacientes
            $idusuario = $_GET['idusuario'];
            $datosPaciente = $_pacientes->obtenerPacientetotal($idusuario);
            header("Content-Type: application/json");
            echo json_encode($datosPaciente);
            http_response_code(200);
        }else{
            return $_respuestas->error_401();
        }
        
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){
        //recibimos los datos enviados
        $postBody = file_get_contents("php://input");
        //enviamos los datos al manejador
        $datosArray = $_pacientes->post($postBody);
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
        $datosArray = $_pacientes->put($postBody);
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
            if(isset($headers["token"]) && isset($headers["pacienteId"])){
                //recibimos los datos enviados por el header
                $send = [
                    "token" => $headers["token"],
                    "pacienteId" =>$headers["pacienteId"]
                ];
                $postBody = json_encode($send);
            }else{
                //recibimos los datos enviados
                $postBody = file_get_contents("php://input");
            }
            
            //enviamos datos al manejador
            $datosArray = $_pacientes->delete($postBody);
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