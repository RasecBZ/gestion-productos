<?php
$conexion = new mysqli("localhost", "root", "", "tarea1");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if (isset($_POST['id'])) {
    $producto_id = $_POST['id'];

    $sql = "DELETE FROM productos WHERE producto_id = $producto_id";

    if ($conexion->query($sql) === TRUE) {
        echo "Producto eliminado con éxito";
    } else {
        echo "Error al eliminar el producto: " . $conexion->error;
    }
}

$conexion->close();
?>
