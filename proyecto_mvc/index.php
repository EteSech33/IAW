<?php
/*
 * PUNTO DE ENTRADA ÚNICO (Front Controller simple)
 * * Este archivo se encarga de cargar el controlador principal.
 * En un sistema más grande, aquí tendríamos un "enrutador" que decide
 * qué controlador cargar (UsuarioController, ProductoController, etc).
 */

// Simplemente cargamos el controlador de usuarios, que se encargará del resto.
require_once 'controllers/usuario_controller.php';
?>
