<?php

$clientes = ControladorClientes::ctrMostrarClientes(null, null);
// $plan = ControladorPlanes::ctrMostrarPlanes(null, null);
// echo "<pre>";
// print_r($clientes);
// echo "</pre>";

$cantidad = count($clientes);
?>
<div class="row">
    <div class="col-12 ">
        <div class="card">
            <h1 class="text-center mt-3">Huéspedes</h1>
        </div>
    </div>
</div>

<?php

// $eliminar = new ControladorHuespedes();
// $eliminar->ctrEliminarHuespedes();

?>