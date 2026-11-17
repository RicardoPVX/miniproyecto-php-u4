<?php
/*
 * sesion.php
 * Se incluye al inicio de TODAS las páginas (excepto index.php, que es quien crea la sesión).
 * Retoma la sesión existente y registra la visita a la página actual.
 */
require_once __DIR__ . '/config.php';

// Retoma la sesión que se creó en index.php (debe llamarse antes de enviar cualquier HTML)
session_start();

// Si todavía no hay una sesión iniciada, se manda al index para que se inicie ahí
if (!isset($_SESSION['hora_inicio'])) {
    header('Location: index.php?aviso=sin_sesion');
    exit;
}

// Registro de la visita: contador por página y un historial con la hora de cada visita
$pagina_actual = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['visitas'][$pagina_actual])) {
    $_SESSION['visitas'][$pagina_actual] = 0;
}
$_SESSION['visitas'][$pagina_actual]++;

$_SESSION['historial'][] = [
    'pagina' => $pagina_actual,
    'hora'   => time(),
];

// Solo se conservan las últimas 8 visitas del historial
if (count($_SESSION['historial']) > 8) {
    array_shift($_SESSION['historial']);
}
