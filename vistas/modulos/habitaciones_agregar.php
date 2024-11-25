<?php

$tipo = ControladorHabitaciones::ctrMostrarTipoHabitacion(null, null);

// print_r($tipo); //verifica si vienen datos 
// return; corta la ejecucion
?>

<div class="col-lg-12 mt-4">
    <div class="card">

        <div class="card-header mx-auto">
            <h2 class=" mb-0">Agregar habitación <img src="<?php echo $url; ?>vistas/assets/img/habitacion.png" alt="Editar habitación" style="margin-left: 20px; width: 100px; vertical-align: middle;"></h2>
        </div><!-- end card header -->

        <div class="card-body">
            <form method="POST">
                <div class="row container-fluid">
                    <div class="col-6">
                        <div class="mb-1 col-8 mx-auto">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="numero" name="numero" class="form-control" tabindex="1" placeholder="Número"
                                value="" required>
                        </div>
                        <div class="mb-1 col-8 mx-auto">
                            <label for="tarifa" class="form-label">Tarifa</label>
                            <input type="text" id="tarifa" name="tarifa" class="form-control" tabindex="3" placeholder="Tarifa"
                                value="" required>
                        </div>
                        <div class="mb-1 col-8 mx-auto">
                            <label for="id_tipoHab" class="form-label">Tipo de habitación</label>
                            <select class="form-select" name="id_tipoHab" id="example-select" required>
                                <option value="">Selecciona un tipo de habitación</option>
                                <?php foreach ($tipo as $es => $value) { ?>
                                    <option value="<?php echo (int)$value["id_tipoHab"]; ?>"><?php echo $value["descripcion"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-1 col-8 mx-auto">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" tabindex="15" name="estado" id="example-select" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <?php

                    $agregar = new ControladorHabitaciones();
                    $agregar->ctrAgregarHabitacion();
                    ?>

                    <div class="mt-2 col-8 mx-auto text-center">
                        <a href="<?php echo $url; ?>/index.php?pagina=habitaciones" class="btn btn-secondary">
                            <i class="fa-solid fa-arrow-left"></i> Regresar
                        </a>
                        <button class="btn btn-info btnEditaHabitacion justify-content-center" type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>

            </form>
        </div>
    </div>

</div>
</div>