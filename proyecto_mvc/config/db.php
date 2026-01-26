<?php
/*
 * Archivo de conexión a la Base de Datos.
 * IP: 172.26.0.145
 * Usuario: alumno
 * Pass: alumno
 * BD: ejercicio
 */

function conectar_db() {
    mysqli_report(MYSQLI_REPORT_OFF);
    $host = "172.26.0.145";
    $user = "alumno";
    $pass = "alumno";
    $db   = "ejercicio";

    $link = mysqli_connect($host, $user, $pass, $db);

    if (!$link) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Forzamos utf8 para evitar problemas con tildes y ñ
    mysqli_set_charset($link, "utf8");

    return $link;
}
?>

