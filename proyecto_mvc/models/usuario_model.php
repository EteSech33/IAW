<?php
/*
 * MODELO: Solo interactúa con la tabla 'prueba'.
 * CRUD: Create, Read, Update, Delete.
 */

// 1. LISTAR (Read)
function obtener_usuarios($link) {
    $sql = "SELECT id, nombre, email, edad FROM prueba";
    $resultado = mysqli_query($link, $sql);
    
    // Devolvemos el resultado crudo de mysqli para recorrerlo en la vista
    return $resultado; 
}

// 2. OBTENER UNO (Read por ID)
function obtener_usuario_por_id($link, $id) {
    $sql = "SELECT id, nombre, email, edad FROM prueba WHERE id = ?";
    
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id); // "i" indica que es un integer
    mysqli_stmt_execute($stmt);
    
    $resultado = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($resultado);
}

// 3. CREAR (Create)
function crear_usuario($link, $nombre, $email, $edad) {
        $sql = "INSERT INTO prueba (nombre, email, edad) VALUES (?, ?, ?)";
        
        $stmt = mysqli_prepare($link, $sql);
        // "ssi" = String, String, Integer
        mysqli_stmt_bind_param($stmt, "ssi", $nombre, $email, $edad);
        
        // INTENTAMOS EJECUTAR
        if (mysqli_stmt_execute($stmt)) {
            // Si todo va bien, devolvemos TRUE
            return true;
        } else {
            // Si falla, NO devolvemos false.
            // Devolvemos el NÚMERO del error para que el controlador sepa qué pasó.
            // Usamos mysqli_stmt_errno() para sacar ese número.
            return mysqli_stmt_errno($stmt);
        }
}

// 4. ACTUALIZAR (Update)
function actualizar_usuario($link, $id, $nombre, $email, $edad) {
    $sql = "UPDATE prueba SET nombre = ?, email = ?, edad = ? WHERE id = ?";
    
    $stmt = mysqli_prepare($link, $sql);
    // "ssii" = String, String, Integer, Integer (el ID)
    mysqli_stmt_bind_param($stmt, "ssii", $nombre, $email, $edad, $id);
    
    return mysqli_stmt_execute($stmt);
}

// 5. BORRAR (Delete)
function borrar_usuario($link, $id) {
    $sql = "DELETE FROM prueba WHERE id = ?";
    
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    return mysqli_stmt_execute($stmt);
}
?>
