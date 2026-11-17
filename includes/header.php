<?php
/*
 * header.php
 * Encabezado común: <head>, título del sitio, menú y la barra con la información de la sesión.
 * Antes de incluirlo, cada página define $titulo_pagina y $subtitulo_pagina.
 */
$titulo_pagina    = $titulo_pagina ?? 'Inicio';
$subtitulo_pagina = $subtitulo_pagina ?? '';

// Datos de la sesión que se muestran en todas las páginas
$hora_inicio   = $_SESSION['hora_inicio'];   // guardada con time() en index.php
$hora_actual   = time();                      // hora actual en segundos (timestamp)
$tiempo_activo = $hora_actual - $hora_inicio; // diferencia en segundos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina . ' | ' . SITIO_NOMBRE; ?></title>
    <link rel="icon" href="img/logo.svg" type="image/svg+xml">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header class="encabezado">
    <div class="contenedor encabezado__fila">
        <a class="marca" href="index.php">
            <img src="img/logo.svg" alt="Logo PHP en Acción" width="44" height="44">
            <span>
                <strong><?php echo SITIO_NOMBRE; ?></strong>
                <small><?php echo MATERIA . ' · Grupo ' . GRUPO; ?></small>
            </span>
        </a>
        <p class="encabezado__fecha"><?php echo fecha_en_espanol(); ?></p>
    </div>

    <?php include __DIR__ . '/menu.php'; ?>
</header>

<section class="barra-sesion" aria-label="Información de la sesión">
    <div class="contenedor barra-sesion__fila">
        <div class="dato-sesion">
            <span>Hora inicio sesión</span>
            <strong><?php echo date('H:i:s', $hora_inicio); ?></strong>
        </div>
        <div class="dato-sesion">
            <span>Hora actual</span>
            <strong><?php echo date('H:i:s', $hora_actual); ?></strong>
        </div>
        <div class="dato-sesion dato-sesion--activo">
            <span>Tiempo activo</span>
            <strong><?php echo formatear_tiempo($tiempo_activo); ?></strong>
        </div>
        <a class="boton boton--claro" href="index.php" title="Destruye la sesión actual y crea una nueva hora de inicio">
            &#8635; Reiniciar sesión
        </a>
    </div>
</section>

<main class="contenedor contenido">
    <div class="titulo-pagina">
        <h1><?php echo $titulo_pagina; ?></h1>
        <?php if ($subtitulo_pagina !== '') : ?>
            <p><?php echo $subtitulo_pagina; ?></p>
        <?php endif; ?>
    </div>
