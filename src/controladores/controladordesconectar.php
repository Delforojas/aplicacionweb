<?php
    // Incluir el archivo que contiene la función para desconectar al usuario
    require_once("../modelo/modelo.php");
    
    // Llamar a la función para desconectar al usuario
    desconectarUsuario();
    
    // Alerta de cierre de sesión durante 2 segundos
    echo '<script>
            setTimeout(function() {
                alert("Sesión cerrada satisfactoriamente.");
            }, 500); // Espera 2 segundos antes de mostrar la alerta
          </script>';
    
    // Redireccionar al usuario a la página principal después de 2 segundos
    header("Refresh: 2; URL=../vista/principal.php");
    exit();
?>