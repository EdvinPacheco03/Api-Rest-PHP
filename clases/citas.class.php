<?php
require_once "conexion/conexion.php";
require_once "respuestas.class.php";

class citas extends conexion {

    private $table = "citas";
    private $idcita = "";
    private $idpaciente = "";
    private $fecha = ""; 
    private $horarioIn = "";
    private $horarioFn = "";
    private $motivo = "";
    private $idusuario = "";
    private $token = "";


    public function listaCitas($idusuario){
        $_respuestas = new respuestas;
        // $inicio  = 0;
        // $cantidad = 100;
        // if($pagina > 1){
        //     $inicio = ($cantidad * ($pagina - 1)) +1 ;
        //     $cantidad = $cantidad * $pagina;
        // }
        $query = "SELECT c.CitaId, p.PacienteId, p.Nombre, c.Fecha, c.Estado, c.Motivo FROM " . $this->table . " AS c INNER JOIN pacientes AS p ON c.PacienteId = p.PacienteId where c.id_usuario = $idusuario AND c.Estado = 'Activo'";
        $datos = parent::obtenerDatos($query);
        $result = $_respuestas->response;
        $result["result"] = array(
            "citas" => $datos
        );
        return ($result);
    }

    public function obtenerCita($id){
        $query = "SELECT c.CitaId,c.Estado,c.Fecha,c.HoraFin,c.HoraInicio,c.Motivo,c.id_usuario, p.DNI FROM " . $this->table . " AS c INNER JOIN pacientes AS p ON c.PacienteId = p.PacienteId where c.CitaId = $id AND c.Estado = 'Activo'";
        return parent::obtenerDatos($query);

    }

    public function citasToday($idusuario){
        $_respuestas = new respuestas;
        $today = date("Y-m-d");
        $query = "SELECT c.CitaId, p.PacienteId, p.Nombre, c.Fecha, c.Estado, c.Motivo FROM " . $this->table . " AS c INNER JOIN pacientes AS p ON c.PacienteId = p.PacienteId where c.id_usuario = $idusuario AND c.Estado = 'Activo' AND c.Fecha = '$today'";
        $datos = parent::obtenerDatos($query);
        $result = $_respuestas->response;
        $result["result"] = array(
            "citas" => $datos
        );
        return ($result);
    }



    public function post($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);
        print_r($datos);

        if(!isset($datos['token'])){
                return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $arrayToken =   $this->buscarToken();
            if($arrayToken){

                if(!isset($datos['idpaciente']) || !isset($datos['fecha']) || !isset($datos['idusuario'])){
                    return $_respuestas->error_400();
                }else{
                    $this->idpaciente = $datos['idpaciente'];
                    $this->fecha = $datos['fecha'];
                    $this->idusuario = $datos['idusuario'];
                    if(isset($datos['horarioIn'])) { $this->horarioIn = $datos['horarioIn']; }
                    if(isset($datos['horarioFn'])) { $this->horarioFn = $datos['horarioFn']; }
                    if(isset($datos['motivo'])) { $this->motivo = $datos['motivo']; }
                    $resp = $this->insertarCita();
                    print_r($resp);
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "citaId" => $resp
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }

            }else{
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            }
        }


       

    }

    private function insertarCita(){
        $query = "INSERT INTO " . $this->table . " (PacienteId,Fecha,HoraInicio,HoraFin,Motivo,id_usuario)
        values
        ('" . $this->idpaciente ."','" . $this->fecha . "','"  . $this->horarioIn . "','" . $this->horarioFn . "','" . $this->motivo . "','" . $this->idusuario . "')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }

    //Funcion para actualizar un Usuario
    public function put($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['token'])){
            return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $arrayToken =   $this->buscarToken();
            if($arrayToken){
                if(!isset($datos['idcita'])){
                    return $_respuestas->error_400();
                }else{
                    $this->idcita = $datos['idcita'];
                    if(isset($datos['idpaciente'])) { $this->idpaciente = $datos['idpaciente']; }
                    if(isset($datos['fecha'])) { $this->fecha = $datos['fecha']; }
                    if(isset($datos['horarioIn'])) { $this->horarioIn = $datos['horarioIn']; }
                    if(isset($datos['horarioFn'])) { $this->horarioFn = $datos['horarioFn']; }
                    if(isset($datos['motivo'])) { $this->motivo = $datos['motivo']; }
                    
                    $resp = $this->modificarCita();

                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "idcita" => $this->idcita
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }

            }else{
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            }
        }


    }

    //Funcion en la que se crea el query para actualizar la cita
    private function modificarCita(){
        $query = "UPDATE " . $this->table . " SET PacienteId ='" . $this->idpaciente . "',Fecha = '" . $this->fecha . "', HoraInicio = '" . $this->horarioIn . "', HoraFin = '" .
        $this->horarioFn . "', Motivo = '" . $this->motivo . "' WHERE CitaId = '" . $this->idcita . "'"; 
        $resp = parent::nonQuery($query);
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }

    //Funcion para eliminar(Actualizar a inactivo) un Usuario
    public function delete($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['token'])){
            return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $arrayToken =   $this->buscarToken();
            if($arrayToken){

                if(!isset($datos['idcita'])){
                    return $_respuestas->error_400();
                }else{
                    $this->idcita = $datos['idcita'];
                    $resp = $this->eliminarCita();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "idcita" => $this->idcita
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }

            }else{
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            }
        }



     
    }

    //Funcion con el query para eliminar un Usuario
    private function eliminarCita(){
        $query = "UPDATE " . $this->table . " SET estado = 'Inactivo' WHERE CitaId = '" . $this->idcita . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }


    private function buscarToken(){
        $query = "SELECT  TokenId,UsuarioId,Estado from usuarios_token WHERE Token = '" . $this->token . "' AND Estado = 'Activo'";
        $resp = parent::obtenerDatos($query);
        if($resp){
            return $resp;
        }else{
            return 0;
        }
    }


}

?>
