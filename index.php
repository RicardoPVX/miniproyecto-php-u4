<?php
/*
 * index.php
 * Página de inicio. Aquí se INICIA la sesión del sistema.
 * Si ya existía una sesión, primero se destruye y después se crea una nueva
 * con una nueva hora de inicio (así funciona el "Reiniciar sesión").
 */
require_once 'includes/config.php';

session_start();

$sesion_anterior = null;

if (isset($_SESSION['hora_inicio'])) {
    // Ya había una sesión: se guardan sus datos para mostrarlos y luego se destruye
    $sesion_anterior = [
        'id'       => session_id(),
        'inicio'   => $_SESSION['hora_inicio'],
        'duracion' => time() - $_SESSION['hora_inicio'],
        'visitas'  => isset($_SESSION['visitas']) ? array_sum($_SESSION['visitas']) : 0,
    ];

    $_SESSION = [];       // vacía todas las variables de la sesión
    session_destroy();    // destruye la sesión en el servidor

    session_start();              // abre una sesión nueva...
    session_regenerate_id(true);  // ...con un identificador nuevo
}

// Registro del inicio de sesión: se guarda la hora actual con time()
$_SESSION['hora_inicio'] = time();
$_SESSION['visitas']     = ['index.php' => 1];
$_SESSION['historial']   = [
    ['pagina' => 'index.php', 'hora' => $_SESSION['hora_inicio']],
];

// ¿Llegó aquí porque intentó abrir otra página sin tener sesión?
$sin_sesion = isset($_GET['aviso']) && $_GET['aviso'] === 'sin_sesion';

// Temas del sitio (arreglo multidimensional que genera las tarjetas)
$temas = [
    ['archivo' => 'variables.php',     'titulo' => 'Variables y tipos de datos', 'texto' => 'Cómo se crean las variables, los tipos string, int, float, boolean y array, y funciones como date() y count().'],
    ['archivo' => 'condicionales.php', 'titulo' => 'Condicionales',              'texto' => 'Toma de decisiones con if, else, elseif y switch evaluando variables y arreglos.'],
    ['archivo' => 'bucles.php',        'titulo' => 'Bucles',                     'texto' => 'Repeticiones con for, while y foreach para generar listas y tablas dinámicas.'],
    ['archivo' => 'arreglos.php',      'titulo' => 'Arreglos',                   'texto' => 'Arreglos indexados, asociativos y multidimensionales; recorrido y manipulación de datos.'],
    ['archivo' => 'sesiones.php',      'titulo' => 'Sesiones',                   'texto' => 'Persistencia de datos entre páginas con $_SESSION y cálculo del tiempo activo.'],
];

$titulo_pagina    = 'Inicio';
$subtitulo_pagina = 'Sitio dinámico que demuestra variables, estructuras de control, arreglos y sesiones en PHP. Cada ejemplo se ejecuta en el servidor al cargar la página.';

include 'includes/header.php';
?>

<?php if ($sesion_anterior !== null) : ?>
    <div class="aviso aviso--ok">
        <strong>Sesión reiniciada</strong>
        <p>
            Se destruyó la sesión anterior con <code>session_destroy()</code>: había iniciado a las
            <strong><?php echo date('H:i:s', $sesion_anterior['inicio']); ?></strong>, estuvo activa
            <strong><?php echo formatear_tiempo($sesion_anterior['duracion']); ?></strong> y registró
            <strong><?php echo $sesion_anterior['visitas']; ?></strong> visitas a páginas.
            Se creó una sesión nueva con hora de inicio <strong><?php echo date('H:i:s', $_SESSION['hora_inicio']); ?></strong>.
        </p>
    </div>
<?php elseif ($sin_sesion) : ?>
    <div class="aviso aviso--aviso">
        <strong>No había una sesión activa</strong>
        <p>Intentaste abrir una página sin haber iniciado sesión, por eso se te trajo al inicio. Aquí se acaba de crear tu sesión; ya puedes navegar por el menú.</p>
    </div>
<?php else : ?>
    <div class="aviso aviso--info">
        <strong>Sesión iniciada</strong>
        <p>Se registró tu hora de inicio con <code>time()</code> a las <strong><?php echo date('H:i:s', $_SESSION['hora_inicio']); ?></strong>. Navega por el menú y observa cómo cambia el tiempo activo en la barra superior.</p>
    </div>
<?php endif; ?>

<section class="seccion">
    <span class="etiqueta-seccion">Temas</span>
    <h2>Contenido del sitio</h2>
    <div class="rejilla-temas">
        <?php foreach ($temas as $tema) : ?>
            <a class="tarjeta" href="<?php echo $tema['archivo']; ?>">
                <span class="tarjeta__archivo"><?php echo $tema['archivo']; ?></span>
                <h3><?php echo $tema['titulo']; ?></h3>
                <p><?php echo $tema['texto']; ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<div class="rejilla-2">
    <section class="seccion">
        <span class="etiqueta-seccion">Explicación</span>
        <h2>¿Qué hace PHP en esta página?</h2>
        <p>El <strong>index</strong> es el punto donde se inicia la sesión del sistema. Cada vez que se abre:</p>
        <ol>
            <li>Llama a <code>session_start()</code> para abrir o retomar la sesión del navegador.</li>
            <li>Con <code>isset($_SESSION['hora_inicio'])</code> revisa si ya existía una sesión.</li>
            <li>Si existía, la vacía con <code>$_SESSION = []</code>, la elimina con <code>session_destroy()</code> y abre una nueva con un identificador distinto (<code>session_regenerate_id()</code>).</li>
            <li>Guarda la hora de inicio con <code>$_SESSION['hora_inicio'] = time()</code>.</li>
        </ol>
        <p>Las demás páginas solo retoman esa sesión, calculan el tiempo activo y lo muestran en la barra superior. Por eso el botón <em>Reiniciar sesión</em> regresa a esta página.</p>
    </section>

    <section class="seccion">
        <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
        <h2>Datos de la sesión recién creada</h2>
        <dl class="lista-datos">
            <dt>ID de sesión</dt>
            <dd><?php echo session_id(); ?></dd>
            <dt>hora_inicio (time())</dt>
            <dd><?php echo $_SESSION['hora_inicio']; ?></dd>
            <dt>Hora legible (date())</dt>
            <dd><?php echo date('H:i:s', $_SESSION['hora_inicio']); ?></dd>
            <dt>Fecha</dt>
            <dd><?php echo fecha_en_espanol($_SESSION['hora_inicio']); ?></dd>
            <dt>Versión de PHP</dt>
            <dd><?php echo phpversion(); ?></dd>
        </dl>
        <?php if ($sesion_anterior !== null) : ?>
            <p class="resultado">
                <span class="resultado__titulo">Comparación de identificadores</span>
                ID anterior: <code><?php echo substr($sesion_anterior['id'], 0, 12); ?>…</code><br>
                ID nuevo: <code><?php echo substr(session_id(), 0, 12); ?>…</code>
            </p>
        <?php endif; ?>
    </section>
</div>

<?php include 'includes/footer.php'; ?>
