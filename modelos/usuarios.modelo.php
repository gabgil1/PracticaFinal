<?php

require_once 'conexion.php';

class ModeloUsuarios
{

    static public function mdlMostrarUsuarios($item, $valor)
    {
        if ($item != null) {
            try {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE $item = :$item");
                //enlace de parametros
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        } else {

            try {
                $usuarios = Conexion::conectar()->prepare("SELECT * FROM usuarios");
                $usuarios->execute();

                return $usuarios->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }
    }
}
