<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
// FORMULARIO DE ALTA DE USUARIOS
?>
<div id='aviso'><b><?= (isset($msg))?$msg:"" ?></b></div>
<form name='REGISTRO' method="POST" action="index.php?orden=Registrarse">	
<h1>Alta de Usuario:</h1>
<table>
		<tr><td> Identificador:</td>
			<td> <input type="text" name="iduser" value="<?= (isset($userid))?$userid:"" ?>" <?= (isset($idOK) && $idOK=="OK")?"readonly":"" ?> ></td>
		</tr>
		<tr><td>Nombre:</td>
			<td><input type="text" name="nombre" value="<?= (isset($datos[1]))?$datos[1]:"" ?>"></td>
		</tr>
		<tr><td>Contraseña:</td>
			<td><input type="password" name="clave" value="<?= (isset($datos[2]))?$datos[2]:""  ?>"></td>
		</tr>
		<tr><td>Repetir Contraseña:</td>
			<td><input type="password" name="clave2" value="<?= (isset($datos[3]))?$datos[3]:"" ?>"></td>
		</tr>
		<tr><td>Correo electrónico: </td>
			<td><input type="text" name="correo" value="<?= (isset($datos[4]))?$datos[4]:"" ?>"></td>
		</tr>
		<tr><td> Plan :</td>
			<td> <select name="plan">
					<option value="0" <?= (isset($datos[5]) == "0")?"selected":""  ?> >Básico</option>
					<option value="1" <?= (isset($datos[5]) == "1")?"selected":""  ?> >Profesional</option>
					<option value="2" <?= (isset($datos[5]) == "2")?"selected":""  ?> >Premium</option>
				</select></td>
		</tr>
</table></br></br>
	
	<input type="submit" value="Alta"> 
	<input type="button" name="Cancelar" value="Cancelar" onclick="javascript:window.location='index.php'" >
	<input type="button" value=" Volver " size="10" onclick="javascript:window.location='index.php'" >

</form>
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>