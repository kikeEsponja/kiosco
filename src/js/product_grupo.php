<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
use Shuchkin\SimpleXLSX;
include "./config.php";
include "./SimpleXLSX.php";

session_start();

if(isset($_SESSION['user_id'])){
	$idUsuario = $_SESSION['user_id'];

	if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0){
    	$archivo = $_FILES['archivo']['tmp_name'];
    	echo "Archivo recibido: " . $archivo . "<br>";

    	if($xlsx = SimpleXLSX::parse($archivo)){
        	echo "Archivo procesado<br>";

        	foreach($xlsx->rows() as $row){
            	echo "procesando fila: " . implode(", ", $row) ."<br>";

            	$producto = mysqli_real_escape_string($conn, $row[0]);
            	$precio = (float)mysqli_real_escape_string($conn, $row[1]);
            	$cantidad = (int)$row[2];

            	$chequeoProducto = "SELECT * FROM productos WHERE user_id = '$idUsuario' AND producto = '$producto'";
            	$resultProducto = mysqli_query($conn, $chequeoProducto);
                
                if(mysqli_num_rows($resultProducto) > 0){
                    $sql = "UPDATE productos SET cantidad = cantidad + '$cantidad', precio = '$precio' WHERE user_id = '$idUsuario' AND producto = '$producto'";
                }else{
                    $sql = "INSERT INTO productos (user_id, producto, precio, cantidad) VALUES ('$idUsuario', '$producto', '$precio', '$cantidad')";
                }
            
            	if(mysqli_query($conn, $sql)){
                	echo "producto actualizado: $producto<br>";
                }else{
                	echo "error al procesar poducto: " . mysqli_error($conn) . "<br>";
                }
            }
        	echo "<h2>Productos actualizados</h2><br><a href='../../admin/admin.php'>volver</a>";
    	}else{
        	echo "Error al procesar archivo: " . SimpleXLSX::parseError();
    	}
	}else{
    	echo "<h3>Error al subir archivo</h3>";
    }
}else{
	echo "<h2>Usuario no autenticado</h2>";
}