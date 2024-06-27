<!DOCTYPE html>
<html lang="es">

<head><!-- Encabezado del documento:Aquí se incluyen los metadatos del documento y se enlaza el archivo CSS externo.-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="../css/estiloprincipal.css">

<body>
    </head>
    <?php 
    include '../modelo/modelo.php';   
    ?>
    <div class="header"></div>
    <header>

        <!-- Imagen en el footer -->
        <img src="../img/Miami-Dolphins-Logo.png" alt="Texto Alternativo">
        <p><a href="../vista/principal.php">Inicio</a></p>
        <p><a href="../vista/usuario.php">Perfil</a></p>
        <p style="font-family:  Arial, Helvetica, sans-serif; color: orange;font-size: 20px;">Usuario:</p>
        <!-- Formulario de Login -->
        <?php
        session_start();
        if (isset($_SESSION["nombre_usuario"])) {
            // Si el nombre de usuario está en la sesión, muestra un mensaje de bienvenida
            echo '<p id="bienve">Bienvenido, <span>' . $_SESSION["nombre_usuario"] . '</span></p>';
        }
        ?>
        <!-- Botón de Registro -->
        <button id ="bedbo" onclick="location.href='../controladores/controladordesconectar.php';">LOGOUT</button>
        <button id ="bedbo" onclick="location.href='../vista/registro.php';">Registrarse</button>
    </header>

    <main>    
        <h2 >Editar Noticia  </h2>   
        <?php
    // Obtener el ID de la noticia de la URL
    $id_noticia= $_GET['id'];
    
    // Obtener los datos de la noticia por su ID
    $noticia = obtenerNoticiaPorId($id_noticia);
    
    if ($noticia) {
        // Mostrar el formulario de edición con los datos de la noticia
        echo '<form method="post" action="../controladores/controladorEditar.php "id="container">';
        echo '<input type="hidden" name="id_noticia" value="' . $noticia['id'] . '">';
        echo '<label for="titulo">Título:</label><br>';
        echo '<input type="text" id="titulo" name="titulo" value="' . $noticia['titulo'] . '" required><br>';
        echo '<label for="cuerpo">Cuerpo:</label><br>';
        echo '<textarea  id="cuerpo" name="cuerpo" rows="8" cols="60" required>' . $noticia['cuerpo'] . '</textarea><br>';
        echo '<input type="submit" value="Guardar" id="bedbo">';
        echo '</form>';
    } else {
        // Si no se encuentra la noticia, mostrar un mensaje de error
        echo 'Noticia no encontradaaaaa.';
    }
    ?>
        
        
        
        </section> 
    </div>
    
</body>