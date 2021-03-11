<h4 class="mt-4"><?= $titulo ?></h4>

<?php if (isset($validation)) : ?>
<div class="alert alert-danger">
    <p><?php echo $validation->listErrors(); ?></p>
</div>
<?php endif; ?>

<form action="<?= base_url() ?>/productos/actualizar" method="post" autocomplete="off">

    <input type="hidden" name="id" value="<?= set_value('id',$datos['id']) ?>">

    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-6">
                <label for="codigo">Código</label>
                <input type="text" name="codigo" id="codigo" class="form-control"
                    value="<?= set_value('codigo', $datos['codigo']) ?>" placeholder="Código Producto" autofocus
                    required>
            </div>
            <div class="col-12 col-sm-6">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                    value="<?= set_value('nombre', $datos['nombre']) ?>" placeholder="Nombre Producto" required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-6">
                <label for="id_categoria">Categoría</label>
                <select name="id_categoria" id="id_categoria" class="form-control">
                    <option value="">Seleccione Categoría</option>
                    <?php foreach ($categorias as $categoria) : ?>
                    <option value="<?= $categoria['id'] ?>"
                        <?= $datos['id_categoria'] == $categoria['id'] ? 'selected' : '' ?>><?= $categoria['nombre'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 col-sm-6">
                <label for="id_unidad">Unidad</label>
                <select name="id_unidad" id="id_unidad" class="form-control">
                    <option value="">Seleccione Unidad</option>
                    <?php foreach ($unidades as $unidad) : ?>
                    <option value="<?= $unidad['id'] ?>" <?= $datos['id_unidad'] == $unidad['id'] ? 'selected' : '' ?>>
                        <?= $unidad['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-6">
                <label for="precio_venta">Precio Venta</label>
                <input type="text" name="precio_venta" id="precio_venta" class="form-control"
                    value="<?= set_value('precio_venta', $datos['precio_venta']) ?>" placeholder="Precio Venta"
                    required>
            </div>
            <div class="col-12 col-sm-6">
                <label for="precio_compra">Precio Compra</label>
                <input type="text" name="precio_compra" id="precio_compra" class="form-control"
                    value="<?= set_value('precio_compra', $datos['precio_compra']) ?>" placeholder="Precio Compra"
                    required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-12 col-sm-6">
                <label for="existencias">Existencias</label>
                <input type="text" name="existencias" id="existencias" class="form-control"
                    value="<?= set_value('existencias', $datos['existencias']) ?>" placeholder="Existencia" required>
            </div>
            <div class="col-12 col-sm-4">
                <label for="stock_minimo">Stock Mínimo</label>
                <input type="text" name="stock_minimo" id="stock_minimo" class="form-control"
                    value="<?= set_value('stock_minimo', $datos['stock_minimo']) ?>" placeholder="Stock Mínimo"
                    required>
            </div>
            <div class="col-12 col-sm-2">
                <label for="inventariable">Inventariable?</label>
                <select name="inventariable" id="inventariable" class="form-control">
                    <option value="1" <?= $datos['inventariable'] == 1 ? 'selected' : '' ?>>Sí</option>
                    <option value="0" <?= $datos['inventariable'] == 0 ? 'selected' : '' ?>>No</option>
                </select>
            </div>
        </div>
    </div>

    <a href="<?= base_url() ?>/productos" class="btn btn-primary">Regresar</a>
    <button type="submit" class="btn btn-success">Guardar</button>

</form>