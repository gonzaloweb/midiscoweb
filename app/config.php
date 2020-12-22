<?php

define ('GESTIONUSUARIOS','1');
define ('GESTIONFICHEROS','2');

// Fichero donde se guardan los datos
define('FILEUSER','app/dat/usuarios.json');
// Ruta donde se guardan los archivos de los usuarios
// Tiene que tener permiso 777 o permitir a Apache rwx
define('RUTA_FICHEROS','/home/Escritorio/phpb/actividades/midiscoweb/dirpruebas');

// (0-Básico |1-Profesional |2- Premium| 3- Máster)
const  PLANES = ['Básico','Profesional','Premium','Máster'];
//  Estado: (A-Activo | B-Bloqueado |I-Inactivo )
const  ESTADOS = ['A' => 'Activo','B' =>'Bloqueado', 'I' => 'Inactivo']; 

// Definir otras constantes 

const MENSAJES = [
    'ID_REPETIDO' => "Error. El ID para el registro ya existe<br>",
    'ID_FORMATO' => "Error. El ID para el registro solo puede tener letras y números<br>",
    'PASS_NOIGUALES' => "Error. Las contraseñas introducidas no coinciden<br>",
    'PASS_NOSEGURA' => "Error. La contraseña no es segura<br>",
    'PASS_CORTA'    => "Error. La contraseña debe tener al menos 8 caracteres<br>",
    'PASS_LARGA'    => "Error. La contraseña debe ser menor de 15 caracteres<br>",
    'CORREO_FORMATO' => "Error. El correo electrónico introducido no es correcto<br>",
    'CORREO_REPETIDO'  => "Error. Ya existe la dirección de correo<br>",
];