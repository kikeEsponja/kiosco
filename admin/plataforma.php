<?php 
	session_start();
	if(isset($_SESSION['usuario']) && isset($_SESSION['user_id'])){
	include "../src/js/config.php";

    $userId = $_SESSION['user_id'];

    $query = "SELECT * FROM productos WHERE user_id = '$userId'";
    $result = mysqli_query($conn, $query);
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
    <header>
        <h1>Gestión de Inventario</h1>
        <h2>Bienvenido: <span><?php echo $_SESSION['usuario']; ?></span></h2>
    </header>
    <main>
        <section id="inventario">
            <h2>Inventario</h2>
            <div>
                <input type="text" id="filtro" name="filtro" placeholder="buscar productos">
                <ul id="lista"></ul>
            </div>
            <ul id="product-list">
                <?php
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $precioAumento = $row['precio'] * 0.30 + $row['precio'];
                            echo "<li class='product-item' data-producto='" . $row['producto'] . "'>Producto: " . $row['producto'] . "| Precio: $" . number_format($precioAumento, 2) . " | Cantidad: " . $row['cantidad'] . "</li>";
                            echo "<button class='add product-item' data-producto='" . $row['producto'] . "' data-precio='" . $precioAumento . "' data-cantidad='" . $row['cantidad'] . "' onclick=\"addToCart(this)\">agregar</button>";
                            echo "<button class='quitar product-item' data-producto='" . $row['producto'] . "' data-precio='" . $precioAumento . "' onclick=\"removeFromCart(this)\">quitar</button>";
                        }
                    }else{
                        echo "<p>No hay productos en inventario</p>";
                    }
                ?>
            </ul>
            <!--<div id="pag-control">
                <button id="prev" disabled>Anterior</button>
                <span id="page-info"></span>
                <button id="next">Siguiente</button>
            </div>-->
            <button type="button" id="adm" onclick="irAdm()">ir a administración</button>
            <div>
			<div class="bg-dark sigonosigo" id="confirma" style="display:none;">
            	<h4 class="bad">Estás seguro que deseas salir?</h4>
                	<button class="btn btn-danger" id="si">Sí</button>
                    <br>
                    <button class="btn btn-info" id="no">No</button>
			</div>
          	<div>
            	<div class="bg-warning seguirjugando" id="excelente" style="display:none;">continuemos</div>
            </div>
			<div class="botones">
                <button class="bg-warning text-dark" id="cerrarSes">cerrar sesión</button><br>
            </div>
        </section>
        <section id="cart">
            <h2>Carrito <span class="carrito-tlf">de Compras</span></h2>
            <?php
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $productosVendidos = $_POST['productos'];
                    foreach($productosVendidos as $producto => $detalles){
                        $cantidadVendida = $detalles['cantidad'];
                        $sql = "UPDATE productos SET cantidad = cantidad - $cantidadVendida WHERE producto = '$producto' AND user_id = '$user_id'";
                        mysqli_query($conn, $sql);
                    }
                    echo "<h3>venta realizada con éxito</h3>";
                }
            ?>
            <ul id="cart-list"></ul>
            <div id="total">
                Total: $<span id="total-amount">0.00</span>
            </div>
            <button type="button" id="checkout-button">Realizar Venta</button>
            <h4><span id="fin"></span></h4>
            <?php
            include './gentick.php';
            ?>
        </section>
    </main>
    <script>
        let cart = {};
        let totalAmount = 0;

        function addToCart(button){
            const product = button.getAttribute('data-producto');
            const price =parseFloat(button.getAttribute('data-precio'));
            const availableQuantity =parseInt(button.getAttribute('data-cantidad'));

            if(!cart[product]){
                cart[product] = {
                    cantidad: 1,
                    subtotal: price
                };
            }else{
                if(cart[product].cantidad < availableQuantity){
                    cart[product].cantidad++;
                    cart[product].subtotal += price;
                }else{
                    alert("cantidad disponible: " + availableQuantity + " unidades");
                }
            }
            totalAmount += price;
            updateCart();
        }

        function removeFromCart(button){
            const product = button.getAttribute('data-producto');
            const price =parseFloat(button.getAttribute('data-precio'));

            if(cart[product]){
                cart[product].cantidad--;
                cart[product].subtotal -= price;
                totalAmount -= price;

                if(cart[product].cantidad <= 0){
                    delete cart[product];
                }
                updateCart();
            }
        }

        function updateCart(){
            const cartList = document.getElementById('cart-list');
            cartList.innerHTML = '';
            totalAmount = 0;

            for(let product in cart){
                cartList.innerHTML += `<li>${product}: ${cart[product].cantidad} unidades - $${cart[product].subtotal.toFixed(2)}</li>`;
                totalAmount += cart[product].subtotal;
            }
            document.getElementById('total-amount').textContent = totalAmount.toFixed(2);
        }

        document.getElementById('checkout-button').addEventListener('click', function(){
            let resultado =document.getElementById('fin');
            resultado.textContent = 'venta realizada por $ '+totalAmount.toFixed(2);
            console.log('vamos por acá');

            fetch('./venta.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    cart: cart,
                    total:totalAmount
                })
            }).then(response => {
                console.log('se imprime?');
                if(response.ok){
                    return response.text().then(text =>{
                        console.log('continuamos', text);
                        return JSON.parse(text);
                    });
                }else{
                    throw new Error('Error al realizar la venta');
                }
            }).then(data =>{
                if(data.success){
                    return fetch('./gentick.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            cart: cart,
                            total:totalAmount
                        })
                    });
                }else{
                    throw new Error('Error en el proceso de venta');
                }
            }).then(response =>{
                if(response.ok){
                    return response.blob();
                }else{
                    throw new Error('Error al generar ticket');
                }
            }).then(blob=>{
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'ticket.txt';
                document.body.appendChild(a);
                a.click();
                a.remove();

                cart = {};
                totalAmount = 0;
                resultado.textContent = '';
                updateCart();
                
                location.reload();
            }).catch(error => console.error('Error:', error));
        });

        document.getElementById('filtro').addEventListener('input', function(){
            const query = this.value;
            const productos = document.querySelectorAll('.product-item');

            productos.forEach(producto =>{
                const nombreProducto = producto.getAttribute('data-producto').toLowerCase();

                if(nombreProducto.includes(query)){
                    producto.style.display = '';
                }else{
                    producto.style.display = 'none';
                }
            });
        });
    
        var botonCerrar = document.getElementById("cerrarSes");
        var confText = document.getElementById("confirma");
        var yes = document.getElementById("si");
        var nain = document.getElementById("no");
        var excelente = document.getElementById("excelente");
        botonCerrar.addEventListener("click", function(){
            confText.style.display = "flex";
        });
        yes.addEventListener("click", function(){
            window.location.href = "../index.php";
        });
        no.addEventListener("click", function(){
            excelente.style.display = "block";
            confText.style.display = "none";
            setTimeout(function(){
                excelente.style.display = "none";
            }, 2000);
        });
    </script>
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