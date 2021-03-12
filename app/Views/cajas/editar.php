<h4 class="mt-4"><?= $titulo ?></h4>

<?php if (isset($validation)) : ?>
<div class="alert alert-danger">
    <p><?php echo $validation->listErrors(); ?></p>
</div>
<?php endif; ?>

<form action="<?= base_url(); ?>/cajas/actualizar" method="post" autocomplete="off">

    <input type="hidden" name="id" value="<?= set_value('id',$datos['id']) ?>">

    <div class="form-group">
        <div class="row">

            <div class="col-12 col-sm-6">

                <label for="numero_caja">Número Caja</label>
                <input type="text" name="numero_caja" id="numero_caja" placeholder="Número Caja"
                    value="<?= set_value('numero_caja',$datos['numero_caja'])?>" class="form-control" autofocus required>
            </div>

            <div class="col-12 col-sm-6">

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre Caja"
                    value="<?= set_value('nombre',$datos['nombre'])?>" required>
            </div>

            <div class="col-12 col-sm-6">

                <label for="folio">Nombre Corto</label>
                <input type="text" name="folio" id="folio" placeholder="Folio"
                    value="<?= set_value('folio',$datos['folio'])?>" class="form-control" required>
            </div>

        </div>

    </div>

    <a href="<?= base_url(); ?>/cajas" class="btn btn-primary">Regresar</a>
    <button type="submit" class="btn btn-success">Guardar</button>

</form>