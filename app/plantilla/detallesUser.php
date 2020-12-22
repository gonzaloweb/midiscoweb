<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
?>
<h1>Detalles de Usuario:</h1>
<table>
	<tr>
		<th>Id</th><td> <?= $userid ?></td>
	</tr>
	<tr>
		<th>Nombre</th><td><?= $nombre ?></td>
	</tr>
    <tr>
    	<th>Correo electrónico:</th><td><?= $correo ?></td>
    </tr>
    <tr>
    	<th>Plan</th><td><?= $plan ?></td>
    </tr>
    <tr>
    	<th>Estado</th><td><?= $estado ?></td>
    </tr>
</table>
<input type="button" value=" Volver " size="10" onclick="javascript:window.location='index.php'" >
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido

$contenido = ob_get_clean();
include_once "principal.php";

?>