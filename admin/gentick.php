<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $data = json_decode(file_get_contents('php://input'), true);

    if($data && isset($data['cart']) && isset($data['total'])){
        $cart = $data['cart'];
        $total = $data['total'];
        $fecha = date('Y-m-d H:i:s');

        $filename = 'venta_' . date('Ymd_His') . ".txt";
        $file = fopen($filename, 'w');

    	if($file === false){
        	http_response_code(500);
        	echo "error: no se pudo escribir";
        	exit();
        }
    
        fwrite($file, "Fecha: " . $fecha . "\n");
        fwrite($file, "Productos vendidos: \n");
    
        foreach($cart as $producto => $detalles){
            fwrite($file, $producto . ": " . $detalles['cantidad'] . " unidades - $" . number_format($detalles['subtotal'], 2) . "\n");
        }
    
        fwrite($file, "Total: $" . number_format($total, 2) . "\n");
        fclose($file);
    
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        readfile($filename);
    
        unlink($filename);
    
        exit();
    }else{
        http_response_code(400);
        echo "Error: datos no válidos";
    }
}