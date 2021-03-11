<h4 class="mt-4"><?= $titulo ?></h4>

<?php if (isset($validation)) : ?>
<div class="alert alert-danger">
    <p><?php echo $validation->listErrors(); ?></p>
</div>
<?php endif; ?>

<form action="<?= base_url(); ?>/categorias/insertar" method="post" autocomplete="off">

    <div class="form-group">
        <div class="row">

            <div class="col-12 col-sm-6">

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?= set_value('nombre') ?>"
                    placeholder="Nombre Categoría" autofocus>
            </div>

        </div>

    </div>

    <a href="<?= base_url(); ?>/categorias" class="btn btn-primary">Regresar</a>
    <button type="submit" class="btn btn-success">Guardar</button>

</form>