<body class="bg-color">
    <?php
    // echo $encriptar;
    ?>
    <!-- Begin page -->
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="col-8"> <!-- Mantener el ancho deseado aquí -->
                    <div class="p-0">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-12 d-flex flex-column justify-content-center align-items-center">
                                <div class="text-center mb-4 mt-5">
                                    <img src="<?php echo $url; ?>vistas/assets/img/logo.png" alt="" style="width: 100%; max-width: 400px;">
                                </div>
                                <div class="auth-title-section mb-3 text-center">
                                    <h3 class="text-dark fs-20 fw-medium mb-2">Inicio del sistema</h3>
                                    <p class="text-dark text-capitalize fs-14 mb-0">Ingrese sus datos</p>
                                </div>
                                <form method="POST" class="my-4 w-50">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" type="email" id="email" name="email" required="" placeholder="Ingrese su email">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input class="form-control" type="password" required="" id="password" name="password" placeholder="Ingrese su password">
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary" type="submit"> Ingresar </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $ingreso = new ControladorUsuarios();
                                    $ingreso->ctrIngresoUsuario();
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END wrapper -->
</body>