<?php


$item = "id_habitaciones";
$valor = $rutas[1];

$habitacion = ControladorHabitaciones::ctrMostrarHabitaciones($item, $valor);
$tipoHabitacion = ControladorHabitaciones::ctrMostrarTipoHabitacion(null, null);

// print_r($tipoHabitacion);
// return;
// print_r($habitacion);

if ($habitacion) {
?>

    <div class="col-lg-12 mt-4">
        <div class="card">

            <div class="card-header mx-auto">
                <h2 class="mb-0">Editar habitación <img src="<?php echo $url; ?>vistas/assets/img/habitacion.png" alt="Editar habitación" style="margin-left: 20px; width: 100px; vertical-align: middle;"></h2>
            </div><!-- end card header -->

            <div class="card-body   ">
                <form method="POST">
                    <div class="row container-fluid">
                        <div class="col-6">
                            <div class="mb-1 col-8 mx-auto">
                                <label for="numero" class="form-label">Número de Habitación</label>
                                <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="numero" name="numero" class="form-control" tabindex="1" placeholder="Número de Habitación"
                                    value="<?php echo $habitacion["numero"]; ?>" required>
                            </div>
                            <div class="mb-1 col-8 mx-auto">
                                <label for="tarifa" class="form-label">Tarifa</label>
                                <input type="text" id="tarifa" name="tarifa" class="form-control" tabindex="1" placeholder="Número de Habitación"
                                    value="<?php echo $habitacion["tarifa"]; ?>" required>
                            </div>
                            <div class="mb-1 col-8 mx-auto">
                                <label for="id_tipoHabitaciones" class="form-label">Tipo de habitación</label>
                                <select class="form-select" tabindex="11" name="id_tipoHabitaciones" id="example-select" required>
                                    <?php foreach ($tipoHabitacion as $es => $valor) { ?>
                                        <option value="<?php echo (int)$valor["id_tipoHab"]; ?>"><?php echo $valor["descripcion"];
                                                                                                    "selected"; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-1 col-8 mx-auto">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" " name=" estado" id="example-select" required>
                                    <option value="1" <?php if ($habitacion["estado"] == 1) echo 'selected'; ?>>Disponible</option>
                                    <option value="2" <?php if ($habitacion["estado"] == 2) echo 'selected'; ?>>No disponible</option>
                                    <option value="3" <?php if ($habitacion["estado"] == 3) echo 'selected'; ?>>En Mantenimiento</option>
                                </select>
                            </div>
                        </div><!-- Fin col 2 -->
                    </div><!-- Fin row general-->
                    <input type="hidden" name="id_habitaciones" value="<?php echo $habitacion["id_habitaciones"]; ?>">


                    <div class="mb-3 col-4 mx-auto text-center">
                        <a href="<?php echo $url; ?>/index.php?pagina=habitaciones" class="btn btn-secondary">
                            <i class="fa-solid fa-arrow-left"></i> Regresar
                        </a>
                        <button class="btn btn-info btnEditaCliente justify-content-center" type="submit" tabindex="17"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                    <?php

                    $editar = new ControladorHabitaciones();
                    $editar->ctrEditarHabitaciones();
                    ?>

                </form>
            </div>

        </div>
    </div>

<?php } else { ?>
    <h3>Habitación no disponible</h3>
<?php } ?>