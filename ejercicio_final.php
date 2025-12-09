<?php 
// Crea la sesión y establezco las variables
session_start();
$suma = 0;
$dado1 = 0;
$dado2 = 0;
$pa = 0;
$vu = "";
$objetivo = "";
$comparacion = "";

// Si el valor del usuario (vu) está vacio imprime que esta vacio.
// Si tiene un número lo mete dentro de una variable y llama a la funcion de comparacion
if ((empty($_POST["vu"])) || (!is_numeric($_POST["vu"]))) {
    $vu = "Debes de introducir un número.";
}
else {
    $vu = $_POST["vu"];
    $objetivo = "Objetivo introducido:";
}

function tirar() { // Calcula los números de los dados
    $dado1 = rand(1,6);
	$dado2 = rand(1,6);
	$suma = $dado1 + $dado2;
	return [$suma, $dado1, $dado2];
}

[$suma, $dado1, $dado2]= tirar();

if (!isset($_SESSION['acumulador'])) {
    $_SESSION['acumulador'] = 0;
}
$_SESSION['acumulador'] += $suma;

// Calcular si la suma es par o impar
function calcular_par($suma) {
    if ($suma % 2 == 0) {
        return True;
    }
    else {
        return False;
    }
}

$par = calcular_par($suma);

// Si es par imprime que es par y viceversa
function comprobar_par($par) {
    if ($par) {
        echo "El numero es par";
    }
    else {
        echo "El numero no es par";
    }
}

// Compara si la suma y el valor del usuario ($vu) son iguales o diferentes
function comparacion($suma,$vu) {
    if ($suma < $vu){
        $comparacion = "La puntuación de los dados es menor que el objetivo";
        return $comparacion;
    }
    elseif ($suma > $vu) {
        $comparacion = "La puntuación de los dados es mayor que el objetivo";
        return $comparacion;
    } 
    else {
        $comparacion = "La puntuación de los dados es igual que la del objetivo";
        return $comparacion;
    }
}
$comparacion = comparacion($suma,$vu);

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
                echo "$objetivo "."$vu";
                echo "<br>";
                echo "<h3>Has lanzado los dados</h3>";
                echo "<br>";
                echo "DADO 1: $dado1";
                echo "<br>";
                echo "DADO 2: $dado2";
                echo "<br>";           
                echo "Suma total: $suma";
                echo "<br>";
                echo "$comparacion";
                echo "<br>";
                comprobar_par($par);
                echo "<br>";
                echo "Puntuación acumulada: " . $_SESSION["acumulador"];
            ?>
        </form>
    <?php endif; //Final del if?>
</body>
</html>