<?php

require_once 'controladores/plantilla.controlador.php';

// require_once 'controladores/clientes.controlador.php';
// require_once 'modelos/clientes.modelo.php';

require_once 'controladores/reservas.controlador.php';
require_once 'modelos/reservas.modelo.php';

require_once 'controladores/habitaciones.controlador.php';
require_once 'modelos/habitaciones.modelo.php';

require_once 'controladores/usuarios.controlador.php';
require_once 'modelos/usuarios.modelo.php';

$plantilla = new ControladorPlantilla();
$plantilla->ctrMostrarPlantilla();
