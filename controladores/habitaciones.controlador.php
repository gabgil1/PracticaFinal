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
        if (isset($_POST["id_habitacion"])) {
            $datos = array(
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "dni" => $_POST["dni"],
                "fecha_nacimiento" => $_POST["fecha_nacimiento"],
                "direccion" => $_POST["direccion"],
                "telefono" => $_POST["telefono"],
                "email" => $_POST["email"],
                "id_plan" => $_POST["id_plan"],
                "fecha_inscripcion" => $_POST["fecha_inscripcion"],
                "estado" => $_POST["estado"],
                "id_cliente" => $_POST["id_cliente"]

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

        if (isset($_POST["nombre"])) {

            $datos = array(
                "numero" => $_POST["numero"],
                "tarifa" => $_POST["tarifa"],
                "id_tipoHab" => $_POST["id_tipoHabitacion"],
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

        if (isset($_GET["id_habitacion"])) {

            $url = ControladorPlantilla::url() . "habitacion";
            $tabla = "habitacion";
            $dato = $_GET["id_habitacion"];

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
