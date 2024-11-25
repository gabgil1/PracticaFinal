<?php

class ControladorReservas
{
    static public function ctrBuscarReservas()
    {
        $dni = $_POST["buscar_dni"];
        $tabla = "reservas";
        if (isset($dni)) {
            $respuesta = ModeloReservas::mdlMostrarReserva($tabla, $dni);
            return $respuesta;
        }
    }
    static public function ctrMostrarReservas($item, $valor)
    {
        $respuesta = ModeloReservas::mdlMostrarReserva($item, $valor);
        return $respuesta;
    }
}
