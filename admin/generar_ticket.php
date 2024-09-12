<?php
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if(isset($data['cart']) && !empty($data['cart'])) {
    $cart = $data['cart'];

    $ticketContent = "Ticket de venta\n";
    $ticketContent .= "-----------------------------\n";

    $total = 0;
    foreach($cart as $producto => $detalles){
        $cantidad = $detalles['cantidad'];
        $subtotal = $detalles['subtotal'];
        $ticketContent .= "Producto: {$producto}\n";
        $ticketContent .= "Cantidad: {$cantidad}\n";
        $ticketContent .= "Subtotal: $" . number_format($subtotal, 2) . "\n";
        $ticketContent .= "---------------------------\n";
        $total += $subtotal;
    }

    $ticketContent .= "Total: $" . number_format($total,2) ."\n";
    $ticketContent .= "Gracias por su compra";

	$ticketDir = "tickets";
	if(!is_dir($ticketDir)){
    	mkdir($ticketDir, 0755, true);
    }

    $ticketFile = 'ticket_' . date('Ymd_His') . '.txt';

    file_put_contents("$ticketDir/$ticketFile", $ticketContent);

    echo $ticketFile;
	error_log(print_r($data, true));
}else{
    echo 'No se recibieron datos';
}