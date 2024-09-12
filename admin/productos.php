<?php 
	if(isset($_SESSION['usuario']))	{
	//include "layouts/header2.php"; 
	include "../src/js/config.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../src/img/kiosco.jpg">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hint.css/2.7.0/hint.min.css">
        <link rel="stylesheet" href="../src/css/kiosco.css">
        <title>administración</title>
    </head>
<body>
    <?php
        include '../src/js/mostrar.php';
    ?>
</body>
</html>
<?php
    }
	else
	{
		header('location: ./mal.php');
	}
?>