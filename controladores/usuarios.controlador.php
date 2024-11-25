<?php

class ControladorUsuarios
{
    /*=============================================
INGRESO DE USUARIO
=============================================*/
//     static public function ctrIngresoUsuario()
//     {
// //         if (isset($_POST["email"])) {

// //             if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][azA-Z0-9_]+)*[.][a-zAZ]{2,4}$/', $_POST["email"])) {

// //                 $encriptar = crypt(trim($_POST["password"]), '$2a$07$tawfdgyaufiusdgopfhgjxerctyuniexrcvrdtfyg$');

// //                 $item = "email";

// //                 $valor = $_POST["email"];
// //                 $respuesta = ModeloUsuarios::mdlMostrarUsuarios(
// //                     $item,
// //                     $valor
// //                 );

// //                 if (is_array($respuesta) && ($respuesta["email"] ==
// //                     $_POST["email"] && $respuesta["password"] == $encriptar)) {

// //                     echo '<script>
// //                         fncSweetAlert("loading", "Ingresando..", "")
// //                         </script>';

// //                     $_SESSION["iniciarSesion"] = "ok";
// //                     $_SESSION["id_usuario"] = $respuesta["id_usuario"];
// //                     $_SESSION["nombre"] = $respuesta["nombre"];

// //                     echo '<script>
// //                     window.location = "home";
// //                     </script>';
// //                 } else {
// //                     echo '<div class="alert alert-danger mt-3" role="alert">
// // Error al intentar acceder
// // </div>
// //                     ';
// //                 }
// //             }
// //         }
// //     }
    static public function ctrMostrarUsuarios($item, $valor)
    {
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($item, $valor);
        return $respuesta;
    }
}
