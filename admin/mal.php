<?php 
	session_start();
	if(isset($_SESSION['usuario']))
	{
		//include "layouts/header2.php"; 
		include "../src/js/config.php"; 
		
		$sql="SELECT * FROM `usuarios`";

		$query = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/css/admin.css">
    <title>Administración</title>
</head>
<body>
    <center>
        <h1>Algo no ha ido bien con el registro: <span id="bienvenido"><?php echo $_SESSION['usuario']; ?></span>. Sin embargo TU usuario está en la base de datos</h1>
        <a href="../index.php">ir a inicio</a>
        <a href="./login.php">ir a plataforma</a>
    </center>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src='./admin.js'></script>
</body>
</html>
<?php
	}
	else
	{
		header('location: ../index.php');
	}
?>