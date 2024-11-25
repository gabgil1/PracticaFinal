<?php


$item = "id_usuario";
$valor = $rutas[1];

$usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

// echo "<pre>";
// print_r($usuario);
// echo "</pre>";

if ($usuario) {
?>

    <div class="col-lg-12 mt-4">
        <div class="card">

            <div class="card-header mx-auto">
                <h2 class="mb-0">Editar usuario <img src="<?php echo $url; ?>vistas/assets/img/mancuerna.png" alt="Editar plan" style="margin-left: 20px; width: 100px; vertical-align: middle;"></h2>
            </div><!-- end card header -->

            <div class="card-body">
                <form method="POST">
                    <div class="mb-1 col-4 mx-auto">
                        <label for="nombre" class="form-label">Nombre de usuario</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre"
                            value="<?php echo $usuario["nombre"]; ?>" required>
                    </div>
                    <div class="mb-1 col-4 mx-auto">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="text" id="password" name="password" class="form-control" placeholder="Contraseña"
                            value="<?php echo $usuario["password"]; ?>" required>
                    </div>
                    <div class="mb-1 col-4 mx-auto">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select" name="estado" id="example-select" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>

                    <?php
                    $editar = new ControladorPlanes();
                    $editar->ctrEditarPlan();
                    ?>

                </form>
            </div>

        </div>
    </div>

<?php } else { ?>
    <h3>Usuario no disponible</h3>
<?php } ?>