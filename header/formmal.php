<?php
// EJEMPLO INCORRECTO (Vulnerable a reenvío)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $nombre = $_POST['nombre'];
   // Mostramos el resultado directamente aquí
   echo "<div style='color:green'>Hola, $nombre. Datos guardados.</div>";
}
?>

<form method="POST">
    Nombre: <input type="text" name="nombre">
    <button type="submit">Enviar</button>
</form>
