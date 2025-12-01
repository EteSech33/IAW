<?php 
session_start();
$usuario = htmlspecialchars(stripslashes(trim($_SESSION["usuario"],"/")));
?>
<!DOCTYPE html>
<form action="<?= (htmlspecialchars($_SERVER["PHP_SELF"])); //El php se escribe en el propio documento.?>" method="POST">
<head>
<title>Calculadora</title>
<link rel="stylesheet" href="../estilo/calculadora.css">
</head>

<body>
<div class="caja">
    <h2>Calculadora de <?= htmlspecialchars($usuario) ?></h2>
    <input type="text" name="numero-1" placeholder="Introduce un número">
    <br>
      <button type="submit" name="hacer" value="sumar">+</button>
      <button type="submit" name="hacer" value="restar">-</button>
      <button type="submit" name="hacer" value="multiplicar">x</button>
      <button type="submit" name="hacer" value="dividir">/</button>
    <br>
    <input type="text" name="numero-2" placeholder="Introduce un número">
    <br>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // Definimos las variables
        $num1 = $_POST["numero-1"];
        $num2 = $_POST["numero-2"];
        $elegir = $_POST["elegir"];
        //$num3 = $_POST["numero-3"];

        // Comprueba que los valores asignados del usuario son NUMEROS
        function numero($num1,$num2){
          if (is_numeric($num1) && is_numeric($num2)){
            return $num1; $num2;
          }
          else {
            echo"<p clas='resultado'>Introduce números.</p>";
            $num1=null;
            $num2=null;
          }
        }
        // Comprueba si los numeros están vacíos o no, si lo estan, imprime que introduzca el numero faltante.
        function comprobar($num1,$num2){
          if (!empty($num1)) {
            return $num1 = htmlspecialchars(stripslashes(trim($_POST["numero-1"],"/")));
          }
          else{
            echo"<p>Introduce el primer número</p>";
            $num1 = "";
          }

          if (!empty($num2)) {
            return $num2 = htmlspecialchars(stripslashes(trim($_POST["numero-2"],"/")));
          }
          else{
            echo"<p>Introduce el segundo número</p>";
            $num2 = "";
          }
        }


/*-------  FUNCIONES DE OPERAR  ------------*\
/**/    function sumar($num1,$num2) {       //
/**/      return $num1 + $num2;             //  
/**/    }                                   //
/**/                                        //
/**/    function restar($num1,$num2) {      //
/**/      return $num1 - $num2;             //
/**/    }                                   //
/**/                                        //
/**/    function multiplicar($num1,$num2) { //
/**/      return $num1 * $num2;             //
/**/    }                                   //
/**/                                        //
/**/    function dividir($num1,$num2) {     //
/**/      return $num1 / $num2;             //
/**/    }                                   //
/**///--------------------------------------//

        if (isset($_POST["hacer"])){ // Si "hacer" existe y NO vale NULL hace lo demas

          if (comprobar($num1,$num2) != NULL && numero($num1,$num2)){
          // Comprueba que ninguno de los 2 numeros este vacio, SI PONGO !empty() y pongo valor 0 a un numero, me lo da como vacio.
          // Tambien comprueba que los numeros son números con la función de arriba.

            switch ($_POST["hacer"]){ //Comprueba el valor de "hacer", depende del valor hace lo que ese valor ponga. En mi caso suma,resta,etc...
                case "sumar":
                    $resultado = sumar($num1,$num2);
                    echo"<p class='resultado'>$resultado</p>";
                    break;

                case "restar":
                    $resultado = restar($num1,$num2);
                    echo"<p class='resultado'>$resultado</p>";
                    break;

                case "multiplicar":
                    $resultado = multiplicar($num1,$num2);
                    echo"<p class='resultado'>$resultado</p>";
                    break;

                case "dividir":
                    if ($num2 != 0){ 
                    $resultado = dividir($num1,$num2);
                    echo"<p class='resultado'>$resultado</p>";
                    break;
                    }
                    else {
                      echo"<p>No se puede dividir entre 0</p>";
                    }
        }
      }
    }
    }
  ?>
  <br>
  <label>Elige: Factorial o Tabla de multiplicar </label>
  <br>
  <input type="text" name="elegir" placeholder="Introduce Factorial o Tabla"> 
  <br>
  <label>Introduce para obtener Factorial o Tabla de multiplicar </label>
  <br>
  <input type="text" name="numero-3" placeholder="Introduce un número"> 
  <br>
  <button type="submit" name="Calcula">Calcula</button>
  <?php
    if (isset($_POST["Calcula"])) {

    $elegir = strtolower($_POST["elegir"]); //Hace que se ponga minuscula
    $num3 = htmlspecialchars($_POST["numero-3"]);
    
    if ($num3 !== "" && is_numeric($num3)) {
      if ($elegir == "factorial") {
        $fact = 1;
        $i = 1;
        echo "<p>Factorial de $num3:</p>";
        while ($i <= $num3) {
          $fact *= $i;
          $i++;
        }
        echo "<p class='resultado'>$fact</p>";
      }
        else if ($elegir == "tabla") {

            echo "<div class='tabla'>";
            echo "<p>Tabla de multiplicar del $num3:</p>";

            for ($i = 0; $i <= 10; $i++) {
                echo "<p class='resultado'>$i x $num3 = " . ($num3 * $i) . "</p>";
            }
            echo "</div>";
        }
        else {
          echo "<p>Debes escribir 'Tabla' o 'Factorial'</p>";
        }
    }
    else {
      echo"<p>Debes de introducir un número.</p>";
    }

    }
  ?>
  <br>
  <input class="boton" type="submit" value="Cerrar Sesión" formaction="CerrarSesion.php"> 
  <!--    Si se quiere cerrar sesión, "formaction" cambia el <form> para ir a "CerrarSesion.php"  -->

</div>
</body>
</html>