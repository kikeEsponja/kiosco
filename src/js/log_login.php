<?php
include "config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['correo'];
    $password = $_POST['contras'];

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM `usuarios` where correo = '" . $email . "' AND contras = '" . $password . "' ";
    $query =  mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['usuario'] = $row['usuario'];
        header('Location: ../../admin/plataforma.php');
        exit;
    } else {
        echo "<script> alert('Correo o contraseña incorrectas.'); </script>";
        echo '<a class="btn btn-warning" href="../../admin/login.php">volver</a>';
    }
}