<?php
session_start();
/*  __      __        _       _     _           
    \ \    / /       (_)     | |   | |          
     \ \  / /_ _ _ __ _  __ _| |__ | | ___  ___ 
      \ \/ / _` | '__| |/ _` | '_ \| |/ _ \/ __|
       \  / (_| | |  | | (_| | |_) | |  __/\__ \
        \/ \__,_|_|  |_|\__,_|_.__/|_|\___||___/
*/
$parirdad = null;
$coger_paridad = null;
$eleccion = null;
$var_paridad = null;
$suma = null;
$comprobar = null;
$valor_usuario = null;
$reiniciar_juego = null;
$error = null;

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
        $comprobar = "El número es Par.";
        return $comprobar;
    }
    else {
        $comprobar = "El número es Impar.";
        return $comprobar;
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
    $_POST['valor_usuario'] = null; 
    $_SESSION['jugar'] = true; 
}

// Si la varialbe de sesion jugar es true entonces se puede jugar
if ($_SESSION["jugar"]) {

    [$suma, $dado1, $dado2]= tirar();
    $paridad = calcular_par($suma);
    
    // Comprueba si se ha seleccionado paridad e introducido un numero, si es el caso, sale un error.
    if (isset($_POST['submit'])) {
        if (!empty($_POST["coger_paridad"]) && !empty($_POST["valor_usuario"])) {
            $_POST["valor_usuario"] = "";
            $_POST["coger_paridad"] = "";
            $error = "No se pueden elegir ambas opciones a la vez.";
            $comprobar=false;
        }
        else {
            $comprobar=true;
        }
    }

    /*  Si $_POST["valor_usuario"] no tiene valor dice que hay que poner numero.
        Si tiene algun valor, comprueba que sea numerico, si no es numerico
        Luego comprueba que ese número sea enteros entre 2 y 12
    */
    if ($comprobar){
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

            $comprobar = imprimir_paridad($paridad);
            /*
               Suma 1 punto a la puntuacion 
               si la funcion de comprobar la paridad
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
            $comprobar = "No has escogido que sea par o impar";
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
    $reiniciar_juego = "Pulsa el botón reiniciar para jugar de nuevo.";
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
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): // IF que escriba html, en vez de php?>

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
                echo "$comprobar";
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
    <?php else: 
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $_SESSION['puntuacion'] = 10;
            }
    ?>
            
        <p>Objetivo: <input type="text" name="valor_usuario" placeholder="Número"> <input type="submit" name="submit" value="Enviar"></p>
        <p>Par: <input type="radio" name="coger_paridad" value="Par"> Impar: <input type="radio" name="coger_paridad"  value="Impar"></p>
        
    <?php endif; //Final del if?>
</body>
</html>