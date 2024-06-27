<?php
session_start();

// Incluye el archivo que contiene la función verificarCredenciales
require_once("../modelo/modelo.php");

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener las credenciales del formulario
    $nombre = $_POST["nombre"];
    $contrasena = $_POST["contrasena"];

    // Verificar las credenciales utilizando la función verificarCredenciales
    if (verificarCredenciales($nombre, $contrasena)) {
        // Si las credenciales son correctas, guarda el nombre de usuario en una sesión
        $_SESSION["nombre_usuario"] = $nombre;

        // Redirige a la página de usuario
        header("Location: ../vista/usuario.php");
        exit();
    } else {
        // Muestra el mensaje de alerta y redirige después de 2 segundos
        echo '<script>
                alert("Contraseña incorrecta. Por favor, inténtalo de nuevo.");
                setTimeout(function() {
                    window.location.href = "../vista/principal.php";
                }, 800); // Espera 2 segundos antes de redirigir
              </script>';
        exit(); // Salimos del script después de mostrar la alerta
    }
}
?>
