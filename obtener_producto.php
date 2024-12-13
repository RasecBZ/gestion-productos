<?php
$conexion = new mysqli("localhost", "root", "", "tarea1");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];

    $sql = "SELECT * FROM productos WHERE producto_id = $producto_id";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
        echo json_encode($producto); // Devolver el producto en formato JSON
    } else {
        echo json_encode(["error" => "Producto no encontrado"]);
    }
}

$conexion->close();
?>
