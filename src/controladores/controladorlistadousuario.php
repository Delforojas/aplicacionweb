<?php
// Incluir el archivo del modelo
require_once("../modelo/modelo.php");

// Verificar si las funciones ya están definidas antes de definirlas nuevamente
if (!function_exists('obtenerTodasLasNoticiasDesdeModelo')) {
    // Función para obtener todas las noticias desde el modelo
    function obtenerTodasLasNoticiasDesdeModelo() {
        return obtenerTodasLasNoticias();
    }
}

if (!function_exists('generarListadoDeNoticiasEnHTML')) {

    // Función para generar el listado de noticias en HTML
    function generarListadoDeNoticiasEnHTML() {
        // Recuperar las noticias desde el modelo
        $noticias = obtenerTodasLasNoticiasDesdeModelo();

        // Generar el HTML dinámicamente
        $html = '';
        foreach ($noticias as $noticia) {
            $html .= '<div class="noticia">';
            $html .= '<h2>' . $noticia['titulo'] . '</h2>';
            $html .= '<p>' . $noticia['cuerpo'] . '</p>';
            $html .= '<p class="autor">Autor: ' . $noticia['autor'] . '</p>';
            $html .= '<p class="fecha">Fecha:  ' . $noticia['fecha'] . '</p>';
            
            // Botón de editar que lleva a la vista de edición
            $html .= '<form method="get" action="../vista/editarnoticia.php">';
            $html .= '<input type="hidden" name="id" value="' . $noticia['id'] . '">';
            $html .= '<button type="submit" id="bedbo"class="editar">Editar</button>';
            $html .= '</form>';

            // Formulario para borrar la noticia
            $html .= '<form method="post" action="../controladores/controladorborrar.php">';
            $html .= '<input type="hidden" name="id_noticia" value="' . $noticia['id'] . '">';
            $html .= '<button type="submit" id="bedbo" class="editar">Borrar</button>';
            $html .= '</form>';
            $html .= '</div>';
        }

        // Retornar el HTML generado
        return $html;
    }
}

// Llamar a la función para generar el listado de noticias en HTML
$listadoDeNoticiasHTML = generarListadoDeNoticiasEnHTML();

// Incluir la vista que mostrará el listado de noticias
require_once("../vista/usuario.php");
?>

