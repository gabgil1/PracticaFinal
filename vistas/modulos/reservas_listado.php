<?php

$reservas = ControladorReservas::ctrMostrarReservas(null, null);

// echo "<pre>";
// print_r($reservas);
// echo "</pre>";
// return;

$cantidad = count($reservas);
?>
<div class="row">
    <div class="col-12 ">
        <div class="card">
            <h1 class="text-center mt-3">Listado de reservas</h1>

            <div class="card-header">
                <a href="reservas" class="btn btn-info">Agregar</a>
            </div><!-- end card header -->

            <?php if ($cantidad > 0) { ?>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped dt-responsive table-responsive nowrap">
                        <thead>
                            <tr>
                                <th class="text-center">Fecha de Reserva</th>
                                <th class="text-center">Fecha de Check In</th>
                                <th class="text-center">Fecha de Check Out</th>
                                <th class="text-center">Cantidad de dias</th>
                                <th class="text-center">Apellido huesped</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($reservas as $key => $value) {
                            ?>
                                <tr style="background-color:#000888">
                                    <td class="text-center"> <?php echo date('d-m-Y', strtotime($value["fecha_reserva"])); ?> </td>
                                    <td class="text-center"> <?php echo date('d-m-Y', strtotime($value["fecha_checkIn"])); ?> </td>
                                    <td class="text-center"> <?php echo date('d-m-Y', strtotime($value["fecha_checkOut"])); ?> </td>
                                    <td class="text-center"> <?php
                                                                $fechaInicio = new DateTime($value["fecha_checkIn"]);
                                                                $fechaSalida = new DateTime($value["fecha_checkOut"]);

                                                                $diferencia = $fechaInicio->diff($fechaSalida);

                                                                echo $diferencia->days; ?>
                                    </td>
                                    <td class="text-center"> <?php echo $value["apellido"]; ?> </td>
                                    <td class="text-center"
                                        <?php
                                        // Si el estado es 1 se pinta la celda de verda, si es 0 se pinta de rojo
                                        if ($value["estado"] == 1) {
                                            echo "style='background-color: #77a345; color: #FFFFFF'; font-weight: bold;";
                                        } else {
                                            echo "style='background-color: #FF0000; color: #FFFFFF'; font-weight: bold;";
                                        }
                                        ?>>
                                        <?php
                                        // Aca se muestra el estado con texto
                                        if ($value["estado"] == 1) {
                                            echo "Activo";
                                        } else {
                                            echo "Inactivo";
                                        }
                                        ?>
                                    </td>

                                    <td class="text-center"><a href="reservas_editar/<?php echo $value["id_cliente"] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>

                                        <button
                                            class="btn btn-danger btnEliminar" data-id="<?php echo $value["id_cliente"]; ?>" data-modulo="cliente"
                                            id_cliente=<?php echo $value["id_cliente"]; ?>><i class="fas fa-trash"></i></button>
                                    </td>


                                </tr>

                                <input type="hidden" id="url" value="<?php echo $url; ?>">

                            <?php } ?>

                        </tbody>
                    </table>
                </div>

            <?php } else { ?>
                <h3>Reservas no disponibles</h3>
            <?php } ?>

        </div>
    </div>
</div>

<?php

$eliminar = new ControladorClientes();
$eliminar->ctrEliminarCliente();

?>