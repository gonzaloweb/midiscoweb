<?php

// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
// FORMULARIO DE ALTA DE USUARIOS
?>
<div id='aviso'><b><?= (isset($msg))?$msg:"" ?></b></div>
<form name='ALTA' method="POST" action="index.php?orden=Alta">
<-- COMPLETAR -->	
<table>
		<tr>
			<td>ALTA</td>
			<td><input type="text" name="user"
				value="<?= $user ?>"></td>
		</tr>
		<tr>
			<td>Contraseña2:</td>
			<td><input type="password" name="clave"
				value="<?= $clave ?>"></td>
		</tr>
		<!-- AÑADIR ALTA REGISTRO -->
	</table>
	<input type="submit" name="orden" value="Entrar">	
</form>
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>