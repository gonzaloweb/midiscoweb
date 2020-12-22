<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
$titulos = [ "ID","Nombre","correo","Plan","Estado","Operaciones"];
?>
<div id='aviso'><b><?= (isset($msg))?$msg:"" ?></b></div>
<table>

<?php
$auto = $_SERVER['PHP_SELF'];

echo "<tr>";
for  ($i=0; $i <= count($titulos)-1; $i++) { //cabecera tabla
    if ($titulos[$i]=='Operaciones') {
        echo "<th colspan=3>$titulos[$i]</th>";
    } else {
        echo "<th>$titulos[$i] </th>";
    }
}
echo "</tr>";

foreach ($usuarios as $clave => $datosusuario) : 

?>


<tr>	
<th><?= $clave ?></th> 
	<?php for  ($j=0; $j <count($datosusuario); $j++) :?>
     <td><?=$datosusuario[$j] ?></td>
	<?php endfor;?>
<td><a href="#" onclick="confirmarBorrar('<?= $datosusuario[0]."','".$clave."'"?>);">Borrar</a></td>
<td><a href="<?= $auto?>?orden=Modificar&id=<?= $clave ?>">Modificar</a></td>
<td><a href="<?= $auto?>?orden=Detalles&id=<?= $clave?>">Detalles</a></td>
</tr>
<?php endforeach; ?>
</table>
<form action='index.php'>
	<input type='hidden' name='orden' value='Cerrar'> <input type='submit' value='Cerrar Sesión'>
</form>

<?php
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido de la página principal
$contenido = ob_get_clean();
include_once "principal.php";

?>