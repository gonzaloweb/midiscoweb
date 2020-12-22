<?php 
include_once 'config.php';
/* DATOS DE USUARIO
• Identificador ( 5 a 10 caracteres, no debe existir previamente, solo letras y números)
• Contraseña ( 8 a 15 caracteres, debe ser segura)
• Nombre ( Nombre y apellidos del usuario
• Correo electrónico ( Valor válido de dirección correo, no debe existir previamente)
• Tipo de Plan (0-Básico |1-Profesional |2- Premium| 3- Máster)
• Estado: (A-Activo | B-Bloqueado |I-Inactivo )
*/
// Inicializo el modelo 
// Cargo los datos del fichero a la session
function modeloUserInit(){
    
    /*
    $tusuarios = [ 
         "admin"  => ["12345"      ,"Administrado"   ,"admin@system.com"   ,3,"A"],
         "user01" => ["user01clave","Fernando Pérez" ,"user01@gmailio.com" ,0,"A"],
         "user02" => ["user02clave","Carmen García"  ,"user02@gmailio.com" ,1,"B"],
         "yes33" =>  ["micasa23"   ,"Jesica Rico"    ,"yes33@gmailio.com"  ,2,"I"]
        ];
    */
    if (! isset ($_SESSION['tusuarios'] )){
    $datosjson = @file_get_contents(FILEUSER) or die("ERROR al abrir fichero de usuarios");
    $tusuarios = json_decode($datosjson, true);
    $_SESSION['tusuarios'] = $tusuarios;
   }

      
}

// Comprueba usuario y contraseña (boolean)
function modeloOkUser($user,$clave){
    $resu = false;
    if (isset ($_SESSION['tusuarios'][$user])) {
        $userdat = $_SESSION['tusuarios'][$user];
        $userclave = $userdat[0];
        $resu =($clave == $userclave);
    }
    return $resu;
}

// Devuelve el plan de usuario (String)
function modeloObtenerTipo($user){
    
    $nplan = $_SESSION['tusuarios'][$user][3];
    return PLANES[$nplan]; // Máster
}

// Borrar un usuario (boolean)
function modeloUserDel($userid){
 
    if (isset($_SESSION['tusuarios'][$userid])){ 
        unset($_SESSION['tusuarios'][$userid]);
        return true;
    }
    return false;

}

// Añadir un nuevo usuario (boolean)
function modeloUserAdd($userid,$userdat){
    if (! isset($_SESSION['tusuarios'][$userid])){
        $_SESSION['tusuarios'][$userid]= $userdat;
        modeloUserSave();
       return true;
   }
 return false;
}

// Actualizar un nuevo usuario (boolean)
function modeloUserUpdate ($userid,$userdat){
    if ( isset($_SESSION['tusuarios'][$userid])){
        $_SESSION['tusuarios'][$userid]= $userdat;
        modeloUserSave();
       
        return true;
    }
    return false;
}

// Tabla de todos los usuarios para visualizar
function modeloUserGetAll (){
    // Genero lo datos para la vista que no muestra la contraseña ni los códigos de estado o plan
    // sino su traducción a texto
    $tuservista=[];
    foreach ($_SESSION['tusuarios'] as $clave => $datosusuario){
        $tuservista[$clave] = [$datosusuario[1],
                               $datosusuario[2],
                               PLANES[$datosusuario[3]],
                               ESTADOS[$datosusuario[4]]
                               ];
    }
    return $tuservista;
}
// Datos de un usuario para visualizar
function modeloUserGet ($userid){
    if ( isset($_SESSION['tusuarios'][$userid])){
        return $_SESSION['tusuarios'][$userid];
    }
    return false;
}

// Vuelca los datos al fichero
function modeloUserSave(){
    
    $datosjon = json_encode($_SESSION['tusuarios']);
    file_put_contents(FILEUSER, $datosjon) or die ("Error al escribir en el fichero.");
}


function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = stripslashes($salida); // Elimina backslashes \
    $salida = strip_tags($salida); // Elimina etiquetas html
    $salida = htmlspecialchars($salida); // Traduce caracteres especiales en entidades HTML
    return $salida;
}
// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){
    
    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}

function comprobarRegistro($userid, $email, $password, $password2) {
    if (isset ($_SESSION['tusuarios'][$userid]) == $userid) {return $msg = MENSAJES['ID_REPETIDO'];}
    if( !preg_match("/^[a-zA-Z0-9]+$/", $userid)) {return $msg = MENSAJES['ID_FORMATO'];} // solo letras y números
    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)) {return $msg = MENSAJES['CORREO_FORMATO']; }
    foreach ($_SESSION['tusuarios'] as $clave => $valor){
        if ($valor[2] == $email) {return $msg = MENSAJES['CORREO_REPETIDO']; }
    }
    if ($password != $password2) {return $msg = MENSAJES['PASS_NOIGUALES']; } 
    else {
        if(strlen($password) < 8){return $msg = MENSAJES['PASS_CORTA'];}        
        if(strlen($password) > 15){return $msg = MENSAJES['PASS_LARGA'];}        
        if (!preg_match('`[a-z]`',$password)){return $msg = MENSAJES['PASS_NOSEGURA'];}        
        if (!preg_match('`[A-Z]`',$password)){return $msg = MENSAJES['PASS_NOSEGURA'];}        
        if (!preg_match('`[0-9]`',$password)){return $msg = MENSAJES['PASS_NOSEGURA'];}
    }
    return $msg = "Usuario Registrado Con éxito!!!";
}

function modificar($password, $password2, $email) {
   
    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)) {return $msg = MENSAJES['CORREO_FORMATO']; }
    if ($password != $password2) {return $msg = MENSAJES['PASS_NOIGUALES']; }
    else {
        if(strlen($password) < 8){return $msg = MENSAJES['PASS_CORTA'];}
        if(strlen($password) > 15){return $msg = MENSAJES['PASS_LARGA'];}        
        if (!preg_match('`[a-z]`',$password)){return $msg = MENSAJES['PASS_NOSEGURA'];}        
        if (!preg_match('`[A-Z]`',$password)){return $msg = MENSAJES['PASS_NOSEGURA'];}        
        if (!preg_match('`[0-9]`',$password)){return $msg = MENSAJES['PASS_NOSEGURA'];}
    }
    return $msg = "Usuario Modificado Con éxito!!!";
}