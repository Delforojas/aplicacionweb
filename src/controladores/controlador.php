
<?php
    // Incluye el archivo que contiene la función insertarUsuario
    require_once("../modelo/modelo.php");

    // Verifica si se ha enviado un formulario POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtiene los datos del formulario
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $contrasena = $_POST["contrasena"];

        // Inserta el usuario en la base de datos
    if (insertarUsuario($nombre, $email, $contrasena)) {
        // Redirige a una página de éxito o muestra un mensaje de éxito
        echo '<script>
                alert("Usuario registrado correctamente");
                window.location.href = "../vista/principal.php";
              </script>';
        exit();
    } else {
        // Muestra un mensaje de error
        echo '<script>
              alert("Este nombre de usuario ya está en uso.Prueba con otro ");
              window.location.href = "../vista/registro.php";
              </script>';
    }
}
?>