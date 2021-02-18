<?php


class Session {

    function __construct()
    {
        session_start();
    }


    
    function setAttribute($value)
    {
        if (session_status() === PHP_SESSION_ACTIVE ) {
            // $array = json_decode($value);
            // print_r($value);
            $_SESSION['active'] = true;
            $_SESSION["usuarioid"] = $value['id_usuario'];
            $_SESSION["usuario"] = $value['usuario'];
            $_SESSION["pass"] = $value['password'];
            $_SESSION["estado"] = $value['estado'];
            $_SESSION["idrol"] = $value['idrol'];
            //  print_r($_SESSION);
            // UsuarioId,Usuario,Password,Estado
        }
    }
    

    function getAttribute($attribute)
    {
        if (session_status() === PHP_SESSION_ACTIVE 
            && is_string($attribute) 
            && isset($_SESSION[$attribute])) {
            return $_SESSION[$attribute];
        }
        return null;
    }

    function deleteAttribute($attribute)
    {
        if (session_status() === PHP_SESSION_ACTIVE 
            && is_string($attribute) 
            && isset($_SESSION[$attribute])) {
            unset($_SESSION[$attribute]);
        }
    }

    function destroySession()
    {
        session_destroy();
    }
}

?>

