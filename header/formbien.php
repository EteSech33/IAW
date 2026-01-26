<?php
session_start(); // 1. Necesario para recordar el mensaje

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // A. Recogemos datos
   $nombre = $_POST['nombre'];
   
   // B. Guardamos el resultado en la sesión (mochila del servidor)
   $_SESSION['mensaje'] = "Hola, $nombre. Datos guardados correctamente.";

   // C. REDIRECCIÓN (Limpiamos el navegador)
   header('Location: ' . $_SERVER['PHP_SELF']);
   exit(); 
}
?>

<?php if (isset($_SESSION['mensaje'])): ?>
    <div style='color:green'>
        <?php 
            echo $_SESSION['mensaje']; 
            unset($_SESSION['mensaje']); // Importante: borrarlo tras mostrarlo
        ?>
    </div>
<?php endif; ?>

<form method="POST">
    Nombre: <input type="text" name="nombre">
    <button type="submit">Enviar</button>
</form>
