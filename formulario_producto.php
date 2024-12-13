<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Producto</title>

    <!-- Incluir Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-5">
        <h2>Formulario para Guardar Producto</h2>
        <form action="guardar_producto.php" method="POST">
            <div class="mb-3">
                <label for="nombre_producto" class="form-label">Nombre del Producto:</label>
                <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="text" class="form-control" id="precio" name="precio" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock:</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>

            <div class="mb-3">
                <label for="fecha_creacion" class="form-label">Fecha de Creación:</label>
                <input type="datetime-local" class="form-control" id="fecha_creacion" name="fecha_creacion" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Producto</button>
        </form>

        <hr>
        <h2>Lista de Productos</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaProductos">
                <!-- Los datos se cargarán aquí con AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Incluir Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
