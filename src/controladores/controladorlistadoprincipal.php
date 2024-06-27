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
                $html .= '<h2>Noticia : ' . $noticia['titulo'] . '</h2>';
                $html .= '<p>' . $noticia['cuerpo'] . '</p>';
                $html .= '<p class="autor">Autor : ' . $noticia['autor'] . '</p>';
                $html .= '<p class="fecha">Fecha : ' . $noticia['fecha'] . '</p>';               
                $html .= '</div>';
            }

            // Retornar el HTML generado
            return $html;
        }
    }
    
    // Llamar a la función para generar el listado de noticias en HTML
    $listadoDeNoticiasPrincipalHTML = generarListadoDeNoticiasEnHTML();

    // Incluir la vista que mostrará el listado de noticias
    require_once("../vista/principal.php");
?>
