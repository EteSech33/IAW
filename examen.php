<?php
session_start();

/*  __      __        _       _     _
    \ \    / /       (_)     | |   | |
     \ \  / /_ _ _ __ _  __ _| |__ | | ___  ___
      \ \/ / _` | '__| |/ _` | '_ \| |/ _ \/ __|
       \  / (_| | |  | | (_| | |_) | |  __/\__ \
        \/ \__,_|_|  |_|\__,_|_.__/|_|\___||___/
*/
/*
   Si el array de $_SESSION['vista'] no existe,
   entonces pone todo a null, haciendo que no haya errores
   de que las variables no están definidas
*/
$vista = $_SESSION['vista'] ?? null;

if ($vista) {
    $valor_usuario = $vista['valor_usuario'];
    $dado1 = $vista['dado1'];
    $dado2 = $vista['dado2'];
    $suma = $vista['suma'];
    $mensaje_comprobar = $vista['mensaje_comprobar'];
    $eleccion = $vista['eleccion'];
    $coger_paridad = $vista['paridad'];
    $var_paridad = $vista['var_paridad'];

}
$error=null;
$reiniciar_juego = null;
$var_paridad = null;
$comprobar_juego = false;



if ($_SERVER["REQUEST_METHOD"] == "POST"){ // IF que escriba html, en vez de php
/*
    ______                 _
    |  ____|              (_)
    | |__ _   _ _ __   ___ _  ___  _ __   ___  ___
    |  __| | | | '_ \ / __| |/ _ \| '_ \ / _ \/ __|
    | |  | |_| | | | | (__| | (_) | | | |  __/\__ \
    |_|   \__,_|_| |_|\___|_|\___/|_| |_|\___||___/

*/
// Calcular si la suma es par o impar
function calcular_par($suma) {
    if ($suma % 2 == 0) {
        return True;
    }
    else {
        return False;
    }
}

function tirar() { // Calcula los números de los dados
    $dado1 = rand(1,6);
	$dado2 = rand(1,6);
	$suma = $dado1 + $dado2;
	return [$suma, $dado1, $dado2];
}

// Comprueba que el numero $suma sea par o impar
function imprimir_paridad($paridad){
    if ($paridad) {
        $mensaje_comprobar = "El número es Par.";
        return $mensaje_comprobar;
    }
    else {
        $mensaje_comprobar = "El número es Impar.";
        return $mensaje_comprobar;
    }
}

/*
      _ _    _ ______ _____  ____
     | | |  | |  ____/ ____|/ __ \
     | | |  | | |__ | |  __| |  | |
 _   | | |  | |  __|| | |_ | |  | |
| |__| | |__| | |___| |__| | |__| |
 \____/ \____/|______\_____|\____/

*/

// Si la puntuación no existe, crea una. Y si existe y es 20 o 0 acaba el juego
if (!isset($_SESSION['puntuacion'])) {
    $_SESSION['puntuacion'] = 10;
    $_SESSION['jugar'] = true;
}
elseif ($_SESSION['puntuacion'] >= 20 || $_SESSION['puntuacion'] <= 0) {
    $_SESSION['jugar'] = false;
}
else {
    $_SESSION['jugar'] = true;
}

// Si se pulsa el boton reiniciar reinicia el juego entero
if (isset($_POST['reiniciar'])) {
    $_SESSION['puntuacion'] = 10;
    $_SESSION['jugar'] = true;
    $valor_usuario = null;
    $dado1 = null;
    $dado2 = null;
    $suma = null;
    $mensaje_comprobar = null;
    $eleccion = null;
    $coger_paridad = null;
    $var_paridad = null;
    $error = null;
    $reiniciar_juego = "Pulsa el botón reiniciar para jugar de nuevo.";
}

// Si la varialbe de sesion jugar es true entonces se puede jugar
if ($_SESSION["jugar"]) {

    [$suma, $dado1, $dado2]= tirar();
    $paridad = calcular_par($suma);

    // Comprueba si se ha seleccionado paridad e introducido un numero, si es el caso, sale un error.
    if (isset($_POST['submit'])) {
        if (!empty($_POST["coger_paridad"]) && !empty($_POST["valor_usuario"])) {
            $error = "No se pueden elegir ambas opciones a la vez.";
            $comprobar_juego=false;
        }
        else {
            $comprobar_juego=true;
        }
    }

    /*  Si $_POST["valor_usuario"] no tiene valor dice que hay que poner numero.
        Si tiene algun valor, comprueba que sea numerico, si no es numerico
        Luego comprueba que ese número sea enteros entre 2 y 12
    */
    if ($comprobar_juego){
        if (isset($_POST["valor_usuario"])){            // Comprueba que hay input del usuario
            if (!is_numeric(htmlspecialchars($_POST["valor_usuario"]))) { // Comprueba que el valor es un número
                $valor_usuario = "No has introducido un número.";
            }
            else {
                if ($_POST["valor_usuario"] >= 2 && $_POST["valor_usuario"] <= 12) {    // Comprueba que el numero es entre 2 y 12
                    $valor_usuario = "Has introducido: ".htmlspecialchars($_POST["valor_usuario"]);
                            if ($_POST["valor_usuario"]){
                                        if ($_POST["valor_usuario"] == $suma){
                                            $var_paridad = "Has ganado 5 puntos.";
                                            $_SESSION["puntuacion"] += 5;
                                        }
                                        else if ($_POST["valor_usuario"] != $suma){
                                            $var_paridad = "Has perdido 1 punto.";
                                            $_SESSION["puntuacion"] -= 1;
                                        }
                                            }
                                    // Si hay un valor de usuario, comprueba si es igual a la suma, si lo es suma, sino resta.
                }
                else {
                    $valor_usuario = "Debes de introducir un número entre 2 y 12";
                }
            }
        }
        /*
        Comprueba que el usuario ha cogido la casilla de paridades (par o impar),
        si ha cogido una casilla mete ese valor en una variable.
        */
        if (isset($_POST["coger_paridad"])){
            $coger_paridad = $_POST["coger_paridad"];
            $eleccion = "Has elegido: ";

            $mensaje_comprobar = imprimir_paridad($paridad);
            /*
               Suma 1 punto a la puntuacion
               si la funcion de $mensaje_comprobar la paridad
               es igual a lo que haya escogido el usuario,
               sino resta 1 punto.
            */
                    if ($coger_paridad == "Par" && $paridad){
                        $var_paridad = "Has ganado 1 punto.";
                        $_SESSION["puntuacion"] += 1;
                    }
                    elseif ($coger_paridad == "Impar" && !$paridad) {
                        $var_paridad = "Has ganado 1 punto.";
                        $_SESSION["puntuacion"] += 1;
                    }
                    else {
                        $var_paridad = "Has perdido 1 punto.";
                        $_SESSION["puntuacion"] -= 1;
                    }
        }
        else {
            $mensaje_comprobar = "No has escogido que sea par o impar";
        }
    }

}
else {
    $coger_paridad = null;
    $eleccion = null;
    $var_paridad = null;
    $valor_usuario = null;
    $dado1=null;
    $dado2=null;
    $suma=null;
    $error=null;
    $mensaje_comprobar=null;
    $reiniciar_juego = "Pulsa el botón reiniciar para jugar de nuevo.";
}
/*
Mete todas las variables en variables de sesion con la clave "vista"
para que cuando se haga el "header" no se pierda la información.
*/
    $_SESSION['vista'] = [
    'valor_usuario' => $valor_usuario,
    'dado1' => $dado1,
    'dado2' => $dado2,
    'suma' => $suma,
    'mensaje_comprobar' => $mensaje_comprobar,
    'eleccion' => $eleccion,
    'paridad' => $coger_paridad,
    'var_paridad' => $var_paridad,
    'reiniciar_juego' => $reiniciar_juego,
    'error' => $error
    ];

    if (!$error){
        header('Location: '.$_SERVER['PHP_SELF']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Juego de dados</title>
    <link rel="stylesheet" href="../estilo/examen_php.css">
</head>
<body>
    <form action="<?= (htmlspecialchars($_SERVER["PHP_SELF"])); //El php se escribe en el propio documento.?>" method="post">
    <h1>Examen</h1>

            <p>Objetivo: <input type="text" name="valor_usuario" placeholder="Número"> <input type="submit" name="submit" value="Enviar"></p>
            <p>Par: <input type="radio" name="coger_paridad" value="Par"> Impar: <input type="radio" name="coger_paridad"  value="Impar"></p>
            <?php
                echo "$valor_usuario";
                echo "<br>";
                echo "DADO 1: $dado1";
                echo "<br>";
                echo "DADO 2: $dado2";
                echo "<br>";
                echo "Suma total: $suma";
                echo "<br>";
                echo "$error";
                echo "<br>";
                echo "$mensaje_comprobar";
                echo "<br>";
                echo "$eleccion"."$coger_paridad";
                echo "<br>";
                if ($_SESSION["puntuacion"] == 0){
                    echo "Tu puntuación: 0";
                    echo "<br>";
                    echo "Has perdido.... Suerte la próxima vez...";
                }
                else if ($_SESSION["puntuacion"] == 20){
                    echo "Tu puntuación: 20";
                    echo "<br>";
                    echo "¡¡¡HAS GANADO!!!";
                }
                else{
                    echo "Tu puntuación: ".$_SESSION["puntuacion"];
                }
                echo "<br>";
                echo "$var_paridad";
                echo "<br>";
                echo "<input type='submit' name='reiniciar' value='Reiniciar'>";
                echo "<br>";
                echo "$reiniciar_juego";
            ?>
</body>
</html>