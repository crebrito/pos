<h4 class="mt-4"><?= $titulo ?></h4>

<?php if (isset($validation)) : ?>
<div class="alert alert-danger">
    <p><?php echo $validation->listErrors(); ?></p>
</div>
<?php endif; ?>

<form action="<?= base_url(); ?>/usuarios/actualizar" method="post" autocomplete="off">

    <input type="hidden" name="id" value="<?= set_value('id',$datos['id']) ?>">

    <div class="form-group">
        <div class="row">

            <div class="col-12 col-sm-6">

                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario"
                    value="<?= set_value('usuario',$datos['usuario']) ?>" autofocus required>
            </div>

            <div class="col-12 col-sm-6">

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre"
                    value="<?= set_value('nombre',$datos['nombre']) ?>" autofocus required>
            </div>
        </div>

    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-6">

                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña"
                    value="<?= set_value('password',$datos['password']) ?>" required>
            </div>

            <div class="col-12 col-sm-6">

                <label for="repassword">Repetir Contraseña</label>
                <input type="password" name="repassword" id="repassword" class="form-control"
                    placeholder="Repetir Contraseña" value="<?= set_value('repassword',$datos['password']) ?>" required>
            </div>

        </div>

    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-6">
                <label for="id_caja">Caja</label>
                <select name="id_caja" id="id_caja" class="form-control">
                    <option value="">Seleccione Caja</option>
                    <?php foreach ($cajas as $caja) : ?>
                        <option value="<?= $caja['id'] ?>"
                        <?= $datos['id_caja'] == $caja['id'] ? 'selected' : '' ?>><?= $caja['nombre'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 col-sm-6">
                <label for="id_rol">Rol</label>
                <select name="id_rol" id="id_rol" class="form-control">
                    <option value="">Seleccione Rol</option>
                    <?php foreach ($roles as $rol) : ?>
                        <option value="<?= $rol['id'] ?>"
                        <?= $datos['id_rol'] == $rol['id'] ? 'selected' : '' ?>><?= $rol['nombre'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <a href="<?= base_url(); ?>/usuarios" class="btn btn-primary">Regresar</a>
    <button type="submit" class="btn btn-success">Guardar</button>

</form>