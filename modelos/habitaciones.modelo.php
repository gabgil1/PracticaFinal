<?php

// use PSpell\Config;

require_once 'conexion.php';

class ModeloHabitaciones
{

    static public function mdlMostrarHabitaciones($item, $valor)
    {
        if ($item != null) {
            try {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM habitaciones WHERE $item = :$item");

                //enlace de parametros
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        } else {

            try {
                $habitaciones = Conexion::conectar()->prepare("SELECT h.*, th.descripcion as tipo, th.cantidad_pax, e.descripcion AS estadohab 
                                                               FROM habitaciones h
                                                               INNER JOIN tipo_habitaciones th
                                                               ON h.id_tipoHabitacion = th.id_tipoHab
                                                               INNER JOIN estado_habitaciones e
                                                               ON h.estado = e.id_estadoHabitacion
                                                               ORDER BY numero ASC");
                $habitaciones->execute();

                return $habitaciones->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }
    }
    static public function mdlAgregarHabitacion($tabla, $datos)
    {

        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(numero, tarifa, id_tipoHabitacion, estado)VALUES(:numero, :tarifa, :id_tipoHabitacion,:estado)");

            $stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_STR);
            $stmt->bindParam(":tarifa", $datos["tarifa"], PDO::PARAM_STR);
            $stmt->bindParam(":id_tipoHabitacion", $datos["id_tipoHabitacion"], PDO::PARAM_INT);
            $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

            // echo "<pre>";
            // print_r($datos);
            // echo "</pre>";
            // return;
            $stmt->execute();
            return "ok";
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
    static public function mdlEditarHabitacion($tabla, $datos)
    {
        $stmt = null;
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET numero = :numero, tarifa = :tarifa, id_tipoHabitacion = :id_tipoHabitacion, estado = :estado WHERE id_habitaciones = :id_habitaciones");

            $stmt->bindParam(":id_habitaciones", $datos["id_habitaciones"], PDO::PARAM_INT);
            $stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_STR);
            $stmt->bindParam(":tarifa", $datos["tarifa"], PDO::PARAM_STR);
            $stmt->bindParam(":id_tipoHabitacion", $datos["id_tipoHabitacion"], PDO::PARAM_INT);
            $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);



            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            if ($stmt) {
                echo "Error en la consulta: " . $stmt->queryString . "<br>Error: " . $e->getMessage();
            } else {
                echo "Error al preparar la consulta: " . $e->getMessage();
            }
            return "error" . $e->getMessage();
        }
    }

    static public function mdlEliminarHabitacion($tabla, $dato)
    {
        try {
            $habitacion = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_habitaciones = :id_habitacion");

            $habitacion->bindParam(":id_habitacion", $dato, PDO::PARAM_INT);

            if ($habitacion->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
    static public function mdlMostraTipoHabitacion($item = null, $valor = null)
    {
        try {
            if ($item != null) {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM tipo_habitaciones WHERE $item = :$item");
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            } else {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM tipo_habitaciones");
            }

            $stmt->execute();
            return $item != null ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
