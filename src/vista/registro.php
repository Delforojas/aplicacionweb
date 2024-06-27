<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="../css/estiloprincipal.css">
</head>
<body>
</head>

<div class="header"></div>
<header>
        <!-- Imagen en el footer -->
        <img src="../img/Miami-Dolphins-Logo.png" alt="Texto Alternativo">
        <p><a href="../vista/principal.php">Inicio</a></p>
        
        

        <!-- Formulario de Login -->
        

        <form action="../controladores/controladorlogin.php"class="formheader" method="post" >
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="password" name="contrasena" placeholder="Contraseña">
            <button type="submit" id="bedbo">Login</button>
        </form>

</form>


</header>
</div>
<?php 
		include '../controladores/controlador.php';
?>

<h2 >Registro de Usuario</h2>
<section class="container">
    
    <form action="../controladores/controlador.php" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        
        <input type="submit" id="bedbo" value="Registrarse">
    </form>
</section>
</body>
</html>
