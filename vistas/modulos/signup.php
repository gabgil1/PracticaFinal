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
                                    <h3 class="text-dark fs-20 fw-medium mb-2">Registro</h3>
                                    <p class="text-dark text-capitalize fs-14 mb-0">Ingrese sus datos</p>
                                </div>
                                <form id='login' method="POST" class="my-4 w-50" type="">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" type="email" id="email" name="email" required="" placeholder="Ingrese su email">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="usuario" class="form-label">usuario</label>
                                        <input class="form-control" type="text" id="usuario" name="usuario" required="" placeholder="usuario">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input class="form-control" type="text" id="nombre" name="nombre" required="" placeholder="nombre">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="apellido" class="form-label">Apellido</label>
                                        <input class="form-control" type="text" id="apellido" name="apellido" required="" placeholder="apellido">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="contra" class="form-label">Contraseña</label>
                                        <input class="form-control" type="password" required="" id="contra" name="contra" placeholder="Ingrese su password">
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary" type="submit"> Registrar </button>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <?php
                                    $registro = new ControladorUsuarios();
                                    $registro->ctrRegistrarUsuario();
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