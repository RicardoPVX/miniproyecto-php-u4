<?php
/*
 * config.php
 * Configuración general del sitio y funciones de apoyo que usan todas las páginas.
 */

// Zona horaria para que date() y time() muestren la hora de Tuxtla Gutiérrez
date_default_timezone_set('America/Mexico_City');

// Constantes del sitio
define('SITIO_NOMBRE', 'PHP en Acción');
define('MATERIA', 'Programación Web');
define('UNIDAD', 'Unidad 4 – Programación del lado del servidor con PHP');
define('DOCENTE', 'Jorge Octavio Guzmán Sánchez');
define('INSTITUCION', 'TecNM – Instituto Tecnológico de Tuxtla Gutiérrez');
define('GRUPO', 'S5A');

// Integrantes del equipo (arreglo indexado que se recorre en el footer)
$equipo = [
    'Ricardo Francisco Pinto Velasco',
    'Sebastián Ali Fernández Culebro',
    'Gabriel Alejandro Cruz Guillen',
];

// Nombres de los días y meses en español (date() los devuelve en inglés)
$dias_semana = [
    1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves',
    5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo',
];
$meses = [
    1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril', 5 => 'mayo', 6 => 'junio',
    7 => 'julio', 8 => 'agosto', 9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre',
];

/**
 * Convierte una cantidad de segundos a "X minutos Y segundos".
 */
function formatear_tiempo(int $segundos): string
{
    $minutos = intdiv($segundos, 60);   // minutos completos
    $resto   = $segundos % 60;          // segundos sobrantes

    $texto_min = $minutos . ($minutos === 1 ? ' minuto' : ' minutos');
    $texto_seg = $resto . ($resto === 1 ? ' segundo' : ' segundos');

    return $texto_min . ' ' . $texto_seg;
}

/**
 * Devuelve la fecha actual en español, por ejemplo: "Martes 17 de noviembre de 2026".
 */
function fecha_en_espanol(?int $timestamp = null): string
{
    global $dias_semana, $meses;
    $timestamp = $timestamp ?? time();

    return $dias_semana[(int) date('N', $timestamp)] . ' ' . date('j', $timestamp)
        . ' de ' . $meses[(int) date('n', $timestamp)] . ' de ' . date('Y', $timestamp);
}

/**
 * Muestra un valor de forma legible (los booleanos con echo se ven como "1" o vacío).
 */
function mostrar_valor($valor): string
{
    return htmlspecialchars(var_export($valor, true));
}
