<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>administración</title>
</head>
<body>
<?php
    include "./config.php";

    if(isset($_GET['producto'])){
	    $query = mysqli_real_escape_string($conn, $_GET['producto']);
	    //$userId = $_POST['usuario'];

	    $sql = "SELECT * FROM productos";
        $result = mysqli_query($conn, $sql);

        $productos = [];
        while ($row = mysqli_fetch_assoc($result)){
            $productos[] = $row;
        }
        echo json_encode($productos);
    }
?>
</body>
</html>