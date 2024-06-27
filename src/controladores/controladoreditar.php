<?php
    // Incluir el archivo del modelo
    require_once("../modelo/modelo.php");

    // Verificar si se ha enviado el formulario de edición
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se han enviado todos los datos necesarios
        if (isset($_POST['id_noticia'], $_POST['titulo'], $_POST['cuerpo'])) {
            // Obtener los datos del formulario
            $id_noticia = $_POST['id_noticia'];
            $titulo = $_POST['titulo'];
            $cuerpo = $_POST['cuerpo'];
            
            // Llamar a la función para editar la noticia
            if (editarNoticia($id_noticia, $titulo, $cuerpo)) {
                // Si se edita correctamente, redirigir a la página de noticias
                header("Location: ../vista/usuario.php");
                exit(); // Asegurar que el script se detiene después de redirigir
            } else {
                // Si hay un error al editar la noticia, mostrar un mensaje de error
                echo "Error al editar la noticia.";
            }
        } else {
            // Si no se han enviado todos los datos necesarios, mostrar un mensaje de error
            echo "Por favor, complete todos los campos.";
        }
    } else {
        // Si no se ha enviado el formulario de edición, mostrar el formulario para editar la noticia
        // Obtener el ID de la noticia de la URL
        $id_noticia = $_GET['id'];
        
        // Obtener los datos de la noticia por su ID
        $noticia = obtenerNoticiaPorId($id_noticia);
        
        if ($noticia) {
            // Mostrar el formulario de edición con los datos de la noticia
            echo '<form method="post" action="../controladores/controladorEditar.php">';
            echo '<input type="hidden" name="id_noticia" value="' . $noticia['id'] . '">';
            echo '<label for="titulo">Título:</label><br>';
            echo '<input type="text" id="titulo" name="titulo" value="' . $noticia['titulo'] . '" required><br>';
            echo '<label for="cuerpo">Cuerpo:</label><br>';
            echo '<textarea id="cuerpo" name="cuerpo" required>' . $noticia['cuerpo'] . '</textarea><br>';
            echo '<input type="submit" value="Editar">';
            echo '</form>';
        } else {
            // Si no se encuentra la noticia, mostrar un mensaje de error
            echo 'Noticia no encontrada.';
        }
    }
?>