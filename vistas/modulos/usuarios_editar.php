<?php


$item = "id_usuario";
$valor = $rutas[1];
print_r($valor);

$usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
$tipos = ControladorUsuarios::ctrMostrarTipoUsuario();


// echo "<pre>";
// print_r($usuario);
// echo "</pre>";

if ($usuario) {
?>

    <div class="col-lg-12 mt-4">
        <div class="card">

            <div class="card-header mx-auto">
                <h2 class="mb-0">Editar usuario</h2>
            </div><!-- end card header -->

            <div class="card-body">
                <form method="POST">
                <div class="mb-1 col-4 mx-auto">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" id="usuario" name="usuario" class="form-control" placeholder="usuario"
                        value="<?php echo $usuario["usuario"]; ?>" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre"
                        value="<?php echo $usuario["nombre"]; ?>" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="apellido"
                        value="<?php echo $usuario["apellido"]; ?>" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="email"
                        value="<?php echo $usuario["email"]; ?>" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="contra" class="form-label">Nueva Contraseña</label>
                    <input type="password" id="contra" name="contra" class="form-control" placeholder="************"
                        value="" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="tipo" class="form-label">Tipo de usuario</label>
                    <select value="<?php echo $usuario["tipo"]; ?>" class="form-select" name="tipo" id="tipo">
                        <option value=""><?php echo $usuario["tipo"]; ?></option>
                        <?php foreach ($tipos as $es => $value) { ?>
                            <option value="<?php echo (int)$value["id_tipo"]; ?>"><?php echo $value["nombre"]; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <input type="hidden" name="id_usuario" value="<?php echo $usuario["id_usuario"]; ?>">
                <?php
                $editar = new ControladorUsuarios();
                $editar->ctrEditarUsuarios();
                ?>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                </form>
            </div>

        </div>
    </div>

<?php } else { ?>
    <h3>Usuario no disponible</h3>
<?php } ?>