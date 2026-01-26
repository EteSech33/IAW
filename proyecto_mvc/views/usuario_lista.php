<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <style>
        /* Un poco de CSS inline para que no se vea feo */
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .menor { background-color: #ff6e6e;}
        .mayor { background-color: lightgreen;}
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; }
        .btn-green { background-color: #28a745; }
        .btn-blue { background-color: #007bff; }
        .btn-red { background-color: #dc3545; }
    </style>
</head>
<body>
    <h1>Gestión de Usuarios (MVC)</h1>
    
    <!-- Enlace para crear nuevo -->
    <a href="index.php?accion=crear" class="btn btn-green">Nuevo Usuario</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Edad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <!-- Código de Gabriel -->
        <tbody>
            <?php while ($fila = mysqli_fetch_assoc($usuarios)): ?>
                <?php $clase = ($fila['edad'] < 18) ? "menor" : "mayor"; ?>
                <tr class="<?=$clase?>">
                        <td><?= $fila['id']; ?></td>
                        <td><a href="index.php?accion=ver&id=<?=$fila['id'];?>"><?=htmlspecialchars($fila['nombre']);?></a></td>
                        <td><?= htmlspecialchars($fila['email']); ?></td>
                        <td><?= $fila['edad'];?></td>
                        <td>
                            <!-- Botones de Acción: Apuntan al index con parámetros -->
                            <a href="index.php?accion=editar&id=<?= $fila['id']; ?>" class="btn btn-blue">Editar</a>
                            <a href="index.php?accion=borrar&id=<?= $fila['id']; ?>" class="btn btn-red" onclick="return confirm('¿Seguro?');">Borrar</a>
                        </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
