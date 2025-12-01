<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="../estilo/estilophp.css">
</head>
<body> 
<h2>Validación de formulario PHP</h2>
<form action="<?= (htmlspecialchars($_SERVER["PHP_SELF"])); //El php se escribe en el propio documento.?>" method="post">
  Nombre: <input type="text" name="nombre">
  
  <?php 
  // Verificar si el campo "nombre" esta vacio, si lo esta crea un "*" al lado de nombre.
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if (empty($_POST["nombre"])) {
    echo '<span class="obligatorio" title="Este campo es obligatorio.">*</span>';
  }}
  ?>

  <br><br>
  E-mail: <input type="text" name="email">
  <br><br>
  Web: <input type="text" name="website">
  <br><br>
  Comentario: <textarea name="comentario" rows="5" cols="40"></textarea>
  <br><br>
  Género:
  <input type="radio" name="genero" value="femenino">Femenino
  <input type="radio" name="genero" value="masculino">Masculino
  <input type="radio" name="genero" value="otro">Otro
  <br><br>
 Número de mes: <input type="text" name="mes">
 <br></br>
Número de día de la semana: <input type="text" name="dia"> 
  <br><br>
  <input type="submit" name="submit" value="Enviar">  
</form>

<?php

// Verifica si el metodo de enviar datos es POST

if ($_SERVER["REQUEST_METHOD"] == "POST"){

$dia[0] = "lunes";
$dia[1] = "martes";
$dia[2] = "miercoles";
$dia[3] = "jueves";
$dia[4] = "viernes";
$dia[5] = "sabado";
$dia[6] = "domingo";

$mes=array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");

if (!empty($_POST["nombre"])) {
// Verificar si el campo nombre tiene algun nombre, (ES OBLIGATORIO, SI NO SE CUMPLE ESTE, LOS DEMÁS TAMPOCO)
  $nombre = htmlspecialchars(stripslashes(trim($_POST["nombre"],"/")));
  echo "<h2>Datos respuesta:</h2>";
  echo "Nombre: $nombre";
  echo "<br>";

// Verificar si el campo "EMAIL" tiene un "." y una "@"
    if ((strpos($_POST["email"],"@")) == true && (strpos($_POST["email"],".")) == true){
      $correo = htmlspecialchars(stripslashes(trim($_POST["email"],"/")));
      echo "Email: $correo";
      echo "<br>";
    }
    else
      echo '<p class="obligatorio"> El campo E-mail debe de tener un "." y una "@" </p>';

// Verificar si el campo "WEB" tiene un "."
    if (!empty(strpos($_POST["website"],".")) == true){
      $website = htmlspecialchars(stripslashes(trim($_POST["website"],"/")));
      echo "Web: $website";
      echo "<br>";
    }
      else
        echo '<p class="obligatorio"> El campo web debe de tener un "."</p>';
      
// Verificar si hay comentario
    if (!empty($_POST["comentario"])){
        $comentario = htmlspecialchars(stripslashes(trim($_POST["comentario"],"/")));
        echo "Comentario: $comentario";
        echo "<br>";
    }

// Verificar el genero
    if (isset($_POST["genero"])){
      $genero = htmlspecialchars(stripslashes(trim($_POST["genero"],"/")));
      echo "Género: $genero";
      echo "<br>";
    }
    else
      $genero = "";

// Verificar que se ha introducido un dia del mes
    if (!empty(is_numeric($_POST["mes"]))){
      $mes_num = htmlspecialchars(stripslashes(trim($_POST["mes"],"/")));
      if (($mes_num <= 12) && ($mes_num >= 1)){
        echo "Mes del año: ";
        print_r($mes[$mes_num - 1]);        
        echo "<br>";
      }
      else
        echo '<p class="obligatorio"> Debes de ser un número del 1 al 12.</p>';
      }
      else
        echo '<p class="obligatorio"> Debes de introducir el número del mes.</p>';
  
// Verificar que se ha introducido un dia de la semana      
      if (!empty(is_numeric($_POST["dia"]))){
        $dia_num = htmlspecialchars(stripslashes(trim($_POST["dia"],"/")));
      if (($dia_num <= 7) && ($dia_num >= 1)){
        echo "Día de la semana: ";
        print_r($dia[$dia_num - 1]);        
        echo "<br>";
      }
      else
        echo '<p class="obligatorio"> Debes de ser un número del 1 al 7.</p>';
      }
      else
        echo '<p class="obligatorio"> Debes de introducir el número del día.</p>';

  }
    else
      echo '<p class="obligatorio"> Debes de rellenar los campos obligatorios.</p>';



}

?>
<br>
<p>Direccionamiento a <a href="../index.html" target="_blank">Volver al principio.</a></p>
</body>
</html>

