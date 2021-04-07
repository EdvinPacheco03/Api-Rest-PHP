<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - Prubebas</title>
    <link rel="stylesheet" href="assets/estilo.css" type="text/css">
</head>
<body>

<div  class="container">
    <h1>Documentacion de API</h1>
    <!-- LOGIN -->
    <div class="divbody">
        <h2>Auth - login</h2>
        <code>
           POST  /auth
           <br>
           {
               <br>
               "usuario" :"",  -> REQUERIDO
               <br>
               "password": "" -> REQUERIDO
               <br>
            }
        
        </code>
    </div>    
      <!--PACIENTES  -->
    <div class="divbody">   
        <h2>Pacientes</h2>
        <code>
           GET (<strong>Obtener todos los pacientes por usuario</strong>)    /pacientes?iduser=$iduser&token=$token
           <br>
           GET (obtener pacientes por ID)                   /pacientes?id=$idPaciente
           <br>
           GET (obtener pacientes por Nombre)                   /pacientes?naem=$namePaciente
           <br>
           GET (Filtrar paciente por DPI)                   /pacientes?dpi=$dpi
           <br>
           GET (Obtener el total de pacientes por usuario)  /pacientes?idusuario=$idusuario
        </code>

        <code>
           POST  /pacientes
           <br> 
           {
            <br> 
               "nombre" : "",               -> REQUERIDO
               <br> 
               "dni" : "",                  -> REQUERIDO
               <br> 
               "correo":"",                 -> REQUERIDO
               <br> 
               "idusuario":"",                 -> REQUERIDO         
               <br>  
               "genero" : "",        
               <br>        
               "telefono" : "",       
               <br>       
               "fechaNacimiento" : "",      
               <br>         
               "token" : ""                 -> REQUERIDO        
               <br>       
           }

        </code>
        <code>
           PUT  /pacientes
           <br> 
           {
            <br> 
               "nombre" : "",               
               <br> 
               "dni" : "",                  
               <br> 
               "correo":"",                      
               <br>  
               "genero" : "",        
               <br>        
               "telefono" : "",       
               <br>       
               "fechaNacimiento" : "",      
               <br>         
               "token" : "" ,                -> REQUERIDO        
               <br>       
               "pacienteId" : ""   -> REQUERIDO
               <br>
           }

        </code>
        <code>
           DELETE  /pacientes
           <br> 
           {   
               <br>    
               "token" : "",                -> REQUERIDO        
               <br>       
               "pacienteId" : ""   -> REQUERIDO
               <br>
           }

        </code>
    </div>

    <!-- USUARIOS -->
    <div class="divbody">   
        <h2>Usuarios</h2>
        <code>
           GET (<strong>Obtener todos los Usuarios</strong>)    /usuarios?idrol=$idrol&token=$token
           <br>
           GET (obtener Usuarios por ID)                   /usuarios?iduser=$iduser
           <br>
           GET (Obtener el total de Usuarios)  /usuarios?idrol=$idrol
        </code>

        <code>
           POST  /usuarios
           <br> 
           {
            <br> 
               "nombre" : "",               -> REQUERIDO
               <br> 
               "usuario" : "",                  -> REQUERIDO
               <br> 
               "password":"",                 -> REQUERIDO
               <br> 
               "telefono":"",                 -> REQUERIDO
               <br> 
               "idrol" :"",                 -> REQUERIDO
               <br>         
               "token" : ""                 -> REQUERIDO        
               <br>       
           }

        </code>
        <code>
           PUT  /usuarios
           <br> 
           {
            <br> 
               "nombre" : "",           -> REQUERIDO            
               <br> 
               "usuario" : "",          -> REQUERIDO              
               <br> 
               "password":"",           -> REQUERIDO           
               <br> 
               "telefono" :"",           -> REQUERIDO  
               <br>  
               "idrol" : "",           
               <br>         
               "token" : "" ,            -> REQUERIDO        
               <br>       
               "idusuario" : ""          -> REQUERIDO
               <br>
           }

        </code>
        <code>
           DELETE  /usuarios
           <br> 
           {   
               <br>    
               "token" : "",                -> REQUERIDO        
               <br>       
               "idusuario" : ""   -> REQUERIDO
               <br>
           }

        </code>
    </div>

    <!-- CITAS -->
    <div class="divbody">   
        <h2>Citas</h2>
        <code>
           GET (<strong>Obtener todos las citas por usuario</strong>)    /citas?iduser=$idusuario&token=$token
           <br>
           GET (obtener citas por ID)                   /citas?id=$idcita
           <br>
           GET (Obtener el listado de citas del dia actual por Usuario)                   /citas?idusuario=$idusuario&token=$token
        </code>

        <code>
           POST  /citas
           <br> 
           {
            <br> 
               "$idpaciente" : "",               -> REQUERIDO
               <br> 
               "fecha" : "",                  -> REQUERIDO
               <br> 
               "idusuario":"",                 -> REQUERIDO
               <br> 
               "horarioIn":"",             
               <br> 
               "horarioFin" :"",             
               <br>  
               "motivo" : "",           
               <br>         
               "token" : ""                 -> REQUERIDO        
               <br>       
           }

        </code>
        <code>
           PUT  /citas
           <br> 
           {
            <br> 
               "nombre" : "",               
               <br> 
               "dni" : "",                  
               <br> 
               "correo":"",                 
               <br> 
               "codigoPostal" :"",             
               <br>  
               "genero" : "",        
               <br>        
               "telefono" : "",       
               <br>       
               "fechaNacimiento" : "",      
               <br>         
               "token" : "" ,                -> REQUERIDO        
               <br>       
               "pacienteId" : ""   -> REQUERIDO
               <br>
           }

        </code>
        <code>
           DELETE  /citas
           <br> 
           {   
               <br>    
               "token" : "",                -> REQUERIDO        
               <br>       
               "idcita" : ""                -> REQUERIDO
               <br>
           }

        </code>
    </div>

    <!-- NOTAS -->
    <div class="divbody">   
        <h2>Notas</h2>
        <code>
           GET (<strong>Obtener todos las notas por usuario</strong>)    /notas?iduser=$idusuario&token=$token
           <br>
           GET (obtener nota por ID)                   /notas?id=$idnota
           <br>
           GET (Obtener el total de notas por usuario)  /notas?idusuario=$idusuario
        </code>

        <code>
           POST  /notas
           <br> 
           {
            <br> 
               "titulo" : "",               -> REQUERIDO
               <br> 
               "descripcion" : "",                  -> REQUERIDO
               <br> 
               "idusuari o":"",                 -> REQUERIDO   
               <br>         
               "token" : ""                 -> REQUERIDO        
               <br>       
           }

        </code>
        <code>
           PUT  /notas
           <br> 
           {
            <br> 
               "titulo" : "",               
               <br> 
               "descripcion" : "",                 
               <br>         
               "token" : "" ,                -> REQUERIDO        
               <br>       
               "idnotas" : ""   -> REQUERIDO
               <br>
           }

        </code>
        <code>
           DELETE  /notas
           <br> 
           {   
               <br>    
               "token" : "",                -> REQUERIDO        
               <br>       
               "idnotas" : ""               -> REQUERIDO
               <br>
           }

        </code>
    </div>

    <!-- Contacto -->
    <div class="divbody">
       <h2>contacto</h2>
       <div class="contact">
          <p>Dudas o sugerencias <strong>edvinpacheco03@gmail.com</strong></p>
       </div>
    </div>


</div>
    
</body>
</html>

