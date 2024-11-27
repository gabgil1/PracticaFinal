<?php

$url = ControladorPlantilla::url();

if (!isset($_SESSION["iniciarSesion"]) || $_SESSION["tipo_usuario"] !== 'Sin Tipo') {
    echo '<script>
        window.location = "' . ControladorPlantilla::url() . 'login";
    </script>';
    exit;
}

            if (isset($_GET["pagina"])) {

                $rutas = explode('/', $_GET["pagina"]);

                if (
                    $rutas[0] == "home" ||
                    
                    $rutas[0] == "reservas" ||
                    $rutas[0] == "reservas_listado" ||
                    $rutas[0] == "reservas_agregar" ||
                    $rutas[0] == "reservas_editar" ||
                    $rutas[0] == "salir"
                ) {
                    include "vistas/modulos/" . $rutas[0] . ".php";
                } else {

                    include "vistas/modulos/404.php";
                }
            }
