<?php 
    // Incluye el archivo de conexión y la función insertarNoticia
    require_once("../modelo/modelo.php");

    // Verifica si se recibió la solicitud AJAX
    // Verifica si se recibió la solicitud POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $autor = $_POST["autor"];
        $titulo = $_POST["titulo"];
        $cuerpo = $_POST["cuerpo"];
        $fecha = $_POST["fecha"];

        // Insertar la noticia
        $insertado = insertarNoticia($autor, $titulo, $cuerpo, $fecha);


        // Validar los datos del formulario
    if (empty($autor) || empty($titulo) || empty($cuerpo) || empty($fecha)) {
        echo '<script>
                alert("Por favor, complete todos los campos.");
                window.location.href = "../vista/usuario.php";
              </script>';
        exit();
    }

        if ($insertado) {
            // Si la noticia se inserta correctamente, redirigir a perfil.php
            echo '<script>
                    alert("Noticia insertada correctamente");
                    setTimeout(function() {
                        window.location.href = "../vista/usuario.php";
                    }, 500); // Redirecciona a ../vista/usuario.php después de 5 segundos
                  </script>';
            exit(); // Asegurar que el script se detiene después de mostrar la alerta
        } else {
            // Si hay un error al insertar la noticia, mostrar mensaje de error y redirigir a usuario.php
            echo '<script>
                    alert("Error al insertar la noticia. El autor no existe.");
                    setTimeout(function() {
                        window.location.href = "../vista/usuario.php";
                    }, 500); // Redirecciona a ../vista/usuario.php después de 5 segundos
                  </script>';
            exit(); // Asegurar que el script se detiene después de mostrar la alerta
        }
    }
?>
