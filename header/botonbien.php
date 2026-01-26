<?php
session_start(); // Necesario para recordar el mensaje tras la redirección

// BIEN: Procesamos y expulsamos al navegador a una página limpia.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. Hacemos el trabajo
    // (Guardar en BBDD, Calcular, etc...)

    // 2. Guardamos el mensaje en la sesión (mochila)
    $_SESSION['mensaje'] = "¡Operación realizada con éxito!";

    // 3. REDIRECCIÓN (La clave)
    // El navegador olvida el formulario y carga la página limpia
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit(); // Obligatorio
}
?>

<?php if (isset($_SESSION['mensaje'])): ?>
    <h1 style="color:green"><?= $_SESSION['mensaje']; ?></h1>
    <?php unset($_SESSION['mensaje']); // Borramos el mensaje tras mostrarlo ?>
<?php endif; ?>

<form method="POST">
    <button type="submit">Hacer Operación</button>
</form>
