<?php
session_start();
$puntuacion = 0;


function aleatorio() {
    echo "hola";
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../estilo/examen_php.css">
</head>
<body>
    <h1>Examen</h1>
    <?php if ($_SERVER["REQUEST_METHOD"] =! "POST"): // IF que escriba html, en vez de php?>
    
        <h1>ERROR</h1>

    <?php else: ?>

        <form action="<?= (htmlspecialchars($_SERVER["PHP_SELF"])); //El php se escribe en el propio documento.?>" method="post">
            <p>Objetivo: <input type="text" name="vu" placeholder="Número"> <input type="submit" name="submit" value="Enviar"></p>
            <p>Par: <input type="radio" name="Par"> Impar: <input type="radio" name="Impar"></p>
            <?php
                echo "hola";
            ?>
        </form>
    <?php endif; //Final del if?>
</body>
</html>