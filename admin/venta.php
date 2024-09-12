<?php
session_start();

if(isset($_SESSION['usuario']) && isset($_SESSION['user_id'])){
    include '../src/js/config.php';

    $userId = $_SESSION['user_id'];

    $data = json_decode(file_get_contents('php://input'), true);
    $cart = $data['cart'];

    $sql = "UPDATE productos SET cantidad = cantidad - ? WHERE producto = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if($stmt === false){
        echo json_encode(['success' => false, 'error' => 'Error al preparar consulta']);
        exit();
    }

    foreach($cart as $producto => $detalles){
        $cantidadVendida = $detalles['cantidad'];

        mysqli_stmt_bind_param($stmt, 'isi', $cantidadVendida, $producto, $userId);

        $result = mysqli_stmt_execute($stmt);

        if(!$result){
            echo json_encode(['success'=> false,'error'=> 'Error al actualizar productos']);
            exit();
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    echo json_encode(['success' => true]);
}else{
    header('Location: ./mal.php');
    exit();
}