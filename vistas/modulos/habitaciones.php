<?php

$habitaciones = ControladorHabitaciones::ctrMostrarHabitaciones(null, null);

// // echo "<pre>";
// print_r($habitaciones);
// // echo "</pre>";

$cantidad = count($habitaciones);

?>
<div class="row">
    <div class="col-12 ">
        <div class="card">
            <h1 class="text-center mt-3">Habitaciones</h1>

            <div class="card-header">
                <a href="habitaciones_agregar" class="btn btn-info">Agregar</a>
            </div><!-- end card header -->

            <?php if ($cantidad > 0) { ?>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped dt-responsive table-responsive nowrap">
                        <thead>
                            <tr>
                                <th class="text-center">Numero</th>
                                <th class="text-center">Tipo de habitación</th>
                                <th class="text-center">Cantidad de pasajeros</th>
                                <th class="text-center">Tarifa</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($habitaciones as $key => $value) {
                            ?>
                                <tr style="background-color:#000888">
                                    <td class="text-center"> <?php echo $value["numero"] ?></td>
                                    <td class="text-center"> <?php echo $value["tipo"] ?> </td>
                                    <td class="text-center"> <?php echo $value["cantidad_pax"] ?></td>
                                    <td class="text-center"> $ <?php echo $value["tarifa"] ?></td>
                                    <td class="text-center"
                                        <?php
                                        // Si el estado es 1 se pinta la celda de verda, si es 0 se pinta de rojo
                                        if ($value["estadohab"] == 1) {
                                            echo "style='background-color: #77a345; color: #FFFFFF'; font-weight: bold;";
                                        } else {
                                            echo "style='background-color: #FF0000; color: #FFFFFF'; font-weight: bold;";
                                        }
                                        ?>>
                                        <?php
                                        // Aca se muestra el estado con texto
                                        if ($value["estadohab"] == 1) {
                                            echo "Activo";
                                        } else {
                                            echo "Inactivo";
                                        }
                                        ?>
                                    </td>

                                    <td class="text-center"><a href="habitaciones_editar/<?php echo $value["id_habitaciones"] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>

                                        <button
                                            class="btn btn-danger btnEliminar" data-id="<?php echo $value["id_habitaciones"]; ?>" data-modulo="habitacion"
                                            id_habitacion=<?php echo $value["id_habitaciones"]; ?>><i class="fas fa-trash"></i></button>
                                    </td>


                                </tr>

                                <input type="hidden" id="url" value="<?php echo $url; ?>">

                            <?php } ?>

                        </tbody>
                    </table>
                </div>

            <?php } else { ?>
                <h3>Habitaciones no disponibles</h3>
            <?php } ?>

        </div>
    </div>
</div>

<?php

$eliminar = new ControladorHabitaciones();
$eliminar->ctrEliminarHabitacion();

?>