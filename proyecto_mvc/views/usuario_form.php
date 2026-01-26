<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Usuario</title>
    <style>
        body { font-family: sans-serif; padding: 20px; max-width: 500px; margin: 0 auto; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .actions { margin-top: 20px; }
        .error { color: red; background: #ffe6e6; padding: 10px; }
    </style>
</head>
<body>
    <!-- Título dinámico -->
    <h1><?= $usuario ? 'Editar Usuario' : 'Nuevo Usuario'; ?></h1>

    <?php if (isset($error)): ?>
        <div class="error"><?= $error; ?></div>
    <?php endif; ?>

    <!-- 
        El action del formulario depende de si editamos o creamos.
        Si editamos, mantenemos el ID en la URL.
    -->
    <form action="index.php?accion=<?= $usuario ? 'editar&id='.$usuario['id'] : 'crear'; ?>" method="POST">
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required 
               value="<?= $usuario ? htmlspecialchars($usuario['nombre']) : ''; ?>">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required 
               value="<?= $usuario ? htmlspecialchars($usuario['email']) : ''; ?>">

        <label for="edad">Edad:</label>
        <input type="text" name="edad" id="edad" required 
               value="<?= $usuario ? $usuario['edad'] : ''; ?>">

        <div class="actions">
            <button type="submit" style="padding: 10px 20px;">Guardar</button>
            <a href="index.php?accion=listar">Cancelar</a>
        </div>
    </form>
</body>
</html>
