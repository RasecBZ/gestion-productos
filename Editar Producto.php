$(document).ready(function() {
    // Función para editar
    $(".edit-btn").click(function() {
        var producto_id = $(this).data("id");
        
        // Hacer una solicitud Ajax para obtener los detalles del producto
        $.ajax({
            url: "obtener_producto.php", // Archivo PHP para obtener el producto
            method: "POST",
            data: { producto_id: producto_id },
            dataType: "json",
            success: function(response) {
                // Llenar el formulario con los datos del producto
                $("#nombre_producto").val(response.nombre_producto);
                $("#descripcion").val(response.descripcion);
                $("#precio").val(response.precio);
                $("#stock").val(response.stock);
                $("#fecha_creacion").val(response.fecha_creacion);
                
                // Mostrar el formulario de edición (si tienes uno oculto)
                $("#form_editar").show();
                $("#form_guardar").hide(); // Si tienes un formulario de guardar, lo ocultamos
            }
        });
    });
});
