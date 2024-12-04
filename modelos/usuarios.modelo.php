<?php

require_once 'conexion.php';

class ModeloUsuarios
{

    static public function mdlMostrarUsuarios($item, $valor)
    {
        if ($item != null) {
            try {
                $stmt = Conexion::conectar()->prepare("SELECT u.id_usuario, u.usuario, u.nombre, u.apellido, u.email, u.contrasena, IFNULL(t.nombre, 'Sin Tipo') AS tipo FROM usuarios AS u LEFT JOIN tipos_usuarios AS t ON t.id_tipo = u.tipo_usuario WHERE $item = :$item");
                //enlace de parametros
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        } else {

            try {
                $usuarios = Conexion::conectar()->prepare("SELECT u.id_usuario, u.usuario, u.nombre, u.apellido, u.email, u.contrasena, IFNULL(t.nombre, 'Sin Tipo') AS tipo FROM usuarios AS u LEFT JOIN tipos_usuarios AS t ON t.id_tipo = u.tipo_usuario;
                ");
                $usuarios->execute();

                return $usuarios->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }
    }

    static public function mdlMostrarTipoUsuario()
    {
        try {
            $usuarios = Conexion::conectar()->prepare("SELECT * FROM tipos_usuarios");
            $usuarios->execute();

            return $usuarios->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
        
    }

    static public function mdlAgregarUsuarios($datosUsuario, $datosHuesped)
    {
        try {
            // Iniciar la conexión y la transacción
            $conexion = Conexion::conectar();
            $conexion->beginTransaction();
    
            // Insertar en la tabla usuarios
            $stmtUsuario = $conexion->prepare("INSERT INTO usuarios (usuario, contrasena, nombre, apellido, dni, email, tipo_usuario) 
                                               VALUES (:usuario, :contrasena, :nombre, :apellido, :dni, :email, :tipo_usuario)");
            $stmtUsuario->bindParam(":usuario", $datosUsuario["usuario"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":contrasena", $datosUsuario["contrasena"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":apellido", $datosUsuario["apellido"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":dni", $datosUsuario["dni"], PDO::PARAM_INT);
            $stmtUsuario->bindParam(":email", $datosUsuario["email"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":tipo_usuario", $datosUsuario["tipo_usuario"], PDO::PARAM_INT);
    
            if (!$stmtUsuario->execute()) {
                $conexion->rollBack();
                return "error_usuario";
            }
    
            // Obtener el ID del usuario recién insertado
            $idUsuario = $conexion->lastInsertId();
            print_r($idUsuario);
    
            // Insertar en la tabla huespedes
            $stmtHuesped = $conexion->prepare("INSERT INTO huespedes (telefono, direccion, estado_id_estado, usuarios_id_usuarios) 
                                               VALUES (:telefono, :direccion, :estado_id_estado, :usuarios_id_usuarios)");
            
            $stmtHuesped->bindParam(":telefono", $datosHuesped["telefono"], PDO::PARAM_STR);
            $stmtHuesped->bindParam(":direccion", $datosHuesped["direccion"], PDO::PARAM_STR);
            $stmtHuesped->bindParam(":estado_id_estado", $datosHuesped["estado_id_estado"], PDO::PARAM_INT);
            $stmtHuesped->bindParam(":usuarios_id_usuarios", $idUsuario, PDO::PARAM_INT);
    
            if (!$stmtHuesped->execute()) {
                $conexion->rollBack();
                return "error_huesped";
            }
    
            // Confirmar la transacción
            $conexion->commit();
            return "ok";
    
        } catch (PDOException $e) {
            $conexion->rollBack();
            return "Error: " . $e->getMessage();
        }
    }

    static public function mdlEditarUsuarios($tabla, $datos)
    {
        try {
            $usuarios = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, contrasena = :contrasena, nombre = :nombre, apellido = :apellido, email = :email, tipo_usuario = :tipo_usuario WHERE id_usuario = :id_usuario");

            $usuarios->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $usuarios->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
            $usuarios->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $usuarios->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
            $usuarios->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $usuarios->bindParam(":tipo_usuario", $datos["tipo_usuario"], PDO::PARAM_INT);
            $usuarios->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

            if ($usuarios->execute()) {
                return "ok";
            } else {

                return print_r(Conexion::conectar()->errorInfo());
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    static public function mdlEliminarUsuarios($tabla, $datos)
    {
        try {
            $usuarios = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");
            $usuarios->bindParam(":id_usuario", $datos, PDO::PARAM_INT);

            if ($usuarios->execute()) {
                return "ok";
            } else {
                return "error";
            }

        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }

    }
}
