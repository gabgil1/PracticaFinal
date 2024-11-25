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

    static public function mdlAgregarUsuarios($tabla, $datos)
    {
        try {
            $usuarios = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, contrasena, nombre, apellido, email) VALUES (:usuario, :contrasena, :nombre, :apellido, :email);");

            $usuarios->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $usuarios->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
            $usuarios->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $usuarios->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
            $usuarios->bindParam(":email", $datos["email"], PDO::PARAM_STR);

            if ($usuarios->execute()) {

                return "ok";
            } else {

                return "error";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
