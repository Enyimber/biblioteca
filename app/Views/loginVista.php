<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BIBLIOTECA</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('plantilla/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom styles for this template-->
    <link href="<?= base_url('plantilla/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

<div class="container-fluid vh-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-xl-6 col-lg-8 col-md-10">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">BIBLIOTECA UTS</h1>
                                </div>
                                <form class="user" method="post" action="<?= site_url('login/consultarUsuario'); ?>" id="forlogin">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="usuario" name="usuario" placeholder="Usuario" value="<?= old('usuario'); ?>" required>
                                        <?php if (isset($validation) && $validation->hasError('usuario')): ?>
                                            <div class="text-danger"><?= $validation->getError('usuario'); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="clave" name="clave" placeholder="Contraseña" required>
                                        <?php if (isset($validation) && $validation->hasError('clave')): ?>
                                            <div class="text-danger"><?= $validation->getError('clave'); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>

                                <?php if (session()->getFlashdata('error')): ?>
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: '¡Error!',
                                            text: '<?= session()->getFlashdata('error'); ?>'
                                        });
                                    </script>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('plantilla/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('plantilla/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('plantilla/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('plantilla/js/sb-admin-2.min.js'); ?>"></script>

</body>

</html>
