<div class="row">
    <div class="col-12 ">
        <div class="card">
            <h1 class="text-center mt-3">Check in</h1>
        </div>
    </div>
</div>
<form action="" method="post">
    <div class="mb-1 col-4 mx-auto">
        <label for="buscar_dni" class="form-label">Buscar por DNI</label>
        <input type="text" id="buscar_dni" name="buscar_dni" class="form-control" tabindex="3" placeholder="Buscar por DNI">
        <button class="btn btn-info btnEditaCliente justify-content-center mt-2" type="submit" tabindex="17"><i class="fa-solid fa-search"></i> Buscar</button>
    </div>
</form>
<!-- <//?php
        $respuesta = ControladorReservas::ctrBuscarReservas();
        if ($respuesta) {
            echo "<pre>";
            print_r($respuesta); // Imprime la respuesta en un formato más legible
            echo "</pre>";
        }
        ?> -->
<div class="col-lg-12 mt-4">
    <div class="card">

        <!-- <div class="card-header mx-auto">
                <h2 class="mb-0">Reservas</h2>
            </div>end card header -->
        <!-- <//?php
        $huesped = ControladorReservas::ctrBuscarReservas();
        echo "<pre>";
        print_r($huesped);
        echo "</pre>";
        ?> -->
        <div class="card-body">
            <form method="POST">
                <div class="row container-fluid">
                    <div class="col-6">
                        <div class="mb-1 col-8 mx-auto">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" tabindex="1" placeholder="Nombre"
                                value="<?php echo $huesped["nombre"]; ?>" required>
                        </div>
                        <div class="mb-1 col-8 mx-auto">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" id="dni" name="dni" class="form-control" tabindex="3" placeholder="DNI"
                                value="<?php echo $huesped["dni"]; ?>">
                        </div>
                        <div class="mb-1 col-8 mx-auto">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" id="direccion" name="direccion" class="form-control" tabindex="8" placeholder="Dirección"
                                value="<?php echo $huesped["direccion"]; ?>" required>
                        </div>
                        <div class="mb-1 col-8 mx-auto">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control" tabindex="10" placeholder="Email"
                                value="<?php echo $huesped["email"]; ?>" required>
                        </div>
                        <div class="mb-1 col-8 mx-auto">
                            <label for="fecha_reserva" class="form-label">Fecha de reserva</label>
                            <input type="date" id="fecha_reserva" name="fecha_reserva" class="form-control" tabindex="15" placeholder="Fecha de reserva"
                                value="<?php echo date("Y-m-d", strtotime($huesped["fecha_reserva"])); ?>" required>
                        </div>
                    </div><!-- Fin col 1 -->
                    <div class="col-6">
                        <div class="mb-1 col-8 mx-auto">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" id="apellido" name="apellido" class="form-control" tabindex="2" placeholder="Apellido"
                                value="<?php echo $huesped["apellido"]; ?>" required>
                        </div>
                        <div class="mb-1 col-8 mx-auto">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" tabindex="7" placeholder="Fecha de nacimiennto"
                                value="<?php echo date("Y-m-d", strtotime($cliente["fecha_nacimiento"])); ?>" required>
                        </div>
                        <div class="mb-1 col-8 mx-auto">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="text" id="telefono" name="telefono" class="form-control" tabindex="9" placeholder="Telefono"
                                value="<?php echo $cliente["telefono"]; ?>" required>
                        </div>
                        <div class="mb-1 col-8 mx-auto">
                            <label for="id_plan" class="form-label">Plan</label>
                            <select class="form-select" tabindex="11" name="id_plan" id="example-select" required>
                                <?php foreach ($plan as $es => $value) { ?>
                                    <option value="<?php echo (int)$value["id_plan"]; ?>"><?php echo $value["nombre"];
                                                                                            "selected"; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-1 col-8 mx-auto">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" tabindex="16" name="estado" id="example-select" required>
                                <option value="1" <?php if ($cliente["estado"] == 1) echo 'selected'; ?>>Activo</option>
                                <option value="0" <?php if ($cliente["estado"] == 0) echo 'selected'; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div><!-- Fin col 2 -->
                </div><!-- Fin row general-->
                <input type="hidden" name="id_cliente" value="<?php echo $cliente["id_cliente"]; ?>">


                <div class="mb-3 col-4 mx-auto text-center">
                    <a href="<?php echo $url; ?>/index.php?pagina=clientes" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Regresar
                    </a>
                    <button class="btn btn-info btnEditaCliente justify-content-center" type="submit" tabindex="17"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                </div>
                <?php
                // ************* instancia de reserva *************
                // $editar = new ControladorReservas();
                // $editar->ctrEditarReserva();
                ?>

            </form>
        </div>

    </div>
</div>

<?php

// $eliminar = new ControladorReservas();
// $eliminar->ctrEliminarReservas();

?>