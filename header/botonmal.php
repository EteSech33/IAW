<?php
// MAL: Al no haber header, el navegador se queda "sucio" con los datos.
if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
   <h1>¡Operación realizada!</h1>
<?php endif;?>
<form method="POST">
    <button type="submit">Hacer Operación</button>
</form>
