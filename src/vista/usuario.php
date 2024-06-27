<?php 	
    include '../controladores/controlador.php';
    include '../controladores/controladorlistadousuario.php';
    ?>
<!DOCTYPE html>
<html lang="es">
<head><!-- Encabezado del documento:Aquí se incluyen los metadatos del documento y se enlaza el archivo CSS externo.-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="../css/estiloprincipal.css">
</head>
<div class="header"></div>
<header>
   
        <!-- Imagen en el footer -->
        <img src="../img/Miami-Dolphins-Logo.png" alt="Texto Alternativo">
        <p><a href="../vista/principal.php">Inicio</a></p>
        
        <?php
        session_start();
        if (isset($_SESSION["nombre_usuario"])) {
            // Si el nombre de usuario está en la sesión, muestra un mensaje de bienvenida
            echo '<p id ="bienve" >Bienvenido, ' . $_SESSION["nombre_usuario"] . '</p>';
        }
        ?>

        
        <!-- Formulario de Login -->


        

        <!-- Botón de Registro -->
        <button onclick="location.href='../controladores/controladordesconectar.php';"id="bedbo">LOGOUT</button>
        <button onclick="location.href='../vista/registro.php';"id="bedbo">Registrarse</button>
       
</header>

</div>
<footer>
        <!-- Aquí se colocarán los botones -->
        <div class="botones">
            <button onclick="location.href='../vista/perfil.php';"id="bedbo">Añadir noticia</button>
        </div>
<main>

   <section>
    
   
        <h2>Listado de Noticias</h2>
        <ol >
              <?php echo $listadoDeNoticiasHTML; ?>
        </ol>
   
    </section>

</main>
</body>   