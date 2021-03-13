<?php $id_compra = uniqid(); ?>

<form id="form_compra" name="form_compra" action="<?= base_url();?>/compras/guarda" method="POST" autocomplete="off">
    <div class="form-group mt-3">
        <div class="row">
            <div class="col-12 col-sm-4">
                <input type="hidden" id="id_producto" name="id_producto">
                <input type="hidden" id="id_compra" name="id_compra" value="<?= $id_compra ?>">
                <label for="codigo">Código</label>
                <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Escribe el código"
                    onkeyup="buscarProducto(event, this, this.value)" autofocus>
                <label for="codigo" id="resultado_error" style="color: red;"></label>
            </div>
            <div class="col-12 col-sm-4">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" name="nombre" id="nombre" class="form-control" disabled>
            </div>
            <div class="col-12 col-sm-4">
                <label for="cantidad">Cantidad</label>
                <input type="text" name="cantidad" id="cantidad" class="form-control" onkeyup="calculo_subtotal(event)">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-4">
                <label for="precio_compra">Precio Compra</label>
                <input type="text" name="precio_compra" id="precio_compra" class="form-control" disabled>
            </div>
            <div class="col-12 col-sm-4">
                <label for="subtotal">Subtotal</label>
                <input type="text" name="subtotal" id="subtotal" class="form-control" disabled>
            </div>
            <div class="col-12 col-sm-4 d-flex align-items-end">
                <button type="button" class="btn btn-primary"
                    onclick="agregarProducto(id_producto.value, cantidad.value, '<?= $id_compra ?>')">Agregar
                    Producto</button>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <table id="tablaProductos" class="table table-responsive table-hover table-sm table-striped tablaProductos">
                <thead class="thead-dark">
                    <th>#</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th width="1%"></th>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6 offset-md-6">
                <label style="font-weight: bold; font-size: 30px; text-align: center;">Total $</label>
                <input type="text" id="total" name="total" size="7"
                    style="margin-left: 10px; font-weight: bold; font-size: 30px; text-align: center;" value="0.00"
                    readonly>
                <button type="button" id="completa_compra" class="btn btn-success">Completar compra</button>
            </div>
        </div>

    </div>
</form>


<script>
$(document).ready(function() {
    $(window).keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    $('#completa_compra').click(function() {

        let nFila = $('#tablaProductos tr').length;

        if (nFila > 1) {

            $('#form_compra').submit();

        }

    });

});


function calculo_subtotal(e) {
    var enterKey = 13;
    if (e.which == enterKey) {
        var resultado = 0;
        var cantidad = $('#cantidad').val();
        var precio = $('#precio_compra').val();
        resultado = cantidad * precio;
        $('#subtotal').val(resultado);
    }
}

function buscarProducto(e, tagCodigo, codigo) {

    var enterKey = 13;

    if (codigo != '') {
        if (e.which == enterKey) {
            $.ajax({
                url: '<?= base_url() ?>/productos/buscarPorCodigo/' + codigo,
                dataType: 'json',
                success: function(resultado) {

                    if (resultado == 0) {

                        $(tagCodigo).val('');

                    } else {

                        $('#resultado_error').html(resultado.error);

                        if (resultado.existe) {
                            $('#id_producto').val(resultado.datos.id);
                            $('#nombre').val(resultado.datos.nombre);
                            $('#cantidad').val(1);
                            $('#precio_compra').val(resultado.datos.precio_compra);
                            $('#subtotal').val(resultado.datos.precio_compra);
                            $('#cantidad').focus();
                        } else {
                            $('#id_producto').val('');
                            $('#nombre').val('');
                            $('#cantidad').val('');
                            $('#precio_compra').val('');
                            $('#subtotal').val('');
                        }
                    }
                },
            });
        }
    }
};

function agregarProducto(id_producto, cantidad, id_compra) {
    if (id_producto != null && id_producto != 0 && cantidad > 0) {
        $.ajax({
            url: '<?= base_url() ?>/TemporalCompra/inserta/' + id_producto + '/' + cantidad + '/' + id_compra,
            success: function(resultado) {

                if (resultado == 0) {

                } else {

                    var resultado = JSON.parse(resultado);

                    if (resultado.error == '') {
                        $('#tablaProductos tbody').empty();
                        $('#tablaProductos tbody').append(resultado.datos);
                        $('#total').val(resultado.total);
                        $('#id_producto').val('');
                        $('#nombre').val('');
                        $('#cantidad').val('');
                        $('#precio_compra').val('');
                        $('#subtotal').val('');
                        $('#codigo').val('');
                    }
                }
            },
        });
    };
};

function eliminaProducto(id_producto, id_compra) {

    $.ajax({
        url: '<?= base_url() ?>/TemporalCompra/eliminar/' + id_producto + '/' + id_compra,
        success: function(resultado) {

            if (resultado == 0) {

            } else {

                var resultado = JSON.parse(resultado);

                if (resultado.error == '') {
                    $('#tablaProductos tbody').empty();
                    $('#tablaProductos tbody').append(resultado.datos);
                    $('#total').val(resultado.total);

                }
            }
        },
    });

};
</script>