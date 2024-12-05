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
        var_dump($_SESSION);
        if (isset($_POST["email"]) && isset($_POST["contra"])) {
            // Validar el formato del email
            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $item = "email";
                $valor = $_POST["email"];
                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($item, $valor);

                if ($respuesta && password_verify(trim($_POST["contra"]), $respuesta["contrasena"])) {
                    var_dump($respuesta);
                    // Establecer variables de sesión
                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["id_usuarios"] = $respuesta["id_usuarios"];
                    $_SESSION["nombre"] = $respuesta["nombre"];
                    $_SESSION["apellido"] = $respuesta["apellido"];
                    $_SESSION["email"] = $respuesta["email"];
                    $_SESSION["tipo_usuario"] = $respuesta["tipoUsuario"];
                    

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
                    "dni" => $_POST["dni"],
                    "tipo_usuario" => $_POST["tipo"]
                );

                $respuesta = ModeloUsuarios::mdlAgregarUsuarios($datos);

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
       // Verificar si el formulario ha sido enviado
       if (isset($_POST["email"]) && isset($_POST["contrasena"]) && isset($_POST["usuario"])) {
        // var_dump($_POST);
        // Validar el formato del email
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

            // Encriptar la contraseña
            $contra_encriptada = password_hash(trim($_POST["contrasena"]), PASSWORD_DEFAULT);

            $datos = array(
                "usuario" => $_POST["usuario"],
                "email" => $_POST["email"],
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "contrasena" => $contra_encriptada,
                "dni" => $_POST["dni"],
                "telefono" => $_POST["telefono"],
                "direccion" => $_POST["direccion"],
                "estado" => 1,
                "tipo_usuario" => 3
            );

            // Llamada al modelo para agregar el usuario
            $respuesta = ModeloUsuarios::mdlRegistrarUsuarios($datos);

            // Redirigir si la respuesta es ok
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
            // Si el email no es válido, mostrar el mensaje de error
            echo '<div class="alert alert-danger mt-3" role="alert">
                Formato de email no válido
            </div>';
        }
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
