<h4 class="mt-4"><?= $titulo ?></h4>
<div>
    <p>
        <a href="<?= base_url(); ?>/cajas" class="btn btn-warning">Cajas</a>
    </p>
</div>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Número Caja</th>
                <th>Nombre</th>
                <th>Folio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $dato) : ?>
                <tr>
                    <td><?= $dato['id'] ?></td>
                    <td><?= $dato['numero_caja'] ?></td>
                    <td><?= $dato['nombre'] ?></td>
                    <td><?= $dato['folio'] ?></td>
                    <td><a data-href="<?= base_url(); ?>/cajas/reingresar/<?= $dato['id'] ?>" data-toggle="modal" data-target="#modal-confirma" data-placement="top" href="#"><i class="fas fa-arrow-alt-circle-up"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reingresar registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Desea reingresar el registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
        <a class="btn btn-danger btn-ok">Sí</a>
      </div>
    </div>
  </div>
</div>