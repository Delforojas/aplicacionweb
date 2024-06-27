
<?php
    include '../controladores/controlador.php';
    include '../controladores/controladornoticias.php';
?>


<!DOCTYPE html>
<html lang="es">

<head><!-- Encabezado del documento:Aquí se incluyen los metadatos del documento y se enlaza el archivo CSS externo.-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="../css/estiloprincipal.css">
</head>
<body>
    
    <div class="header"></div>
    <header>
   
        <!-- Imagen en el footer -->
        <img src="../img/Miami-Dolphins-Logo.png" alt="Texto Alternativo">
        <p><a href="../vista/principal.php">Inicio</a></p>
        
        <!-- Formulario de Login -->
        <?php
        session_start();
        if (isset($_SESSION["nombre_usuario"])) {
            // Si el nombre de usuario está en la sesión, muestra un mensaje de bienvenida
            echo '<p>Bienvenido, ' . $_SESSION["nombre_usuario"] . '</p>';
        }
        ?>

        

        <!-- Botón de Registro -->
        <button id="bedbo" onclick="location.href='../controladores/controladordesconectar.php';">LOGOUT</button>
        <button id="bedbo" onclick="location.href='../controladores/registro.php';">Registrarse</button>
       
</header>
    <main>    
        <h2 >Añadir noticia  </h2>

        <section id= "container">
        <form action="../controladores/controladornoticias.php" method="post">
            
            <label for="titulo">Título:</label><br>
            <input type="text" id="titulo" name="titulo" required><br>

            <label for="autor">Autor:</label><br>
            <input type="text" id="autor" name="autor" required><br>

            <label for="cuerpo">Cuerpo:</label><br>
            <textarea id="cuerpo" name="cuerpo" required></textarea><br>

            <label for="fecha">Fecha:</label><br>
            <input type="date" id="fecha" name="fecha" required><br><br>
            
            <input type="submit" value="Añadir Noticia" id="bedbo">
            
        </form>
        </section>
    </main>
</body>




