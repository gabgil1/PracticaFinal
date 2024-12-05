<?php

$tipos = ControladorUsuarios::ctrMostrarTipoUsuario();

// print_r($entrenador); verifica si vienen datos 
// return; corta la ejecucion
?>

<div class="col-lg-12 mt-4">
    <div class="card">

        <div class="card-header mx-auto">
            <h2 class=" mb-0">Agregar usuario</h2>
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
                    <label for="dni" class="form-label">Dni</label>
                    <input type="number" id="dni" name="dni" class="form-control" placeholder="dni"
                        value="" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="contra" class="form-label">Contraseña</label>
                    <input type="password" id="contra" name="contra" class="form-control" placeholder="************"
                        value="" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="tipo" class="form-label">Tipo de usuario</label>
                    <select class="form-control" name="tipo" id="tipo">
                        <option value="">Selecciona un Tipo</option>
                        <?php foreach ($tipos as $es => $value) { ?>
                            <option value="<?php echo (int)$value["id_tipoUsuarios"]; ?>"><?php echo $value["descripcion"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <?php

                $agregar = new ControladorUsuarios();
                $agregar->ctrAgregarUsuario();
                var_dump($agregar);
                ?>

                <div class="mt-2 col-4 mx-auto text-center">
                    <a href="<?php echo $url; ?>usuarios" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Regresar
                    </a>
                    <button class="btn btn-info btnEditaCliente justify-content-center" type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                </div>

            </form>
        </div>

    </div>
</div>