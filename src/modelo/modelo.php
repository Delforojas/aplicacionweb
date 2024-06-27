<?php
	require_once("../modelo/datos_conexion.php");

	function crearConexion($database) {
		// Establecemos la conexión con la base de datos
	    $conexion =	mysqli_connect(HOST,USER,PASSWORD,DATABASE);
		// Si hay un error en la conexión, lo mostramos y detenemos.
		if (!$conexion)
			die("<br>Error de conexión con la base de datos: " . mysqli_connect_error());
		// Si está todo correcto, enviamos la conexión con la base de datos.
		return $conexion;
	}
    function cerrarConexion($conexion) {
		mysqli_close($conexion);
	}
	function insertarUsuario($nombre, $email, $contrasena) {
        // Crear la conexión
        $DB = crearConexion(HOST, USER, PASSWORD, DATABASE);
        
        // Verificar si el nombre de usuario ya existe
        $sql_verificar = "SELECT nombre FROM usuario WHERE nombre = '$nombre'";
        $resultado_verificar = mysqli_query($DB, $sql_verificar);
        
        if (mysqli_num_rows($resultado_verificar) > 0) {
             cerrarConexion($DB);
            return false;
        } else {
            
            $sql_insertar = "INSERT INTO usuario (email, nombre, contrasena) VALUES ('$email', '$nombre', '$contrasena')";
            
            // Ejecutar la consulta de inserción
            if (mysqli_query($DB, $sql_insertar)) {
                cerrarConexion($DB);
                return true; // Éxito
            } else {
                echo "Error al insertar el usuario: " . mysqli_error($DB);
                cerrarConexion($DB);
                return false;
            }
        }
    }
        
    function verificarCredenciales($nombre, $contrasena) {
        // Crear la conexión a la base de datos
        $DB = crearConexion(HOST, USER, PASSWORD, DATABASE);
    
        // Consulta SQL para obtener la contraseña almacenada para el usuario dado
        $sql = "SELECT * FROM usuario WHERE nombre = '$nombre' and contrasena='$contrasena'";
    
        // Ejecutar la consulta
        $resultado = mysqli_query($DB, $sql);
        $filas=mysqli_num_rows($resultado);

        if($filas){
            mysqli_free_result($resultado);
            mysqli_close($DB);
            return true ;
        }else{
            mysqli_free_result($resultado);
            mysqli_close($DB);
            return false ;
           
        }
    
    }
    // Función para desconectar al usuario
    function desconectarUsuario() {
        // Verificar si se ha iniciado una sesión
        session_start();
        
        // Si existe una sesión activa, destrúyela
        if(isset($_SESSION["nombre_usuario"])) {
            session_unset();
            session_destroy();
            return true; // La sesión se cerró correctamente
        } else {
            return false; // No hay sesión activa para cerrar
        }
    }
    

    function insertarNoticia($id_autor, $titulo, $cuerpo, $fecha) {
        // Crear la conexión
        $conexion = crearConexion(HOST, USER, PASSWORD, DATABASE);
    
        // Verificar si el autor existe en la tabla de usuarios
        $resultado = mysqli_query($conexion, "SELECT id FROM usuario WHERE nombre = '$id_autor'");
        if(mysqli_num_rows($resultado) == 0) {
            
            return false;
        }
    
        // Obtener el ID del autor
        $fila = mysqli_fetch_assoc($resultado);
        $id_autor = $fila['id'];
    
        // Crear la consulta SQL para insertar la noticia
        $sql = "INSERT INTO noticia (id_autor, titulo, cuerpo, fecha) VALUES ('$id_autor', '$titulo', '$cuerpo', '$fecha')";
    
        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);
    
        if ($result) {
            cerrarConexion($conexion);
            return true; // Éxito
        } else {
            return false;
        }
    }



    function obtenerTodasLasNoticias() {
        // Crear la conexión
        $conexion = crearConexion(HOST, USER, PASSWORD, DATABASE);
        // Consulta SQL para obtener todas las noticias con el nombre del autor
        $sql = "SELECT noticia.*, usuario.nombre AS autor 
                FROM noticia 
                INNER JOIN usuario ON noticia.id_autor = usuario.id";
        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);
        // Verificar si la consulta fue exitosa
        if ($result) {
            // Array para almacenar las noticias
            $noticias = array();
    
            // Obtener cada fila de resultados
            while ($fila = mysqli_fetch_assoc($result)) {
                // Agregar la fila al array de noticias
                $noticias[] = $fila;
            }
            // Cerrar la conexión
            cerrarConexion($conexion);
            // Retornar las noticias
            return $noticias;
        } else {
            // Si hubo un error en la consulta, mostrar el mensaje de error y retornar false
            echo "Error al obtener las noticias: " . mysqli_error($conexion);
            cerrarConexion($conexion);
            return false;
        }
    }

    

        // Función para generar el listado de noticias en HTML
        function generarListadoDeNoticias() {
            // Recuperar las noticias desde la base de datos
            $noticias = obtenerTodasLasNoticias();
    
            // Generar el HTML dinámicamente
            $html = '';
            foreach ($noticias as $noticia) {
                $nombreAutor = obtenerNombreAutor($noticia['id_autor']);

                $html .= '<div class="noticia">';
                $html .= '<h2>' . $noticia['titulo'] . '</h2>';
                $html .= '<p>' . $noticia['cuerpo'] . '</p>';
                $html .= '<p>Autor: ' . $noticia['autor'] . '</p>';
                $html .= '<p>Fecha: ' . $noticia['fecha'] . '</p>';
                $html .= '</div>';
            }
    
            // Retornar el HTML generado
            return $html;
        }
        

        function borrarNoticia($id_noticia) {
            // Crear la conexión a la base de datos
            $conexion = crearConexion(HOST, USER, PASSWORD, DATABASE);
        
            // Escapar el ID de la noticia para evitar inyección SQL
            $id_noticia = mysqli_real_escape_string($conexion, $id_noticia);
        
            // Consulta SQL para borrar la noticia
            $sql = "DELETE FROM noticia WHERE id = '$id_noticia'";
        
            // Ejecutar la consulta
            if (mysqli_query($conexion, $sql)) {
                // Si se ejecuta correctamente, retornar true
                cerrarConexion($conexion);
                return true;
            } else {
                // Si hay un error, mostrar el mensaje de error y retornar false
                echo "Error al borrar la noticia: " . mysqli_error($conexion);
                cerrarConexion($conexion);
                return false;
            }
        }


        function editarNoticia($id_noticia, $titulo, $cuerpo) {
            // Crear la conexión a la base de datos
            $conexion = crearConexion(HOST, USER, PASSWORD, DATABASE);
            
            // Escapar los valores para evitar inyección SQL
            $id_noticia = mysqli_real_escape_string($conexion, $id_noticia);
            $titulo = mysqli_real_escape_string($conexion, $titulo);
            $cuerpo = mysqli_real_escape_string($conexion, $cuerpo);
            
            // Consulta SQL para actualizar la noticia
            $sql = "UPDATE noticia SET titulo = '$titulo', cuerpo = '$cuerpo' WHERE id = '$id_noticia'";
            
            // Ejecutar la consulta
            if (mysqli_query($conexion, $sql)) {
                // Si se ejecuta correctamente, retornar true
                cerrarConexion($conexion);
                return true;
            } else {
                // Si hay un error, mostrar el mensaje de error y retornar false
                echo "Error al editar la noticia: " . mysqli_error($conexion);
                cerrarConexion($conexion);
                return false;
            }
        }
        
        
 // Función para obtener una noticia por su ID
