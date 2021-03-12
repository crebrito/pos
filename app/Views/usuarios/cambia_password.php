<h4 class="mt-4"><?= $titulo ?></h4>

<?php if (isset($validation)) : ?>
<div class="alert alert-danger">
    <p><?php echo $validation->listErrors(); ?></p>
</div>
<?php endif; ?>

<?php if (isset($mensaje)) : ?>
<div class="alert alert-success">
    <?php echo $mensaje; ?>
</div>
<?php endif; ?>

<form action="<?= base_url(); ?>/usuarios/actualiza_password" method="post" autocomplete="off">

    <div class="form-group">
        <div class="row">

            <div class="col-12 col-sm-6">

                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario"
                    value="<?= set_value('usuario') ?>" disabled>
            </div>

            <div class="col-12 col-sm-6">

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre"
                    value="<?= set_value('nombre') ?>" disabled>
            </div>
        </div>

    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-6">

                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña"
                    autofocus required>
            </div>

            <div class="col-12 col-sm-6">

                <label for="repassword">Repetir Contraseña</label>
                <input type="password" name="repassword" id="repassword" class="form-control"
                    placeholder="Repetir Contraseña" required>
            </div>

        </div>

    </div>

    <a href="<?= base_url(); ?>/configuracion" class="btn btn-primary">Regresar</a>
    <button type="submit" class="btn btn-success">Guardar</button>

</form>