<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../src/img/kiosco.jpg">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hint.css/2.7.0/hint.min.css">
        <link rel="stylesheet" href="./admin.css">
        <title>administración</title>
    </head>
<body>
    <section class="text-center">
    	<h1>Registro</h1>
        <form id="registroForm" action="../src/js/log_registro.php" method="POST" class="formulario">
            <!--<label for="user">Nombre de usuario</label>-->
            <input class="btn btn-light" type="text" placeholder="usuario" id="user" name="usuario">
            <!--<label for="email">Correo electrónico</label>-->
            <input class="btn btn-light" type="email" placeholder="e-mail" id="email" name="correo">
            <!--<label for="contras">Contraseña</label>-->
            <input class="btn btn-light" type="password" placeholder="contraseña" id="contras" name="contras">
            <!--<label for="contras_rep">Repita contraseña</label>-->
            <input class="btn btn-light" type="password" placeholder="repita contraseña" id="contras_rep" name="contras_rep">
            <br>
            <button type="submit" class="btn btn-success" id="boton_registro" onclick="validarContras()">registrarme</button>
        </form>
        <h3>Si ya está registrado, inicie sesión acá</h3>
        <a href="./login.php" class="btn btn-primary">iniciar sesión</a>
        <a href="../index.php">ir al inicio</a>
    </section>
    <script src="../src/js/funciones.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>