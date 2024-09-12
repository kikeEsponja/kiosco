<?php
include "config.php";
session_start();
//var_dump($_SESSION);

if($_POST && isset($_SESSION['user_id']) && isset($_SESSION['usuario'])){
    $usuario= $_SESSION['usuario'];
    $userId = $_SESSION['user_id'];
	$producto = mysqli_real_escape_string($conn, $_POST['producto']);
    $precio = (float) $_POST['precio'];
	$cantidad = (int)$_POST['cantidad'];

	$chequeoProducto = "SELECT * FROM productos WHERE user_id = '$userId' AND producto = '$producto'";
	$resultProducto = mysqli_query($conn, $chequeoProducto);

	if(mysqli_num_rows($resultProducto) > 0){
        $sql = "UPDATE productos SET cantidad = cantidad + '$cantidad', precio = '$precio' WHERE user_id = '$userId' AND producto = '$producto'";
    }else{
        $sql = "INSERT INTO productos (user_id, producto, precio, cantidad) VALUES ('$userId', '$producto', '$precio', '$cantidad')";
    }
    $query = mysqli_query($conn, $sql);

    if($query){
        echo "<h2 class='good'>Producto actualizado</h2><br><a href='../../admin/admin.php'>volver</a>";
    }else{
        echo "<h2 class='bad'>Algo salió mal</h2>";
    }
}else{
    echo "<h2 class='bad'>Usuario no encontrado</h2>";
}