<?php
include "config.php";

if($_POST){
	$producto = mysqli_real_escape_string($conn, $_POST['borrar_producto']);
    //$idProducto = mysqli_real_escape_string($conn, $_POST['id']);

	$chequeoProducto = "SELECT producto FROM productos WHERE producto = '$producto'";
	$resultProducto = mysqli_query($conn, $chequeoProducto);

	if(mysqli_num_rows($resultProducto) > 0){
        $row = mysqli_fetch_assoc($resultProducto);
        $idProducto = $row['producto'];
    
        $sqlEliminarProducto = "DELETE FROM productos WHERE producto = '$idProducto'";
    	mysqli_query($conn, $sqlEliminarProducto);

        if($sqlEliminarProducto){
            echo "<h2 class='text-light'>Producto eliminado</h2><br><a class='btn btn-success' href='../../admin/admin.php'>volver</a>";
        }else{
            echo "<h2 class='text-light'>Algo salió mal</h2>";
        }
    }else{
        echo "<h2 class='text-light'>Producto no encontrado</h2>";
    }
}