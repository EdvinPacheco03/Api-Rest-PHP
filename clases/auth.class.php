<?php
require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';
require "sesion.class.php";

    


class auth extends conexion{

    public function login($json){
      
        $_respustas = new respuestas;
        $datos = json_decode($json,true);
        if(!isset($datos['usuario']) || !isset($datos["password"])){
            //error con los campos
            return $_respustas->error_400();
        }else{
            //todo esta bien 
            $usuario = $datos['usuario'];
            $password = $datos['password'];
            $password = parent::encriptar($password);
            $datos = $this->obtenerDatosUsuario($usuario);
            if($datos){
                //verificar si la contraseña es igual
                    if($password == $datos[0]['password']){
                            if($datos[0]['estado'] == "Activo"){
                                //crear el token
                                $verificar  = $this->insertarToken($datos[0]['id_usuario']);
                                if($verificar){
                                        // si se guardo
                                        $result = $_respustas->response;
                                        $result["result"] = array(
                                            "una" => $_SESSION,
                                            "token" => $verificar
                                        );
                                        return $result;
                                }else{
                                        //error al guardar
                                        return $_respustas->error_500("Error interno, No hemos podido guardar");
                                }
                            }else{
                                //el usuario esta inactivo
                                return $_respustas->error_200("El usuario esta inactivo");
                            }
                    }else{
                        //la contraseña no es igual
                        return $_respustas->error_200("El password es invalido");
                    }
            }else{
                //no existe el usuario
                return $_respustas->error_200("El usuario $usuario  no existe ");
            }
        }
    }



    private function obtenerDatosUsuario($correo){
        $session = new Session();
        $query = "SELECT id_usuario,usuario,password,idrol,estado FROM usuarios WHERE usuario = '$correo'";
        $datos = parent::obtenerDatos($query);
        $array = parent::oneSession($query);
        if(isset($datos[0]["id_usuario"])){
            $session->setAttribute($array);
            return $datos;
        }else{
            return 0;
        }
    }


    private function insertarToken($usuarioid){
        $val = true;
        $token = bin2hex(openssl_random_pseudo_bytes(16,$val));
        $date = date("Y-m-d H:i");
        $estado = "Activo";
        $query = "INSERT INTO usuarios_token (UsuarioId,Token,Estado,Fecha)VALUES('$usuarioid','$token','$estado','$date')";
        $verifica = parent::nonQuery($query);
        if($verifica){
            return $token;
        }else{
            return 0;
        }
    }


}




?>