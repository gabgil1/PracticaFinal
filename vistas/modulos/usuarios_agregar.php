<?php

$entrenador = ControladorEntrenadores::ctrMostrarEntrenadores(null, null);

// print_r($entrenador); verifica si vienen datos 
// return; corta la ejecucion
?>

<div class="col-lg-12 mt-4">
    <div class="card">

        <div class="card-header mx-auto">
            <h2 class=" mb-0">Agregar usuario <img src="<?php echo $url; ?>vistas/assets/img/mancuerna.png" alt="Editar cliente" style="margin-left: 20px; width: 100px; vertical-align: middle;"></h2>
        </div><!-- end card header -->

        <div class="card-body">
            <form method="POST">
                <div class="mb-1 col-4 mx-auto">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Código"
                        value="" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre"
                        value="" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripción"
                        value="" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="duracion" class="form-label">Duración(semanas)</label>
                    <input type="text" id="duracion" name="duracion" class="form-control" placeholder="Duración(semanas)"
                        value="" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="cantidad_sesiones" class="form-label">Cantidad de sesiones</label>
                    <input type="text" id="cantidad_sesiones" name="cantidad_sesiones" class="form-control" placeholder="Cantidad de sesiones"
                        value="" required>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="id_entrenador" class="form-label">Entrenador</label>
                    <select class="form-select" name="id_entrenador" id="example-select" required>
                        <option value="">Selecciona un entrenador</option>
                        <?php foreach ($entrenador as $es => $value) { ?>
                            <option value="<?php echo (int)$value["id_entrenador"]; ?>"><?php echo $value["nombre_entrenador"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-1 col-4 mx-auto">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" name="estado" id="example-select" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

                <?php

                $agregar = new ControladorPlanes();
                $agregar->ctrAgregarPlan();
                ?>

                <div class="mt-2 col-4 mx-auto text-center">
                    <a href="<?php echo $url; ?>/index.php?pagina=planes" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Regresar
                    </a>
                    <button class="btn btn-info btnEditaCliente justify-content-center" type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                </div>

            </form>
        </div>

    </div>
</div>