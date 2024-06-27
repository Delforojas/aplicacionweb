
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
        
        <!-- Formulario de Login -->


        <form action="../controladores/controladorlogin.php" method="post" class="formulario-en-linea">
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="password" name="contrasena" placeholder="Contraseña">
            <button type="submit" id="bedbo">Login</button>
        </form>

        <!-- Botón de Registro -->
        
        <button onclick="location.href='../vista/registro.php';" id="bedbo">Registrarse</button>

</header>
</div>
<?php
    include '../controladores/controlador.php';
    include '../controladores/controladorlistadoprincipal.php';
    
?>


<form action="controladorOrdenarFecha.php" method="get">
    <label for="ordenar">Ordenar por:</label>
    <select name="ordenar" id="ordenar">
        <option value="autor">Autor</option>
        <option value="fecha">Fecha</option>
        <option value="titulo">Título</option>
    </select>
    <button type="submit">Ordenar</button>
</form>
<main>
<section>
        <header1>
        <h2>Listado de Noticias</h2>
        <ol class="noticias-list">
            <?php echo $listadoDeNoticiasPrincipalHTML; ?>      
        </ol>
</section>
</main>
</body>  

