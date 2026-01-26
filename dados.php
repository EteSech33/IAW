<?php
session_start();
$puntuacion = 10;
$dados = htmlspecialchars($_POST["dados"] ?? ""); // Si no tiene ningun valor, le pone ""
$nuevo = htmlspecialchars($_POST["nuevo"] ?? "");
$numero = htmlspecialchars($_POST["numero"] ?? "");
$paridad="";
$suma="";
$dado1="";
$dado2="";


function tirar() {
	$dado1 = rand(1,6);
	$dado2 = rand(1,6);
	$suma = $dado1 + $dado2;
	return [$suma, $dado1, $dado2];
}

[$suma, $dado1, $dado2]= tirar();

function par($suma){
    if ($suma % 2 == 0){
        return True;
    }
    else {
        return False;
    }
}

$par=par($suma);


function comprobar($numero){
  if (!empty($numero)) {
    return $numero = htmlspecialchars(stripslashes(trim($_POST["numero"],"/")));
  }
  else{
    echo"<p>Introduce el primer número</p>";
    $numero = "";
  }
}


?>
<!DOCTYPE html>
    <html lang="es">
    <head>
        <title>Examen</title>
    </head>
    <body>
        <h1>Examen</h1>
        <form action="<?= (htmlspecialchars($_SERVER["PHP_SELF"])); //El php se escribe en el propio documento.?>" method="POST">
        Acertar número: <input type="text" name="numero" placeholder="Obligatorio"><br>
	    Par/Impar: <input type="radio" name="paridad" value="Par">Par <input type="radio" name="paridad" value="Impar">Impar
        
        <button type="submit" name="dados" value="dados">Tirar dados</button>
		        
<button type="submit" name="nuevo" value="nuevo">Nuevo juego</button>
</form>
        <?php
        if (isset($_POST["dados"])) {
            echo "<br>";
            echo "<p> Tu elección es:". $paridad ."</p>";
            if ($paridad == "Par"){
                if ($par == True){
                    $puntuacion=+1;
                } else {
                    $puntuacion=-1;
                }
            }
            else if ($paridad == "Impar"){
                if ($par == False){
                    $puntuacion=+1;
                } else {
                    $puntuacion=-1;
                }
            }
            
            if (comprobar($numero) != NULL){
                echo "<p>Tu predicción es: ". $numero ."</p>";
                echo "<p>Dado1: ". $dado1 ."</p>";
                echo "<p>Dado2: ". $dado2 ."</p>";
                echo "<p>Suma: ". $suma ."</p>";
                if ($numero == $suma){
                    $puntuacion=+5;
                } else
                    $puntuacion=-5;
            }
            else {
                echo "Debes de introducir un número.";
            }
            echo "<p>Tu puntuación es de $puntuacion puntos</p>";
        }
        ?>
    </body>
</html>
