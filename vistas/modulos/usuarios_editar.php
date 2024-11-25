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
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" id="usuario" name="usuario" class="form-control" placeholder="usuario"
                        value="" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre"
                        value="" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="apellido"
                        value="" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="email"
                        value="" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="contra" class="form-label">Contraseña</label>
                    <input type="password" id="contra" name="contra" class="form-control" placeholder="************"
                        value="" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="tipo" class="form-label">Tipo de usuario</label>
                    <select class="form-select" name="tipo" id="tipo">
                        <option value="">Selecciona un Tipo</option>
                        <?php foreach ($tipos as $es => $value) { ?>
                            <option value="<?php echo (int)$value["id_tipo"]; ?>"><?php echo $value["nombre"]; ?></option>
                        <?php } ?>
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