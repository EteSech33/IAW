<?php 
session_start();
// Crea la sesion "iniciar_sesion"
$puntuacion = 10;
$suma = 0;
$dado1 = 0;
$dado2 = 0;
$pa = 0;
$vu = "";

if (empty($_POST["vu"])){
    $vu = "Debes de introducir un número.";
}

function tirar() { // Calcula los números de los dados
    $dado1 = rand(1,6);
	$dado2 = rand(1,6);
	$suma = $dado1 + $dado2;
	return [$suma, $dado1, $dado2];
}

if (empty($dado1)) {
    [$suma, $dado1, $dado2]= tirar();
}

function calcular_par($suma) {
    if ($suma % 2 == 0) {
        return True;
    }
    else {
        return False;
    }
}

$par = calcular_par($suma);

function comprobar_par($par) {
    if ($par) {
        echo "El numero es par";
    }
    else {
        echo "El numero no es par";
    }
}



?>

<!DOCTYPE html>
<head>
<title>Dados</title>
<link rel="stylesheet" href="../estilo/ejercicio1.css">
</head>

<body>
    <h1>9. Ejercicio final: Funciones, Números Aleatorios y Control de Sesiones en PHP con Interacción del Usuario</h1>
    <?php if ($_SERVER["REQUEST_METHOD"] =! "POST"): // IF que escriba html, en vez de php?>
    
        <h1>ERROR</h1>

    <?php else: ?>

        <form action="<?= (htmlspecialchars($_SERVER["PHP_SELF"])); //El php se escribe en el propio documento.?>" method="post">
            <p>Objetivo: <input type="text" name="vu" placeholder="Número"> <input type="submit" name="submit" value="Enviar"></p>
            <?php
                echo "<h3>Has lanzado los dados</h3>";
                echo "<br>";
                echo "DADO 1: $dado1";
                echo "<br>";
                echo "DADO 2: $dado2";
                echo "<br>";           
                echo "Suma total: $suma";
                echo "<br>";
                comprobar_par($par);
                echo "<br>";
                echo"$vu";
                echo "<br>";
                echo "Puntuación acumulada: $pa";
            ?>
        </form>
        

    <?php endif; //Final del if?>
</body>
</html>