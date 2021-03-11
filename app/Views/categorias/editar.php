<h4 class="mt-4"><?= $titulo ?></h4>

<?php if (isset($validation)) : ?>
<div class="alert alert-danger">
    <p><?php echo $validation->listErrors(); ?></p>
</div>
<?php endif; ?>

<form action="<?= base_url(); ?>/categorias/actualizar" method="post" autocomplete="off">

    <input type="hidden" name="id" value="<?= set_value('id',$datos['id']) ?>">

    <div class="form-group">
        <div class="row">

            <div class="col-12 col-sm-6">

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre Unidad" 
                    value="<?= set_value('nombre',$datos['nombre'])?>" autofocus required>
            </div>

        </div>

    </div>

    <a href="<?= base_url(); ?>/categorias" class="btn btn-primary">Regresar</a>
    <button type="submit" class="btn btn-success">Guardar</button>

</form>