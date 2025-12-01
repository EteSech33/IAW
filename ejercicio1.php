<?php 
session_start();
// Crea la sesion "iniciar_sesion"
$puntuacion=10;

function tirar() {
echo"estoy dentro de la funcion tirar";
    $dado1 = rand(1,6);
	$dado2 = rand(1,6);
	$suma = $dado1 + $dado2;
	return [$suma, $dado1, $dado2];
}

[$suma, $dado1, $dado2]= tirar();

function calcular_par($suma) {
    echo"$suma dentro de calcluar par vale".$suma;
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
<title>Calculadora</title>
<link rel="stylesheet" href="../estilo/ejercicio1.css">
</head>

<body>
    <?php if ($_SERVER["REQUEST_METHOD"] =! "POST"): // IF que escriba html, en vez de php?>
    
        <h1>ERROR</h1>

    <?php else: ?>

        <form action="<?= (htmlspecialchars($_SERVER["PHP_SELF"])); //El php se escribe en el propio documento.?>" method="post">
            <p>pollo</p>
            <input type="radio" name="paridad" value="Inpar">Inpar
            <input type="radio" name="paridad" value="Par">Par
            <?php
                echo "La suma es: $suma";
                echo "<br>";
                comprobar_par($par);
            ?>
        </form>

    <?php endif; //Final del if?>
</body>
</html>