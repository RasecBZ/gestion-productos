<?php
$conexion = new mysqli("localhost", "root", "", "tarea1");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $producto_id = $_POST['product_id'];
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $fecha_creacion = $_POST['fecha_creacion'];

    // Actualizar el producto en la base de datos
    $sql = "UPDATE productos 
            SET nombre_producto = '$nombre_producto', descripcion = '$descripcion', precio = '$precio', 
                stock = '$stock', fecha_creacion = '$fecha_creacion' 
            WHERE producto_id = $producto_id";

    if ($conexion->query($sql) === TRUE) {
        echo "Producto actualizado con éxito";
    } else {
        echo "Error al actualizar el producto: " . $conexion->error;
    }
}

$conexion->close();
?>
