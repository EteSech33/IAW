<!-- 
    NOMBRE DEL ALUMNO: ____________________
    OBJETIVO: Crear un sistema de Login/Logout usando el patrón PRG.
-->
<?php
// =========================================================
// 1. INICIO DE SESIÓN
// =========================================================
session_start();

// =========================================================
// 2. PROCESAMIENTO (Solo si se envía el formulario)
// =========================================================
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errores = [];

    // --- CASO A: EL USUARIO QUIERE ENTRAR (LOGIN) ---
    if (isset($_POST['btn_entrar'])) {
        
        // 1. VALIDACIÓN
        /* HUECO: Valida que el campo 'nombre' no esté vacío. 
           Si está vacío, añade un texto al array $errores['nombre']. 
        */

        if (empty($errores)) {
            // 2. LÓGICA DE NEGOCIO (LOGIN)
            /* HUECO: 
               1. Guarda el nombre limpio en $_SESSION['usuario'].
               2. Guarda un mensaje de éxito en $_SESSION['mensaje_flash'] (ej: "¡Hola [nombre]!").
               3. Limpia los datos antiguos del formulario (unset de datos_form).
            */
        }
    }

    // --- CASO B: EL USUARIO QUIERE SALIR (LOGOUT) ---
    elseif (isset($_POST['btn_salir'])) {
        /* HUECO: 
           1. Destruye la sesión completamente.
           2. Redirige inmediatamente a esta misma página y sal (exit).
        */
    }

    // --- GESTIÓN DE ERRORES Y PERSISTENCIA (SI ALGO FALLÓ) ---
    if (!empty($errores)) {
        $_SESSION['errores_flash'] = $errores;
        $_SESSION['datos_form'] = $_POST; // Guardamos lo que escribió para que no lo pierda
    }

    // --- D. REDIRECCIÓN (PATRÓN PRG) ---
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Login PRG</title>
    <style>
        body { font-family: sans-serif; max-width: 400px; margin: 40px auto; text-align: center; border: 1px solid #ccc; padding: 20px; border-radius: 8px; }
        .error { color: red; font-size: 0.9em; display: block; margin-top: 5px; }
        .exito { background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        input[type="text"] { padding: 8px; width: 80%; margin: 10px 0; }
        button { padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>

    <!-- ZONA DE MENSAJES FLASH (ÉXITO) -->
    <?php if (isset($_SESSION['mensaje_flash'])): ?>
        <div class="exito">
            <?= $_SESSION['mensaje_flash']; ?>
            <?php unset($_SESSION['mensaje_flash']); ?>
        </div>
    <?php endif; ?>


    <!-- LÓGICA DE VISTAS: ¿ESTÁ LOGUEADO? -->
    
    <?php if ( !isset($_SESSION['usuario']) ): ?>
        
        <!-- VISTA 1: FORMULARIO DE LOGIN -->
        <h1>Iniciar Sesión</h1>
        <p>Por favor, identifícate para continuar.</p>

        <form action="" method="POST">
            <label for="nombre">Tu Nombre:</label>
            <br>
            <!-- HUECO: Rellena el value para que recuerde el nombre si hubo error -->
            <input type="text" name="nombre" id="nombre" 
                   value="<?= $_SESSION['datos_form']['nombre'] ?? ''; ?>">
            
            <!-- Mostrar error específico si existe -->
            <?php if (isset($_SESSION['errores_flash']['nombre'])): ?>
                <span class="error"><?= $_SESSION['errores_flash']['nombre']; ?></span>
            <?php endif; ?>
            
            <br>
            <button type="submit" name="btn_entrar">Entrar</button>
        </form>

    <?php else: ?>

        <!-- VISTA 2: PANEL DE USUARIO (LOGUEADO) -->
        <h1>Bienvenido/a</h1>
        <h2><?= $_SESSION['usuario']; ?></h2>
        
        <p>Has iniciado sesión correctamente.</p>

        <form action="" method="POST">
            <button type="submit" name="btn_salir">Cerrar Sesión</button>
        </form>

    <?php endif; ?>


    <?php 
        // LIMPIEZA DE FLASH DATA (Errores y formulario)
        // Esto asegura que si recarga la página, los errores desaparezcan.
        unset($_SESSION['errores_flash']);
        unset($_SESSION['datos_form']);
    ?>

</body>
</html>
