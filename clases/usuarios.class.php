<?php
require_once "conexion/conexion.php";
require_once "respuestas.class.php";

class usuarios extends conexion {

    private $table = "usuarios";
    private $idusuario = "";
    private $nombre = "";
    private $usuario = "";
    private $password = "";
    private $telefono = "";
    private $idrol = "";
    private $token = "";

    
    //912bc00f049ac8464472020c5cd06759
    //Funcion para obtener todos los usuarios
    public function listaUsuarios(){
        $_respuestas = new respuestas;
        // $inicio  = 0;
        // $cantidad = 100;
        // if($pagina > 1){
        //     $inicio = ($cantidad * ($pagina - 1)) +1 ;
        //     $cantidad = $cantidad * $pagina;
        // }
        $query = "SELECT id_usuario,nombre,usuario,telefono FROM " . $this->table . " where estado = 'Activo'";
        $datos = parent::obtenerDatos($query);
        $result = $_respuestas->response;
        $result["result"] = array(
            "usuarios" => $datos
        );
        return ($result);
    }

    //Funcion para obtener un usuario mediante un Id
    public function ObtenerUsuario($id){
        $query = "SELECT * FROM " . $this->table . " WHERE id_usuario = '$id'";
        return parent::obtenerDatos($query);

    }

    //Funcion para obtener el total de usuarios registrados
    public function obtenerTotalusuario($idrol){
        if($idrol == 1){
            $query = "SELECT COUNT(*) AS total FROM " . $this->table . " WHERE estado = 'Activo'";
            return parent::obtenerDatos($query);
        }

    }

    //Funcion para insertar un nuevo Usuario
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

                if(!isset($datos['nombre']) || !isset($datos['usuario']) || !isset($datos['password'])|| !isset($datos['telefono'])|| !isset($datos['idrol'])){
                    return $_respuestas->error_400();
                }else{
                    $this->nombre = $datos['nombre'];
                    $this->usuario = $datos['usuario'];
                    $this->password = parent::encriptar($datos['password']);
                    $this->telefono = $datos['telefono'];
                    $this->idrol = $datos['idrol'];
                    $resp = $this->insertarUsuario();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "idusuario" => $resp
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

    //Funcion en la que se crea el query y se insertan los datos
    private function insertarUsuario(){
        $query = "INSERT INTO " . $this->table . " (nombre,usuario,password,telefono,idrol)
        values
        ('" . $this->nombre . "','" . $this->usuario . "','" . $this->password ."','" . $this->telefono . "','"  . $this->idrol . "')"; 
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
                if(!isset($datos['idusuario'])){
                    return $_respuestas->error_400();
                }else{
                    $this->idusuario = $datos['idusuario'];
                    if(isset($datos['nombre'])) { $this->nombre = $datos['nombre']; }
                    if(isset($datos['usuario'])) { $this->usuario = $datos['usuario']; }
                    if(isset($datos['password'])) { $this->password = parent::encriptar($datos['password']); }
                    if(isset($datos['telefono'])) { $this->telefono = $datos['telefono']; }
                    if(isset($datos['idrol'])) { $this->idrol = $datos['idrol']; }
        
                    $resp = $this->modificarUsuario();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "idusuario" => $this->idusuario
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

    //Funcion en la que se crea el query para actualizar el usuario
    private function modificarUsuario(){
        $query = "UPDATE " . $this->table . " SET nombre ='" . $this->nombre . "',usuario = '" . $this->usuario . "', password = '" . $this->password . "', telefono = '" .
        $this->telefono . "', idrol = '" . $this->idrol . "' WHERE id_usuario = '" . $this->idusuario . "'"; 
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

                if(!isset($datos['idusuario'])){
                    return $_respuestas->error_400();
                }else{
                    $this->idusuario = $datos['idusuario'];
                    $resp = $this->eliminarUsuario();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "idusuario" => $this->idusuario
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
    private function eliminarUsuario(){
        $query = "UPDATE " . $this->table . " SET estado = 'Inactivo' WHERE id_usuario = '" . $this->idusuario . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }

    //Funcion para buscar y comprobar la existencia del token que se recibe
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