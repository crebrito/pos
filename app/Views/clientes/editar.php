<h4 class="mt-4"><?= $titulo ?></h4>

<?php if (isset($validation)) : ?>
<div class="alert alert-danger">
    <p><?php echo $validation->listErrors(); ?></p>
</div>
<?php endif; ?>

<form action="<?= base_url() ?>/clientes/actualizar" method="post" autocomplete="off">

    <input type="hidden" name="id" value="<?= set_value('id', $datos['id']) ?>">

    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-6">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                    value="<?= set_value('nombre', $datos['nombre']) ?>" placeholder="Nombre Cliente" required>
            </div>
            <div class="col-12 col-sm-6">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control"
                    value="<?= set_value('direccion', $datos['direccion']) ?>" placeholder="Dirección">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-6">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control"
                    value="<?= set_value('telefono', $datos['telefono']) ?>" placeholder="Teléfono">
            </div>
            <div class="col-12 col-sm-6">
                <label for="correo">Correo</label>
                <input type="text" name="correo" id="correo" class="form-control"
                    value="<?= set_value('correo', $datos['correo']) ?>" placeholder="Correo">
            </div>
        </div>
    </div>

    <a href="<?= base_url() ?>/clientes" class="btn btn-primary">Regresar</a>
    <button type="submit" class="btn btn-success">Guardar</button>

</form>