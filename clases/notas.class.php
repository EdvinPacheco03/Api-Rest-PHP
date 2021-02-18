<?php
require_once "conexion/conexion.php";
require_once "respuestas.class.php";

class notas extends conexion {

    private $table = "notas";
    private $idnotas = "";
    private $titulo = "";
    private $descripcion = "";
    private $idusuario = "";
    private $token = "";
    
//912bc00f049ac8464472020c5cd06759

    public function listaNotas($idusuario){
        $_respuestas = new respuestas;
        // $inicio  = 0;
        // $cantidad = 100;
        // if($pagina > 1){
        //     $inicio = ($cantidad * ($pagina - 1)) +1 ;
        //     $cantidad = $cantidad * $pagina;
        // }
        $query = "SELECT idnotas,titulo,descripcion FROM " . $this->table . " where idusuario = $idusuario";
        $datos = parent::obtenerDatos($query);
        $result = $_respuestas->response;
        $result["result"] = array(
            "notas" => $datos
        );
        return ($result);
    }

    public function obtenerNota($id){
        $query = "SELECT * FROM " . $this->table . " WHERE idnotas = '$id'";
        return parent::obtenerDatos($query);

    }

    public function obtenerTotalnotas($idusuario){
        $query = "SELECT COUNT(*) AS total FROM " . $this->table . " WHERE idusuario = '$idusuario'";
        return parent::obtenerDatos($query);

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

                if(!isset($datos['titulo']) || !isset($datos['descripcion']) || !isset($datos['idusuario'])){
                    return $_respuestas->error_400();
                }else{
                    $this->titulo = $datos['titulo'];
                    $this->descripcion = $datos['descripcion'];
                    $this->idusuario = $datos['idusuario'];
                    $resp = $this->insertarNota();
                    print_r($resp);
                    if($resp){
                        
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "idnotas" => $resp
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


    private function insertarNota(){
        $query = "INSERT INTO " . $this->table . " (titulo,descripcion,idusuario)
        values
        ('" . $this->titulo . "','" . $this->descripcion ."','" . $this->idusuario . "')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }
    
    public function put($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['token'])){
            return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $arrayToken =   $this->buscarToken();
            if($arrayToken){
                if(!isset($datos['idnotas'])){
                    return $_respuestas->error_400();
                }else{
                    print_r($datos);
                    $this->idnotas = $datos['idnotas'];
                    if(isset($datos['titulo'])) { $this->titulo = $datos['titulo']; }
                    if(isset($datos['descripcion'])) { $this->descripcion = $datos['descripcion']; }
        
                    $resp = $this->modificarNota();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "idnotas" => $this->idnotas
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


    private function modificarNota(){
        $query = "UPDATE " . $this->table . " SET titulo ='" . $this->titulo . "',descripcion = '" . $this->descripcion . "' WHERE idnotas = '" . $this->idnotas . "'"; 
        $resp = parent::nonQuery($query);
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }


    public function delete($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['token'])){
            return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $arrayToken =   $this->buscarToken();
            if($arrayToken){

                if(!isset($datos['idnotas'])){
                    return $_respuestas->error_400();
                }else{
                    $this->idnotas = $datos['idnotas'];
                    $resp = $this->eliminarNota();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "idnotas" => $this->idnotas
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


    private function eliminarNota(){
        $query = "DELETE FROM " . $this->table . " WHERE idnotas = '" . $this->idnotas . "'";
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


    private function actualizarToken($tokenid){
        $date = date("Y-m-d H:i");
        $query = "UPDATE usuarios_token SET Fecha = '$date' WHERE TokenId = '$tokenid' ";
        $resp = parent::nonQuery($query);
        if($resp >= 1){
            return $resp;
        }else{
            return 0;
        }
    }



}





?>