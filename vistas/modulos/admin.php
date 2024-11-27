<?php

$url = ControladorPlantilla::url();

if (!isset($_SESSION["iniciarSesion"]) || $_SESSION["tipo_usuario"] !== 'Administrador') {
    echo '<script>
        window.location = "' . ControladorPlantilla::url() . 'login";
    </script>';
    exit;
}

            if (isset($_GET["pagina"])) {

                $rutas = explode('/', $_GET["pagina"]);

                if (
                    $rutas[0] == "home" ||
                    $rutas[0] == "checkin" ||
                    $rutas[0] == "checkin_agregar" ||
                    $rutas[0] == "checkin_editar" ||
                    $rutas[0] == "habitaciones" ||
                    $rutas[0] == "habitaciones_agregar" ||
                    $rutas[0] == "habitaciones_editar" ||
                    $rutas[0] == "huespedes" ||
                    $rutas[0] == "huespedes_agregar" ||
                    $rutas[0] == "huespedes_editar" ||
                    $rutas[0] == "reservas" ||
                    $rutas[0] == "reservas_listado" ||
                    $rutas[0] == "reservas_agregar" ||
                    $rutas[0] == "reservas_editar" ||
                    $rutas[0] == "usuarios" ||
                    $rutas[0] == "usuarios_agregar" ||
                    $rutas[0] == "usuarios_editar" ||
                    $rutas[0] == "salir"
                ) {
                    include "vistas/modulos/" . $rutas[0] . ".php";
                } else {

                    include "vistas/modulos/404.php";
                }
            }