function obtenerNoticiaPorId($id_noticia) {
    // Crear la conexión a la base de datos
    $conexion = crearConexion(HOST, USER, PASSWORD, DATABASE);

    // Escapar el ID de la noticia para evitar inyección SQL
    $id_noticia = mysqli_real_escape_string($conexion, $id_noticia);

    // Consulta SQL para obtener la noticia por su ID
    $sql = "SELECT * FROM noticia WHERE id = '$id_noticia'";

    // Ejecutar la consulta
    $resultado = mysqli_query($conexion, $sql);

    // Verificar si se encontró la noticia
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Obtener los datos de la noticia
        $noticia = mysqli_fetch_assoc($resultado);

        // Cerrar la conexión a la base de datos
        cerrarConexion($conexion);

        // Retornar los datos de la noticia
        return $noticia;
    } else {
        // Si no se encuentra la noticia, retornar null
        return null;
    }
}
function obtenerNoticiasOrdenadasPorFecha($orden = 'DESC') {
    // Crear la conexión a la base de datos (reemplaza HOST, USER, PASSWORD y DATABASE con tus propias credenciales)
    $conexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    
    // Verificar la conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Consulta SQL para obtener todas las noticias ordenadas por fecha
    $sql = "SELECT * FROM noticia ORDER BY fecha $orden";

    // Ejecutar la consulta
    $resultado = mysqli_query($conexion, $sql);

    // Verificar si hay resultados
    if (mysqli_num_rows($resultado) > 0) {
        // Array para almacenar las noticias
        $noticias = array();

        // Recorrer los resultados y guardarlos en el array de noticias
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $noticias[] = $fila;
        }

        // Liberar memoria del resultado y cerrar la conexión
        mysqli_free_result($resultado);
        mysqli_close($conexion);

        // Retornar el array de noticias
        return $noticias;
    } else {
        // Si no hay noticias, retornar un array vacío
        mysqli_close($conexion);
        return array();
    }
}
?>