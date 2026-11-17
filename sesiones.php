<?php
/*
 * sesiones.php
 * Manejo de sesiones: session_start(), $_SESSION, time() y session_destroy().
 */
require_once 'includes/sesion.php';   // aquí se ejecuta session_start()

$titulo_pagina    = 'Sesiones';
$subtitulo_pagina = 'Una sesión guarda datos del usuario en el servidor para que sigan disponibles al pasar de una página a otra, sin usar base de datos.';

/* ---------- Cálculo del tiempo activo paso a paso ---------- */
$inicio           = $_SESSION['hora_inicio'];   // se guardó con time() en index.php
$ahora            = time();                      // segundos transcurridos desde 01/01/1970
$segundos_activos = $ahora - $inicio;            // diferencia en segundos
$minutos          = intdiv($segundos_activos, 60);
$segundos         = $segundos_activos % 60;

/* ---------- Estado de la sesión ---------- */
if (session_status() === PHP_SESSION_ACTIVE) {
    $estado_sesion = 'Activa (PHP_SESSION_ACTIVE)';
} else {
    $estado_sesion = 'Inactiva';
}

$total_visitas = array_sum($_SESSION['visitas']);
$historial     = array_reverse($_SESSION['historial']);   // la visita más reciente primero

include 'includes/header.php';
?>

<section class="seccion">
    <span class="etiqueta-seccion">Explicación</span>
    <h2>Persistencia de datos en memoria: ¿para qué sirve?</h2>
    <p>
        HTTP no recuerda nada entre una petición y otra: cada vez que se abre una página, el servidor la atiende como si fuera la primera.
        Una <strong>sesión</strong> resuelve esto. Al llamar a <code>session_start()</code>, PHP crea un identificador único
        (<code>session_id()</code>) que el navegador guarda en una cookie llamada <code><?php echo session_name(); ?></code>.
        En cada página nueva el navegador envía ese identificador y PHP recupera los datos guardados en el arreglo
        superglobal <code>$_SESSION</code>.
    </p>
    <p>
        Sirve para mantener información temporal mientras el usuario navega: quién inició sesión, el contenido de un carrito de compras,
        preferencias como el idioma, mensajes entre páginas o, como en este sitio, la hora de inicio para calcular el tiempo activo.
        Los datos duran hasta que se destruye la sesión o expira; no son permanentes como en una base de datos.
    </p>
<pre class="sintaxis"><code>session_start();                       // siempre antes de enviar HTML
$_SESSION['hora_inicio'] = time();     // guardar un dato
echo $_SESSION['hora_inicio'];         // leerlo en cualquier otra página
unset($_SESSION['dato']);              // borrar un solo dato
session_destroy();                     // destruir toda la sesión</code></pre>

    <h3>Cómo funciona en este sitio</h3>
    <ol>
        <li><code>index.php</code> llama a <code>session_start()</code>; si ya había sesión la destruye con <code>session_destroy()</code> y guarda <code>$_SESSION['hora_inicio'] = time()</code>.</li>
        <li>Las demás páginas incluyen <code>includes/sesion.php</code>, que retoma la sesión y suma una visita en <code>$_SESSION['visitas']</code>.</li>
        <li><code>includes/header.php</code> resta <code>time() - $_SESSION['hora_inicio']</code> y lo convierte a minutos y segundos.</li>
        <li>El botón <em>Reiniciar sesión</em> lleva al index, que destruye la sesión y crea una nueva hora inicial.</li>
    </ol>
</section>

