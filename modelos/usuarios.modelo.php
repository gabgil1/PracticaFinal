<?php

require_once 'conexion.php';

class ModeloUsuarios
{

    static public function mdlMostrarUsuarios($item, $valor)
    {
        if ($item != null) {
            try {
                $stmt = Conexion::conectar()->prepare("SELECT 
                                        u.id_usuarios, u.contrasena, u.nombre, u.apellido, u.dni, u.email, u.tipo_usuario, t.descripcion as tipoUsuario, 
                                        h.telefono, h.direccion, h.usuarios_id_usuarios, h.id_huespedes
                                            -- IFNULL(H.telefono, '') AS telefono,
                                            -- IFNULL(H.direccion, '') AS direccion,
                                            -- IFNULL(H.estado_id_estado, '') AS estado_id_estado
                                        FROM 
                                        usuarios AS u
                                        INNER JOIN 
                                        tipo_usuarios AS t ON t.id_tipoUsuarios = u.tipo_usuario
                                        LEFT JOIN 
                                        huespedes AS h ON h.usuarios_id_usuarios = u.id_usuarios
                                         WHERE $item = :$item");
                //enlace de parametros
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        } else {

            try {
                $usuarios = Conexion::conectar()->prepare("SELECT u.id_usuarios, u.usuario, u.nombre, u.apellido, u.email, u.contrasena, u.dni, u.tipo_usuario, t.descripcion AS tipo FROM usuarios AS u 
                LEFT JOIN tipo_usuarios AS t ON t.id_tipoUsuarios = u.tipo_usuario");
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
            $usuarios = Conexion::conectar()->prepare("SELECT * FROM tipo_usuarios");
            $usuarios->execute();

            return $usuarios->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
        
    }

    static public function mdlAgregarUsuarios($datos)
    {
        try {
            // Iniciar la conexión y la transacción
            $conexion = Conexion::conectar();
            $conexion->beginTransaction();

            // Insertar en la tabla usuarios
            $stmtUsuario = $conexion->prepare("INSERT INTO usuarios (usuario, contrasena, nombre, apellido, email, tipo_usuario, dni) 
                                           VALUES (:usuario, :contrasena, :nombre, :apellido, :email, :tipo_usuario, :dni)");
            $stmtUsuario->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":tipo_usuario", $datos["tipo_usuario"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":dni", $datos["dni"], PDO::PARAM_STR);

            // Ejecutar y verificar si hubo un error
            if (!$stmtUsuario->execute()) {
                $conexion->rollBack();
                $errorInfo = $stmtUsuario->errorInfo();
                return "Error al insertar usuario: " . $errorInfo[2];  // Devuelve el mensaje de error
            }

            // Confirmar la transacción
            $conexion->commit();
            return "ok";
        } catch (PDOException $e) {
            // Capturar cualquier excepción y hacer rollback
            $conexion->rollBack();
            return "Error en la transacción: " . $e->getMessage();
        }
        
    }

    static public function mdlRegistrarUsuarios($datos)
    {
        try {
            // Iniciar la conexión y la transacción
            $conexion = Conexion::conectar();
            $conexion->beginTransaction();

            // Insertar en la tabla usuarios
            $stmtUsuario = $conexion->prepare("INSERT INTO usuarios (usuario, contrasena, nombre, apellido, email, tipo_usuario, dni) 
                                           VALUES (:usuario, :contrasena, :nombre, :apellido, :email, :tipo_usuario, :dni)");
            $stmtUsuario->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":tipo_usuario", $datos["tipo_usuario"], PDO::PARAM_STR);
            $stmtUsuario->bindParam(":dni", $datos["dni"], PDO::PARAM_STR);

            // Ejecutar y verificar si hubo un error
            if (!$stmtUsuario->execute()) {
                $conexion->rollBack();
                $errorInfo = $stmtUsuario->errorInfo();
                return "Error al insertar usuario: " . $errorInfo[2];  // Devuelve el mensaje de error
            }

            // Obtener el ID del usuario recién insertado
            $idUsuario = $conexion->lastInsertId();

            // Insertar en la tabla huespedes
            $stmtHuesped = $conexion->prepare("INSERT INTO huespedes (telefono, direccion, estado_id_estado, usuarios_id_usuarios) 
                                           VALUES (:telefono, :direccion, :id_estado, :id_usuario)");
            $stmtHuesped->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmtHuesped->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmtHuesped->bindParam(":id_estado", $datos["estado"], PDO::PARAM_INT);
            $stmtHuesped->bindParam(":id_usuario", $idUsuario, PDO::PARAM_INT);

            // Ejecutar y verificar si hubo un error
            if (!$stmtHuesped->execute()) {
                $conexion->rollBack();
                $errorInfo = $stmtHuesped->errorInfo();
                return "Error al insertar huesped: " . $errorInfo[2];  // Devuelve el mensaje de error
            }

            // Confirmar la transacción
            $conexion->commit();
            return "ok";
        } catch (PDOException $e) {
            // Capturar cualquier excepción y hacer rollback
            $conexion->rollBack();
            return "Error en la transacción: " . $e->getMessage();
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
