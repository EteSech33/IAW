<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../estilo/estilo.css"></link>
</head>
<html>
<body class="ejercicio2">
<form action="<?= (htmlspecialchars($_SERVER["PHP_SELF"])); ?>" method="post">
<p>Nombre: <input type="text" name="nombre"></p>
<br>
<p>E-mail: <input type="text" name="email"></p>
<br>
<input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
if ($_POST["nombre"]==NULL){
    echo "No tienes nombre.";
}
else{
    echo "Tu nombre es: " .htmlspecialchars($_POST["nombre"]);
}
?>

<br>

<?php
if ($_POST["email"]==NULL){
    echo "No hay correo";
}
else{
    echo "Tu dirección de email es: " .htmlspecialchars($_POST["email"]);
}
}
?>

</body>
</html>