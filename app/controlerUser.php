<html>
<head>
<script type="text/javascript">
function registrar(){
   window.alert("rellene todos los campos");
   document.location.href="?orden=Registrarse";
}
function borradoUser(){
	window.alert("El Usuario seleccionado ha sido eliminado de la base de datos");
}
function errorBorrado() {
	window.alert("No se ha podido eliminar el usuario");
}
function actualizadoUser() {
	window.alert("El Usuario ha sido actualizado correctamente en la base de datos ");
}
</script>
</head>
<?php
// ------------------------------------------------
// Controlador que realiza la gestión de usuarios
// ------------------------------------------------
include_once 'config.php';
include_once 'modeloUser.php';

/*
 * Inicio Muestra o procesa el formulario (POST)
 */
function ctlUserInicio()
{
    $msg = "";
    $user = "";
    $clave = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['user']) && isset($_POST['clave'])) {
            $user = $_POST['user'];
            $clave = $_POST['clave'];
            if (modeloOkUser($user, $clave)) {
                $_SESSION['user'] = $user;
                $_SESSION['tipouser'] = modeloObtenerTipo($user);
                if ($_SESSION['tipouser'] == "Máster") {
                    $_SESSION['modo'] = GESTIONUSUARIOS;
                    header('Location:index.php?orden=VerUsuarios');
                } else {
                    // Usuario normal;
                    // PRIMERA VERSIÓN SOLO USUARIOS ADMISTRADORES
                    $msg = "Error: Acceso solo permitido a usuarios Administradores.";
                    unset($_SESSION['user']);
                    // $_SESSION['modo'] = GESTIONFICHEROS;
                    // Cambio de modo y redireccion a verficheros
                }
            } else {
                $msg = "Error: usuario y contraseña no válidos.";
            }
        }
    }

    include_once 'plantilla/facceso.php';
}

function ctlUserRegistro()
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        limpiarArrayEntrada($_POST); // evito inyección de código
        $userid = $_POST['iduser'];
        $clave = $_POST['clave'];
        $clave2 = $_POST['clave2'];
        $correo = $_POST['correo'];

        foreach ($_POST as $codigo => $valor) {
            $datos[] = $valor;
        } // almaceno los datos enviados

        for ($i = 0; $i < count($datos) - 1; $i ++) { // -1 para que no cuente el campo "plan"
            if (empty($datos[$i]) && $datos[$i] !== 0) {
                echo "<script>registrar()</script>"; // obligatorio rellenar todos los campos
            }
        }
        
     array_push($datos, 'I'); // añade estado inactivo al final del array de datos
        $userdat = [$datos[2],$datos[1],$datos[4],$datos[5],$datos[6]];
       
        $msg = comprobarRegistro($userid, $correo, $clave, $clave2);
        if ($msg == 'Usuario Registrado Con éxito!!!') {
            modeloUserAdd($userid, $userdat);
        }
    }

    include_once 'plantilla/fregistro.php';
}

function ctlUserModificar() {
        /*
          0 => clave
          1 => nombre
          2 => correo
          3 => plan
          4 => estado 'I' 
         */
    
    if ( $_SERVER['REQUEST_METHOD'] == "GET"){
        $datos = modeloUserGet($_GET['id']);
        
        $userid   = $_GET['id'];
        $clave  = $datos[0];
        $clave2 = $datos[0];
        $nombre = $datos[1];
        $correo = $datos[2];
        $plan   = $datos[3];
        $estado = $datos[4];
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $userid = $_POST['iduser'];
        limpiarArrayEntrada($_POST); // evito inyección de código
        
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $clave2 = $_POST['clave2'];
        $correo = $_POST['correo'];
        $plan = $_POST['plan'];
        $estado = $_POST['estado'];
        
        foreach ($_POST as $codigo => $valor) {
            if($codigo == 'iduser')continue; 
            $datos[] = $valor;
       }
       
       $userdat = [
           $_POST['clave'],
           $_POST['nombre'],
           $_POST['correo'],
           $_POST['plan'],
           $_POST['estado'],
       ];

        $msg = modificar($_POST['clave'], $_POST['clave2'], $_POST['correo']);
        if ($msg == 'Usuario Modificado Con éxito!!!') {
            modeloUserUpdate($userid, $userdat);
            
            echo "<script>actualizadoUser()</script>";
            header("refresh:0;url=index.php?orden=VerUsuarios");
        }
    }
    
    include_once 'plantilla/fmodificar.php';
    
}
function ctlUserBorrar()
{
    $userid = $_GET['id'];
    if (modeloUserDel($userid)) {
        echo "<script>borradoUser()</script>";
    } else {
        echo "<script>errorBorrado()</script>";
    }
    modeloUserSave();
    header("refresh:0;url=index.php?orden=VerUsuarios");
}

function ctlUserDetalles() {
    
    $datos = modeloUserGet($_GET['id']);
    $userid=$_GET['id'];
    $nombre = $datos[1];
    $clave  = $datos[0];
    $correo = $datos[2];
    $plan   = PLANES[$datos[3]];
    $estado = ESTADOS[$datos[4]];

    include_once 'plantilla/detallesUser.php';
}

// Cierra la sesión y vuelva los datos
function ctlUserCerrar()
{
    session_destroy();
    modeloUserSave();
    header('Location:index.php');
}

// Muestro la tabla con los usuario
function ctlUserVerUsuarios()
{
    // Obtengo los datos del modelo
    $usuarios = modeloUserGetAll();
    // Invoco la vista
    include_once 'plantilla/verusuariosp.php';
}
?>
</html>