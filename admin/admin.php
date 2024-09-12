<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
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
    <div>
        <h3 class="ok" id="SaludoUser-coin"><?php echo $_SESSION['usuario']; ?> </h3>
    </div>
    <center>
        <div>
            <button type="salir" id="salir" onclick="fuera()">salir</button>
        </div>
        <!-- *********************************************************************************************************** -->
        <form action="../src/js/product_grupo.php" method="post" id="registro_masivo" enctype="multipart/form-data">
            <h2>ingresar inventario completo</h2>
            <br>
            <div>
                <input type="file" id="archivo" name="archivo" class="input-file" accept=".xlsx, .xls">
                <h3>estado: <span id="estado_ingreso_masivo"></span></h3>
            </div>
            <br>
            <button type="submit">ingresar archivo</button>
        </form>
        <br>
        <!-- *********************************************************************************************************** -->
        <form action="../src/js/calif.php" method="POST" id="registro_productos">
            <h2>ingresar productos</h2>
            <br>
            <div>
                <input type="text" placeholder="producto" name="producto">
                <input type="number" placeholder="precio de compra" name="precio">
                <input type="number" placeholder="cantidad" name="cantidad">
                <h3>estado: <span id="estado_ingreso"></span></h3>
            </div>
            <br>
            <button type="submit" id="ing_prod">ingresar producto</button>
        </form>
        <br>
        <!-- *********************************************************************************************************** -->
        <form action="../src/js/mostrar.php" method="get" id="consulta_productos">
            <h2>buscar producto</h2>
            <br>
            <div>
                <input type="text" placeholder="producto" name="producto">
                <!--<input type="number" placeholder="precio de compra" name="precio">
                <input type="number" placeholder="cantidad" name="cantidad">-->
                <h3>producto: <span id="consulta"></span></h3>
            </div>
            <br>
            <button type="submit" id="cons_prod">buscar producto</button>
        </form>
        <br>
        <!-- *********************************************************************************************************** -->
        <!--<form action="http://localhost:1067/actualizar" method="post" id="actualizar_productos">
            <h2>actualizar precio</h2>
            <br>
            <div>
                <input type="text" placeholder="producto" name="producto">
                <input type="number" placeholder="precio de compra" name="precio">
                <input type="number" placeholder="cantidad" name="cantidad">
                <h3>precio: <span id="act_precio"></span></h3>
            </div>
            <br>
            <button type="submit" id="act_prod">actualziar precio</button>
        </form>
        <br>-->
        <!-- *********************************************************************************************************** -->
        <form action="../src/js/borrar.php" method="post" id="borrar_producto">
            <h2>eliminar producto</h2>
            <br>
            <div>
                <input type="text" placeholder="producto" name="borrar_producto">
                <!--<input type="number" placeholder="precio de compra" name="precio">
                <input type="number" placeholder="cantidad" name="cantidad">-->
                <h3>producto: <span id="del_prod"></span></h3>
            </div>
            <br>
            <button type="submit" id="del_boton">eliminar producto</button>
        </form>
    </center>
    <script src="../src/js/funciones.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
<?php
    }
	else
	{
		header('location: ./mal.php');
	}
?>