<h4 class="mt-4"><?= $titulo ?></h4>

<?php if (isset($validation)) : ?>
<div class="alert alert-danger">
    <p><?php echo $validation->listErrors(); ?></p>
</div>
<?php endif; ?>

<form action="<?= base_url(); ?>/configuracion/actualizar" method="post" autocomplete="off">

    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-6">
                <label for="tienda_nombre">Nombre de la Tienda</label>
                <input type="text" name="tienda_nombre" id="tienda_nombre"
                    value="<?= set_value('tienda_nombre', $tienda_nombre) ?>" class="form-control" autofocus required>
            </div>
            <div class="col-12 col-sm-6">
                <label for="tienda_rif">RIF de la Tienda</label>
                <input type="text" name="tienda_rif" id="tienda_rif" value="<?= set_value('tienda_rif', $tienda_rif) ?>"
                    class="form-control" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-6">
                <label for="tienda_telefono">Teléfono de la Tienda</label>
                <input type="text" name="tienda_telefono" id="tienda_telefono"
                    value="<?= set_value('tienda_telefono', $tienda_telefono) ?>" class="form-control" required>
            </div>
            <div class="col-12 col-sm-6">
                <label for="tienda_correo">Correo de la Tienda</label>
                <input type="text" name="tienda_correo" id="tienda_correo"
                    value="<?= set_value('tienda_correo', $tienda_correo) ?>" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-6">
                <label for="tienda_direccion">Dirección</label>
                <textarea name="tienda_direccion" id="tienda_direccion" class="form-control"
                    required><?= set_value('tienda_direccion', $tienda_direccion) ?></textarea>
            </div>
            <div class="col-12 col-sm-6">
                <label for="ticket_leyenda">Leyenda Ticket</label>
                <textarea name="ticket_leyenda" id="ticket_leyenda" class="form-control"
                    required><?= set_value('ticket_leyenda', $ticket_leyenda) ?></textarea>
            </div>
        </div>
    </div>

    <a href="<?= base_url(); ?>/configuracion" class="btn btn-primary">Regresar</a>
    <button type="submit" class="btn btn-success">Guardar</button>

</form>