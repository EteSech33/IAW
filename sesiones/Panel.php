<?php 
session_start();
$_SESSION["usuario"] = $_POST["usuario"];
?>
<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="../estilo/Iniciar_Sesion_estilophp.css">
</head>
<body>
<form action="calculadora.php" method="POST">
<div class="caja">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["usuario"])) {
                echo"<h1>Error: El nombre de usuario es obligatorio.</h1>";
            }
            else{
                echo"<h1>¡Has iniciado sesión!</h1>";
                echo "<br>";
                echo "<h2>Bienvenido {$_POST["usuario"]} </h2>";
                echo "<br>";
                echo "<a href='calculadora.php'>Acceder a la calculadora</a>";
                echo "<br>";
                echo "<a href='calculadora.php'><img src='https://cdn.pixabay.com/photo/2016/10/06/19/03/calculator-1719738_1280.png' class='calculadora_sesion' ></a>";
                echo "<br>";
                echo "<br>";
                
            }
        }
        ?>
<p>Direccionamiento a <a href="IniciarSesion.php" target="_blank">Volver a la página incial.</a></p>
</div>

</body>
</html>