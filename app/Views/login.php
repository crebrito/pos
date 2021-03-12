<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>POS CDP</title>
    <link href="<?= base_url() ?>/assets/css/styles.css" rel="stylesheet" />
    <script src="<?= base_url() ?>/assets/js/all.min.js"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Iniciar Sesión</h3>
                                </div>
                                <?php if (isset($validation)) : ?>
                                <div class="alert alert-danger">
                                    <p><?php echo $validation->listErrors(); ?></p>
                                </div>
                                <?php endif; ?>
                                <?php if (isset($error)) : ?>
                                <div class="alert alert-danger">
                                    <p><?php echo $error; ?></p>
                                </div>
                                <?php endif; ?>
                                <div class="card-body">
                                    <form method="POST" action="<?= base_url() ?>/usuarios/valida">
                                        <div class="form-group">
                                            <label class="small mb-1" for="usuario">Nombre de Usuario</label>
                                            <input class="form-control py-4" id="usuario" name="usuario" type="text"
                                                placeholder="Ingrase su Usuario" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="password">Contraseña</label>
                                            <input class="form-control py-4" id="password" name="password" type="password"
                                                placeholder="Ingrese Contraseña" />
                                        </div>
                                        <div
                                            class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="<?= base_url() ?>/assets/js/jquery-3.5.1.slim.min.js"></script>
        <script src="<?= base_url() ?>/assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>/assets/js/scripts.js"></script>
</body>

</html>