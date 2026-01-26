<?php
// Incluimos la configuración y el modelo, porque el controlador los necesita
require_once 'config/db.php';
require_once 'models/usuario_model.php';

// Iniciamos conexión
$link = conectar_db();

// Capturamos la 'accion' de la URL, si no hay, es 'listar'
$accion = isset($_GET['accion']) ? $_GET['accion'] : 'listar';

// --- LOGICA DEL CONTROLADOR ---

switch ($accion) {
    /**
     * ACCIÓN: LISTAR
     * Muestra la tabla con todos los usuarios
     */
    case 'listar':
        $usuarios = obtener_usuarios($link);
        // Cargamos la vista
        include 'views/usuario_lista.php';
        break;

    /**
     * ACCIÓN: CREAR (Formulario y Guardado)
     */
    
    case 'crear':
        // Si nos envían datos por POST, es que hay que guardar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email  = $_POST['email'];
            $edad   = $_POST['edad'];

            if (empty(trim($nombre))){
                $error = "No has introducido un nombre.";
                $usuario = null;
                include 'views/usuario_form.php'; // Mostramos form con error
                break;
            }

            if (is_numeric($edad)){
                // Llamamos al modelo
                $exito = crear_usuario($link, $nombre, $email, $edad);
                
                if ($exito === true) {
                    // PRG: Redirigimos al listado
                    header("Location: index.php?accion=listar");
                    exit();
                } else {
                    $error = "Error al crear: Error inesperado.";
                     if ($exito === 1062) {
                        // ¡Lo cazamos! Es un duplicado
                        //Usuario a null para evitar otro error.
                        $usuario=null;
                        $error = "Error: Ese email ya está registrado. Por favor, usa otro.";
                        include 'views/usuario_form.php'; // Mostramos form con error
                    } else {
                        // Es cualquier otro error (conexión, datos raros, etc.)
                        $error = "Ocurrió un error desconocido al guardar. Código: " . $resultado;
                        include 'views/usuario_form.php'; // Mostramos form con error
                    }     
                }
            }    
            else {
                $error = "Error al crear: No has introducido números en edad.";
                $usuario = null;
                include 'views/usuario_form.php'; // Mostramos form con error
            }
        } else {
            // Si es GET, simplemente mostramos el formulario vacío
            $usuario = null; // Variable vacía para que el form sepa que es nuevo
            include 'views/usuario_form.php';
        }
        break;

    /**
     * ACCIÓN: EDITAR
     */
    case 'editar':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lógica de guardar edición
            $nombre = $_POST['nombre'];
            $email  = $_POST['email'];
            $edad   = $_POST['edad'];

            if (empty(trim($nombre))){
                $error = "No has introducido un nombre.";
                $usuario = null;
                include 'views/usuario_form.php'; // Mostramos form con error
                break;
            }

            if (!is_numeric($edad)){
                $error = "Error: No has introducido números en edad.";
                $usuario = null;
                include 'views/usuario_form.php'; // Mostramos form con error
            }else{
                // Llamamos al modelo
                $exito = crear_usuario($link, $nombre, $email, $edad);

                if ($exito === true) {
                    // PRG: Redirigimos al listado
                    header("Location: index.php?accion=listar");
                    exit();
                } else {
                    $error = "Error al editar: Error inesperado.";
                     if ($exito == 1062) {
                        // ¡Lo cazamos! Es un duplicado
                        //Usuario a null para evitar otro error.
                        $usuario=null;
                        $error = "Error: Ese email ya está registrado. Por favor, usa otro.";
                        include 'views/usuario_form.php'; // Mostramos form con error
                    } else {
                        // Es cualquier otro error (conexión, datos raros, etc.)
                        $error = "Ocurrió un error desconocido al guardar. Código: " . $resultado;
                        include 'views/usuario_form.php'; // Mostramos form con error
                    }     
                }
            }

        } else {
            // Cargar datos del usuario para ponerlos en el formulario
            $usuario = obtener_usuario_por_id($link, $id);
            include 'views/usuario_form.php';
        }
        break;

    /**
     * ACCIÓN: BORRAR
     */
    case 'borrar':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        borrar_usuario($link, $id);
        header("Location: index.php?accion=listar");
        exit();
        break;
    
    /**
     * ACCIÓN: MOSTRAR DETALLES
     */
    case 'ver':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Cargar datos del usuario para ponerlos en el formulario
            $usuario = obtener_usuario_por_id($link, $id);
            include 'views/usuario_detalle.php';

        } else {
            // Si es 'POST' te lleva a la lista principal
            header("Location: index.php?accion=listar");
            break;
        }
        break;

    default:
        // Si la acción no existe, vamos al listado
        header("Location: index.php?accion=listar");
        break;

}
?>
