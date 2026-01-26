<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver detalles</title>
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
    <h1>Detalles del usuario</h1>
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
        <tbody>

            <?php $error = (isset($error)) ? "error" : ""; ?>
            <div class="<?=$error?>"><?= $error; ?></div>
            
            <?php $clase = ($usuario['edad'] < 18) ? "menor" : "mayor"; ?>
                <tr class="<?=$clase?>">
                    <td><?= $usuario['id']; ?></td>
                    <td><?= htmlspecialchars($usuario['nombre']); ?></td>
                    <td><?= htmlspecialchars($usuario['email']); ?></td>
                    <td><?= $usuario['edad']; ?></td>
                    <td>
                        <!-- Botones de Acción: Te lleva a la lista -->
                        <a href="index.php?accion=listar;?>" class="btn btn-blue">Volver</a>
                    </td>
                </tr>
        </tbody>
    </table>
</body>
</html>