<div class="rejilla-2">
    <section class="seccion">
        <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
        <h2>1. Estado de la sesión</h2>
        <dl class="lista-datos">
            <dt>Estado</dt>
            <dd><?php echo $estado_sesion; ?></dd>
            <dt>Nombre de la cookie</dt>
            <dd><?php echo session_name(); ?></dd>
            <dt>ID de sesión</dt>
            <dd><?php echo session_id(); ?></dd>
            <dt>Variables guardadas</dt>
            <dd><?php echo count($_SESSION); ?> (<?php echo implode(', ', array_keys($_SESSION)); ?>)</dd>
        </dl>
    </section>

    <section class="seccion">
        <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
        <h2>2. Cálculo del tiempo activo</h2>
        <div class="tabla-envoltura">
            <table class="tabla">
                <thead><tr><th>Paso</th><th>Instrucción</th><th class="num">Valor</th></tr></thead>
                <tbody>
                    <tr><td>Hora de inicio</td><td><code>$_SESSION['hora_inicio']</code></td><td class="num"><?php echo $inicio; ?></td></tr>
                    <tr><td>Hora actual</td><td><code>time()</code></td><td class="num"><?php echo $ahora; ?></td></tr>
                    <tr><td>Diferencia</td><td><code>$ahora - $inicio</code></td><td class="num"><?php echo $segundos_activos; ?> s</td></tr>
                    <tr><td>Minutos</td><td><code>intdiv($segundos_activos, 60)</code></td><td class="num"><?php echo $minutos; ?></td></tr>
                    <tr><td>Segundos</td><td><code>$segundos_activos % 60</code></td><td class="num"><?php echo $segundos; ?></td></tr>
                </tbody>
            </table>
        </div>
        <div class="resultado">
            <span class="resultado__titulo">Resultado</span>
            <p>
                Inicio: <strong><?php echo date('H:i:s', $inicio); ?></strong> ·
                Actual: <strong><?php echo date('H:i:s', $ahora); ?></strong><br>
                Tiempo activo: <strong><?php echo $minutos; ?> minutos <?php echo $segundos; ?> segundos</strong>
            </p>
        </div>
    </section>
</div>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>3. Datos que persisten entre páginas</h2>
    <p>
        Cada página suma una visita en <code>$_SESSION['visitas']</code> y agrega un registro en <code>$_SESSION['historial']</code>.
        Navega a otras secciones y regresa: los números se conservan porque viven en la sesión, no en la página.
    </p>
    <div class="rejilla-2">
        <div class="tabla-envoltura">
            <table class="tabla">
                <thead><tr><th>Página</th><th class="num">Visitas</th></tr></thead>
                <tbody>
                    <?php foreach ($_SESSION['visitas'] as $pagina => $veces) : ?>
                        <tr>
                            <td>
                                <a href="<?php echo $pagina; ?>"><?php echo $pagina; ?></a>
                                <?php if ($pagina === $pagina_actual) : ?>
                                    <span class="estado estado--info">actual</span>
                                <?php endif; ?>
                            </td>
                            <td class="num"><?php echo $veces; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr><td>Total (<code>array_sum()</code>)</td><td class="num"><?php echo $total_visitas; ?></td></tr>
                </tfoot>
            </table>
        </div>
        <div class="tabla-envoltura">
            <table class="tabla">
                <thead><tr><th>Últimas visitas</th><th>Hora</th><th class="num">Hace</th></tr></thead>
                <tbody>
                    <?php foreach ($historial as $registro) : ?>
                        <tr>
                            <td><?php echo $registro['pagina']; ?></td>
                            <td><?php echo date('H:i:s', $registro['hora']); ?></td>
                            <td class="num"><?php echo $ahora - $registro['hora']; ?> s</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>4. Contenido completo de $_SESSION</h2>
    <p>Así se ve el arreglo de la sesión en este momento, mostrado con <code>print_r()</code>:</p>
    <pre class="volcado"><?php echo htmlspecialchars(print_r($_SESSION, true)); ?></pre>
</section>

<section class="seccion">
    <span class="etiqueta-seccion">Reinicio</span>
    <h2>5. Reiniciar la sesión</h2>
    <p>
        Al pulsar el botón se abre <code>index.php</code>, que vacía <code>$_SESSION</code>, ejecuta <code>session_destroy()</code>
        y crea una sesión nueva con una nueva <code>hora_inicio</code>. El tiempo activo vuelve a cero y los contadores de visitas se reinician.
    </p>
    <a class="boton" href="index.php">&#8635; Reiniciar sesión ahora</a>
</section>

<?php include 'includes/footer.php'; ?>
