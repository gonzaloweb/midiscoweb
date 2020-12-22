<?php

// Guardo la salida en un buffer(en memoria)    
// No se envia al navegador
ob_start();
// FORMULARIO DE ALTA DE USUARIOS
?>
<div id='aviso'><b><?= (isset($msg))?$msg:"" ?></b></div>
<form name='MODIFICAR' method="POST" action="index.php?orden=Modificar">
<h1>Modificar Usuario:</h1>
<table>
		<tr><td> Identificador:</td>
			<td> <input type="text" name="iduser" value="<?= (isset($userid))?$userid:"" ?>" <?= "readonly"?> ></td>
		</tr>
		<tr><td>Nombre:</td>
			<td><input type="text" name="nombre" value="<?= (isset($nombre))?$nombre:"" ?>"></td>
		</tr>
		<tr><td>Contraseña:</td>
			<td><input type="password" name="clave" value="<?= (isset($clave))?$clave:""  ?>"></td>
		</tr>
		<tr><td>Repetir Contraseña:</td>
			<td><input type="password" name="clave2" value="<?= (isset($clave2))?$clave2:"" ?>"></td>
		</tr>
		<tr><td>Correo electrónico: </td>
			<td><input type="text" name="correo" value="<?= (isset($correo))?$correo:"" ?>"></td>
		</tr>
		<tr>
		<tr><td> Plan :</td>
			<td> <select name="plan">
					<option value="0" <?= ($plan == 0)?"selected":""  ?> >Básico</option>
					<option value="1" <?= ($plan == 1)?"selected":""  ?> >Profesional</option>
					<option value="2" <?= ($plan == 2)?"selected":""  ?> >Premium</option>
    				<option value="3" <?= ($plan == 3)?"selected":""  ?> >Máster</option>
				</select></td>
		</tr><td>Estado :</td>
			<td><select name="estado">
                	<option value="A" <?= ($estado == "A")?"selected":"" ?> >Activo</option>
                	<option value="B" <?= ($estado == "B")?"selected":"" ?> >Bloqueado</option>
                	<option value="I" <?= ($estado == "I")?"selected":"" ?> >Inactivo</option>  
				</select></td>
		</tr>
</table></br></br>
	
	<input type="submit" value=" Guardar ">
	<input type="button" value="Cancelar" onclick="javascript:window.location='index.php'" >
</form>

<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>