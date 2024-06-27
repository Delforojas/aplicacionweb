<?php
// Incluir el archivo del modelo
require_once("../modelo/modelo.php");

// Verificar si se ha enviado el ID de la noticia a borrar
if (isset($_POST['id_noticia'])) {
    // Obtener el ID de la noticia desde el formulario
    $id_noticia = $_POST['id_noticia'];
    
    // Llamar a la función para borrar la noticia
    if (borrarNoticia($id_noticia)) {
        // Si se borra correctamente, redirigir de vuelta a la página de noticias
        header("Location: ../vista/usuario.php");
        exit(); // Asegurar que el script se detiene después de redirigir
    } else {
        // Si hay un error al borrar la noticia, mostrar un mensaje de error
        echo "Error al borrar la noticia.";
    }
} else {
    // Si no se ha enviado el ID de la noticia, mostrar un mensaje de error
    echo "ID de la noticia no proporcionado.";
}
?>