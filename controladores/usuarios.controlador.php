<?php

class ControladorUsuarios
{
    /*=============================================
    INGRESO DE USUARIO
    =============================================*/
    static public function ctrIngresoUsuario()
    {
        // Iniciar la sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST["email"]) && isset($_POST["contra"])) {
            // Validar el formato del email
            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $item = "email";
                $valor = $_POST["email"];
                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($item, $valor);

                if ($respuesta && password_verify(trim($_POST["contra"]), $respuesta["contrasena"])) {
                    // Establecer variables de sesión
                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["id_usuario"] = $respuesta["id_usuario"];
                    $_SESSION["nombre"] = $respuesta["nombre"];
                    $_SESSION["apellido"] = $respuesta["apellido"];
                    $_SESSION["email"] = $respuesta["email"];
                    $_SESSION["tipo_usuario"] = $respuesta["tipo"];

                    echo '<script>
                            window.location.href = "' . ControladorPlantilla::url() . 'home";
                        </script>';
                } else {
                    echo '<div class="alert alert-danger mt-3" role="alert">
                        Usuario o contraseña incorrectos
                    </div>';
                }
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">
                    Formato de email no válido
                </div>';
            }
        }
    }

    static public function ctrAgregarUsuario()
    {
        if (isset($_POST["email"]) && isset($_POST["contra"]) && isset($_POST["usuario"])) {
                $tabla = "usuarios";

                // Encriptar la contraseña
                $contra_encriptada = password_hash(trim($_POST["contra"]), PASSWORD_DEFAULT);

                $datos = array(
                    "usuario" => $_POST["usuario"],
                    "contrasena" => $contra_encriptada,
                    "email" => $_POST["email"],
                    "nombre" => $_POST["nombre"],
                    "apellido" => $_POST["apellido"],
                    "tipo_usuario" => $_POST["tipo"]
                );

                $respuesta = ModeloUsuarios::mdlAgregarUsuarios($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                            window.location.href = "' . ControladorPlantilla::url() . 'usuarios";
                        </script>';
                } else {
                    echo '<div class="alert alert-danger mt-3" role="alert">
                        Error al registrar el usuario
                    </div>';
                }
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">
                    Formato de email no válido
                </div>';
            }
        }

    /*=============================================
    REGISTRO DE USUARIO
    =============================================*/
    static public function ctrRegistrarUsuario()
    {
        if (isset($_POST["email"]) && isset($_POST["contra"]) && isset($_POST["usuario"])) {

                // Encriptar la contraseña
                $contra_encriptada = password_hash(trim($_POST["contra"]), PASSWORD_DEFAULT);

                $datos = array(
                    "usuario" => $_POST["usuario"],
                    "contrasena" => $contra_encriptada,
                    "email" => $_POST["email"],
                    "nombre" => $_POST["nombre"],
                    "apellido" => $_POST["apellido"],
                    "tipo_usuario" => null
                );

                $datosHuesped = array(
                    "dni" => $_POST["dni"],
                    "telefono" => $_POST["telefono"],
                    "direccion" => $_POST["direccion"],
                    "id_estado" => $_POST["estado"]
                );

                $respuesta = ModeloUsuarios::mdlAgregarUsuarios($datos, $datosHuesped);

                if ($respuesta == "ok") {
                    echo '<script>
                            window.location.href = "' . ControladorPlantilla::url() . 'login";
                        </script>';
                } else {
                    echo '<div class="alert alert-danger mt-3" role="alert">
                        Error al registrar el usuario
                    </div>';
                }
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">
                    Formato de email no válido
                </div>';
            }
        }

        static public function ctrEditarUsuarios()
        {
            $tabla = "usuarios";
    
            if (isset($_POST["id_usuario"])) {
                
                    
                $contra_encriptada = password_hash($_POST["contra"], PASSWORD_DEFAULT);
    
                $datos = array(
                    "usuario" => $_POST["usuario"],
                    "contrasena" => $contra_encriptada,
                    "nombre" => $_POST["nombre"],
                    "apellido" => $_POST["apellido"],
                    "email" => $_POST["email"],
                    "tipo_usuario" => $_POST["tipo"],
                    "id_usuario" => $_POST["id_usuario"]
    
                );
    
                $respuesta = ModeloUsuarios::mdlEditarUsuarios($tabla, $datos);
                
                if ($respuesta == "ok") {
                    echo '<script>
                            window.location.href = "' . ControladorPlantilla::url() . 'usuarios";
                        </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Hubo un error al editar el usuario",
                            text: "Por favor, inténtalo de nuevo",
                            confirmButtonText: "Aceptar"
                        });
                    </script>';
                }
            }
        }
        static public function ctrEliminarUsuarios()
        {
            if (isset($_GET["id_usuario"])) {
    
                $tabla = "usuarios";
                $datos = $_GET["id_usuario"];
    
                $respuesta = ModeloUsuarios::mdlEliminarUsuarios($tabla, $datos);
    
                if ($respuesta == "ok") {
                    echo '<script>
                            window.location.href = "' . ControladorPlantilla::url() . 'usuarios";
                        </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Hubo un error al eliminar el usuario",
                            text: "Por favor, inténtalo de nuevo",
                            confirmButtonText: "Aceptar"
                        });
                    </script>';
                }
            }
        }

    /*=============================================
    MOSTRAR USUARIOS
    =============================================*/
    static public function ctrMostrarUsuarios($item, $valor)
    {
        return ModeloUsuarios::mdlMostrarUsuarios($item, $valor);
    }

    static public function ctrMostrarTipoUsuario()
    {
        return ModeloUsuarios::mdlMostrarTipoUsuario();
    }
}
?>
