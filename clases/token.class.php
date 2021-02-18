<?php
require_once 'conexion/conexion.php';
require_once "respuestas.class.php";

class token extends conexion{

    function actualizarTokens($fecha){
        $query = "update usuarios_token set Estado = 'Inactivo' WHERE  Fecha < '$fecha' AND Estado = 'Inactivo'";
        $verifica = parent::nonQuery($query);
        if($verifica){
            $this->escribirEntrada($verifica);
            return $verifica;
        }else{
            return 0;
        }
    }

    function eliminarToken($token){
        $_respuestas = new respuestas;
        $query = "DELETE FROM usuarios_token WHERE Token = '$token'";
        $verifica = parent::delToken($query);
        if($verifica >= 1){
            $respuesta = $_respuestas->response;
            $respuesta["result"] = array(
                "Eliminado" => $token,
                "mensaje" => $verifica 
            );
            
            return $respuesta;
        }else{
            return $_respuestas->error_500();
        }
    }

    function crearTxt($direccion){
           $archivo = fopen($direccion, 'w') or die ("error al crear el archivo de registros");
           $texto = "------------------------------------ Registros del CRON JOB ------------------------------------ \n";
           fwrite($archivo,$texto) or die ("no pudimos escribir el registro");
           fclose($archivo);
    }

    function escribirEntrada($registros){
        $direccion = "../cron/registros/registros.txt";
        if(!file_exists($direccion)){
            $this->crearTxt($direccion);
        }
        /* crear una entrada nueva */
        $this->escribirTxt($direccion, $registros);
    }

    function escribirTxt($direccion, $registros){
        $date = date("Y-m-d H:i");
        $archivo = fopen($direccion, 'a') or die ("error al abrir el archivo de registros");
           $texto = "Se modificaron $registros registro(s) el dia [$date] \n";
           fwrite($archivo,$texto) or die ("no pudimos escribir el registro");
           fclose($archivo);
    }

    
}

?>