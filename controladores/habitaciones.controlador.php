<?php

class ControladorHabitaciones
{
    // *** MOSTRAR Habitaciones ***

    static public function ctrMostrarHabitaciones($item, $valor)
    {
        $respuesta = ModeloHabitaciones::mdlMostrarHabitaciones($item, $valor);
        return $respuesta;
    }
    public function ctrEditarHabitaciones()
    {
        $tabla = "habitaciones";
        if (isset($_POST["id_habitaciones"])) {
            $datos = array(
                "numero" => $_POST["numero"],
                "tarifa" => $_POST["tarifa"],
                "id_tipoHabitacion" => $_POST["id_tipoHabitaciones"],
                "estado" => $_POST["estado"],
                "id_habitaciones" => $_POST["id_habitaciones"]

            );


            $url = ControladorPlantilla::url() . "habitaciones";

            $respuesta = ModeloHabitaciones::mdlEditarHabitacion($tabla, $datos);
            if ($respuesta == "ok") {
                echo '<script>
                fncSweetAlert(
                "success",
                "La habitación se actualizó correctamente",
                "' . $url . '"
                );
                </script>';
            }
        }
    }
    static public function ctrAgregarHabitacion()
    {

        $tabla = "habitaciones";

        if (isset($_POST["numero"])) {

            $datos = array(
                "numero" => $_POST["numero"],
                "tarifa" => $_POST["tarifa"],
                "id_tipoHabitacion" => $_POST["id_tipoHab"],
                "estado" => $_POST["estado"]
            );
            $url = ControladorPlantilla::url() . "habitaciones";
            $respuesta = ModeloHabitaciones::mdlAgregarHabitacion($tabla, $datos);
            if ($respuesta == "ok") {
                echo '<script>
                    fncSweetAlert(
                    "success",
                    "La habitación se agregó correctamente",
                    "' . $url . '"
                    );
                    </script>';
            }
        }
    }
    static public function ctrEliminarHabitacion()
    {
        if (isset($_GET["habitacion"])) {

            $url = ControladorPlantilla::url() . "habitaciones";
            $tabla = "habitaciones";
            $dato = $_GET["habitacion"];

            print_r($dato);

            $respuesta = ModeloHabitaciones::mdlEliminarHabitacion($tabla, $dato);

            if ($respuesta == "ok") {
                echo '<script>
                fncSweetAlert("success", "La habitación se eliminó correctamente", "' . $url . '");
                </script>';
            }
        }
    }

    static public function ctrMostrarTipoHabitacion($item, $valor)
    {
        $respuesta = ModeloHabitaciones::mdlMostraTipoHabitacion($item, $valor);
        return $respuesta;
    }
}
