<?php
include "config.php";

if($_POST){
	$name=$_POST['usuario'];
	$email=$_POST['correo'];
	$password=$_POST['contras'];

	$chequeo = "SELECT * FROM usuarios WHERE usuario = '$name'";
	$result = mysqli_query($conn, $chequeo);

	if(mysqli_num_rows($result) > 0){
		echo "<h2 class='bad'>Usuario existente</h2><br><br><a href='../../admin/registro.php'>volver</a>";
	}else{
		$sql="INSERT INTO `usuarios`(`usuario`, `correo`, `contras`) VALUES ('".$name."','".$email."','".$password."')";

		$query = mysqli_query($conn,$sql);
		if($query)
		{
			session_start();
			$_SESSION['usuario'] = $name;
			header('Location: ../../admin/bienvenido.php');
		}
		else
		{
			echo "Algo salió mal";
		}
	}
}