<?php 
session_start();
// Crea la sesion "iniciar_sesion"

?>

<!DOCTYPE HTML>  
<html>
<head>
    <link rel="stylesheet" href="../estilo/Iniciar_Sesion_estilophp.css">
</head>

<body>
    <div class="caja"> 
    <h2>Formulario de inicio de sesión</h2>
    <form action="Panel.php" method="POST">
    <h3>Inciar sesión</h3>
    <p>Nombre de usuario: <input type="text" name="usuario" placeholder="Introduce tu nombre"></p>
    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $usuario = htmlspecialchars(stripslashes(trim($_SESSION["usuario"],"/")));
    
    echo "<h2>Datos respuesta:</h2>";
    echo "Nombre: $usuario";
    echo "<br>";

    }
    ?>
    <input type="submit" name="submit" value="Iniciar Sesión">
    <p>Direccionamiento a <a href="../index.html" target="_blank">Volver al principio.</a></p>
    </div>
</body>
</html>