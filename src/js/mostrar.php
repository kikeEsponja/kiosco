<?php
include "config.php";

if($_GET){
	//$producto = mysqli_real_escape_string($conn, $_POST['producto']);
	$chequeoProducto = "SELECT producto, precio, cantidad FROM productos";
	$resultProducto = mysqli_query($conn, $chequeoProducto);

	if(mysqli_num_rows($resultProducto) > 0){
        $rowProducto = mysqli_fetch_assoc($resultProducto);
        //$producto = $rowProducto['producto'];
        $precio = $rowProducto['precio'];
        $cantidad = $rowProducto['cantidad'];

        //$califProducto = "SELECT materia, calificacion FROM materias WHERE id_alumno = '$idAlumno'";
        //$resultCalifAlumno = mysqli_query($conn, $califAlumno);

        //echo "<h3>Alumno: ".$nombreAlumno."</h3>";

        //if(mysqli_num_rows($resultCalifAlumno) > 0) {
            //echo "<h3>calificaciones:</h3>";
        /*while ($rowProducto = mysqli_fetch_assoc($resultProducto)){
            echo "<p>Producto: ". $rowProducto['producto'] . " - Precio: " . $rowProducto['precio'] . " - Cantidad: " . $rowProducto['cantidad'] . "</p>";
        }*/
        echo "<p>Producto: ". $rowProducto['producto'] . " - Precio: " . $rowProducto['precio'] . " - Cantidad: " . $rowProducto['cantidad'] . "</p>";
    }else{
        echo "<h2 class='bad'>Algo salió mal</h2>";
    }
}else{
    echo "<h4>Producto no encontrado</h4>";
}
//}
echo "<a href='../../admin/admin.php'>volver</a>";