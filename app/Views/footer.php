</div> <!-- container-fluid -->
</main>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; BP Soluciones <?= date('Y'); ?></div>
            <div>
                <a href="https://www.bpsoluciones.com.ve" target="_blank">Website</a>
            </div>
        </div>
    </div>
</footer>
</div> <!-- layoutSidenav_content-->
</div> <!-- layoutSidenav -->

<script src="<?= base_url() ?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>/assets/js/scripts.js"></script>
<script src="<?= base_url() ?>/assets/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/js/datatables-demo.js"></script>

<script>

    $('#modal-confirma').on('show.bs.modal', function(e){
        $(this).find('.btn-ok').attr('href',$(e.relatedTarget).data('href'));
    });

</script>

</body>
</html>