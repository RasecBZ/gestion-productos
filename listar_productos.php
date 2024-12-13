<?php
$conexion = new mysqli("localhost", "root", "", "tarea1");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$sql = "SELECT * FROM productos";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    echo '<table class="table table-bordered">';
    echo '<thead><tr><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Stock</th><th>Fecha de Creación</th><th>Acciones</th></tr></thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["nombre_producto"] . '</td>';
        echo '<td>' . $row["descripcion"] . '</td>';
        echo '<td>' . $row["precio"] . '</td>';
        echo '<td>' . $row["stock"] . '</td>';
        echo '<td>' . $row["fecha_creacion"] . '</td>';
        echo '<td>
                <button class="btn btn-warning btn-sm edit-btn" data-id="' . $row["producto_id"] . '">Editar</button>
                <button class="btn btn-danger btn-sm delete-btn" data-id="' . $row["producto_id"] . '">Eliminar</button>
              </td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo "No se encontraron productos.";
}

$conexion->close();
?>

<!-- Modal para Editar Producto -->
<div class="modal" tabindex="-1" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <input type="hidden" id="product_id" name="product_id">
          <div class="mb-3">
            <label for="edit_nombre_producto" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="edit_nombre_producto" name="nombre_producto" required>
          </div>
          <div class="mb-3">
            <label for="edit_descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="edit_descripcion" name="descripcion" required>
          </div>
          <div class="mb-3">
            <label for="edit_precio" class="form-label">Precio</label>
            <input type="text" class="form-control" id="edit_precio" name="precio" required>
          </div>
          <div class="mb-3">
            <label for="edit_stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="edit_stock" name="stock" required>
          </div>
          <div class="mb-3">
            <label for="edit_fecha_creacion" class="form-label">Fecha de Creación</label>
            <input type="datetime-local" class="form-control" id="edit_fecha_creacion" name="fecha_creacion" required>
          </div>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script para Editar Producto -->
<script>
$(document).ready(function() {
    // Editar producto
    $(".edit-btn").click(function() {
        var productId = $(this).data('id');
        $.ajax({
            url: 'obtener_producto.php',
            type: 'GET',
            data: { id: productId },
            success: function(response) {
                var product = JSON.parse(response);
                $('#edit_nombre_producto').val(product.nombre_producto);
                $('#edit_descripcion').val(product.descripcion);
                $('#edit_precio').val(product.precio);
                $('#edit_stock').val(product.stock);
                $('#edit_fecha_creacion').val(product.fecha_creacion);
                $('#product_id').val(product.producto_id);
                $('#editModal').modal('show'); // Mostrar el modal para editar
            }
        });
    });

    // Enviar el formulario de edición
    $("#editForm").submit(function(e) {
        e.preventDefault(); // Evitar el envío normal del formulario

        var formData = $(this).serialize(); // Obtener los datos del formulario

        $.ajax({
            url: 'editar_producto.php', // Archivo PHP para procesar la edición
            type: 'POST',
            data: formData,
            success: function(response) {
                alert("Producto actualizado con éxito!");
                location.reload(); // Recargar la página para ver los cambios
            }
        });
    });

    // Eliminar producto
    $(".delete-btn").click(function() {
        var productId = $(this).data('id');
        var confirmDelete = confirm("¿Estás seguro de que deseas eliminar este producto?");
        if (confirmDelete) {
            $.ajax({
                url: 'eliminar_producto.php',
                type: 'POST',
                data: { id: productId },
                success: function(response) {
                    alert("Producto eliminado con éxito!");
                    location.reload(); // Recargar la página para ver los cambios
                }
            });
        }
    });
});
</script>

<!-- Incluir Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
