<?php
include "../src/js/config.php";

if(isset($_GET['q'])){
	$query = mysqli_real_escape_string($conn, $_GET['q']);
	$userId = $_SESSION['user_id'];

	$sql = "SELECT producto, precio FROM productos WHERE user_id = '$userId' AND producto LIKE '%query%'";
    $result = mysqli_query($conn, $sql);

    $productos = [];
    while ($row = mysqli_fetch_assoc($result)){
        $productos[] = $row;
    }
    echo json_encode($productos);
}