<?php
session_start();
$usuario = $_SESSION["usuario"] ?? "El usuario"; // Si no existe la variable de sesion usuario devuelve "El usuario"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_unset();
    session_destroy();
}
?>

<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="../estilo/Cerrar_Sesion_estilophp.css">
</head>
<body>
<div class="caja"> 
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
  // Revisa que el REQUEST_METHOD del servidor web es POST, y ejecuta todo lo demas
  // Verificar si el campo nombre tiene algun nombre, (ES OBLIGATORIO, SI NO SE CUMPLE ESTE, LOS DEMÁS TAMPOCO)
  echo "<h2>" . $usuario . " ha cerrado sesión correctamente</h2>";
  echo "<img src='https://cdn.pixabay.com/photo/2024/06/03/14/48/thumbs-up-8806616_1280.png'>";
  echo "<br>";
  }
  ?>
<br>
<p>Volver al <a href="IniciarSesion.php" target="_blank"> inicio de sesión</a></p>

</div>
</body>
</html>