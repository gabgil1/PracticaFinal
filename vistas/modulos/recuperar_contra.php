<body class="bg-color">
    <?php

    $class = '';
    $Titulo = 'Ingrese su Email';
    $usuarioEncontrado = false;
    $codigoEnviado = 0; // Código generado y enviado al email.
    $codigoValidado = false; // Bandera para saber si el código fue validado.
    $mensaje = '';

    // Procesar el formulario de email.
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $usuario = ControladorUsuarios::ctrBuscarMail($email);

        if ($usuario) {
            $usuarioEncontrado = true;
            $_SESSION['email'] = $email; // Almacena el email en sesión
            $_SESSION['codigoEnviado'] = ControladorUsuarios::ctrGenerarCodigo(); // Almacena el código en sesión
            $enviar = ControladorUsuarios::ctrEnviarCodigo($email, $_SESSION['codigoEnviado']);
            $Titulo = 'Ingrese el Código de Verificación';
        } else {
            $mensaje = 'No se encontró un usuario con ese email.';
        }
    }

    // Procesar el formulario de verificación de código.
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo"])) {
        $codigoIngresado = filter_var($_POST["codigo"], FILTER_SANITIZE_NUMBER_INT);

        if (isset($_SESSION['codigoEnviado']) && $codigoIngresado == $_SESSION['codigoEnviado']) {
            $codigoValidado = true;
            $Titulo = 'Ingrese su Nueva Contraseña';
        } else {
            $mensaje = '<div class="alert alert-danger">El código ingresado es incorrecto.</div>';
        }
    }

    // Procesar el formulario para la nueva contraseña.
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nueva_contrasena"])) {
        $nuevaContrasena = filter_var($_POST["nueva_contrasena"], FILTER_SANITIZE_STRING);
        $nuevaContrasena2 = filter_var($_POST["nueva_contrasena2"], FILTER_SANITIZE_STRING);

        if ($nuevaContrasena == $nuevaContrasena2){ 
            $actualizacion = ControladorUsuarios::ctrActualizarContrasena($_SESSION['email'], $nuevaContrasena);
            if ($actualizacion) {
                $mensaje = '<div class="alert alert-success">Contraseña actualizada correctamente.</div>';
                session_destroy();
                echo '<script>
                    window.location.href = "' . ControladorPlantilla::url() . 'login";
                </script>'; 
            } else {
                $mensaje = '<div class="alert alert-danger">Error al actualizar la contraseña.</div>';
            }
        }

        if ($actualizacion) {
            $mensaje = '<div class="alert alert-success">Contraseña actualizada correctamente.</div>';
        } else {
            $mensaje = '<div class="alert alert-danger">Error al actualizar la contraseña.</div>';
        }
    }
    ?>

    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="col-8">
                    <div class="p-0">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-12 d-flex flex-column justify-content-center align-items-center">
                                <div class="text-center mb-4 mt-5">
                                    <img src="<?php echo $url; ?>vistas/assets/img/logo.png" alt="" style="width: 100%; max-width: 400px;">
                                </div>
                                <div class="auth-title-section mb-3 text-center">
                                    <h3 class="text-dark fs-20 fw-medium mb-2">Inicio del sistema</h3>
                                    <p class="text-dark text-capitalize fs-14 mb-0"><?php echo $Titulo; ?></p>
                                </div>

                                <!-- Mostrar mensajes -->
                                <?php if (!empty($mensaje)): ?>
                                    <div><?php echo $mensaje; ?></div>
                                <?php endif; ?>

                                <!-- Formulario para buscar email -->
                                <form id="email-form" method="POST" class="my-4 w-50" <?php if ($usuarioEncontrado || $codigoValidado) echo 'style="display: none;"'; ?>>
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" type="email" id="email" name="email" required placeholder="Ingrese su email">
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary" type="submit">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- Formulario para ingresar el código -->
                                <form id="code-form" method="POST" class="my-4 w-50" <?php if (!$usuarioEncontrado || $codigoValidado) echo 'style="display: none;"'; ?>>
                                    <div class="form-group mb-3">
                                        <label for="codigo" class="form-label">Código de Verificación</label>
                                        <input class="form-control" type="text" id="codigo" name="codigo" required placeholder="Ingrese el código enviado a su email">
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary" type="submit">Verificar Código</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- Formulario para ingresar la nueva contraseña -->
                                <form id="password-form" method="POST" class="my-4 w-50" <?php if (!$codigoValidado) echo 'style="display: none;"'; ?>>
                                    <div class="form-group mb-3">
                                        <label for="nueva_contrasena" class="form-label">Nueva Contraseña</label>
                                        <input class="form-control" type="password" id="nueva_contrasena" name="nueva_contrasena" required placeholder="Ingrese su nueva contraseña">
                                    </div>

                                    <div class="form-group mb-3">
                                        <input class="form-control" type="password" id="nueva_contrasena2" name="nueva_contrasena2" required placeholder="Repita su Contraseña">
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary" type="submit">Actualizar Contraseña</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const emailForm = document.getElementById("email-form");
            const codeForm = document.getElementById("code-form");
            const passwordForm = document.getElementById("password-form");

            <?php if ($usuarioEncontrado && !$codigoValidado): ?>
            emailForm.style.display = "none";
            codeForm.style.display = "block";
            passwordForm.style.display = "none";
            <?php elseif ($codigoValidado): ?>
            emailForm.style.display = "none";
            codeForm.style.display = "none";
            passwordForm.style.display = "block";
            <?php endif; ?>
        });
    </script>
</body>
