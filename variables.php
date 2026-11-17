<?php
/*
 * variables.php
 * Ejemplos de variables y tipos de datos en PHP.
 */
require_once 'includes/sesion.php';

$titulo_pagina    = 'Variables y tipos de datos';
$subtitulo_pagina = 'Una variable es un espacio en memoria con nombre donde PHP guarda un valor. Aquí se declaran variables de cada tipo y se muestran con echo.';

/* ---------- Ejemplo 1: declaración de variables de cada tipo ---------- */
$nombre   = "Mariana Castillo";        // string  (texto)
$edad     = 20;                         // int     (número entero)
$promedio = 91.75;                      // float   (número con decimales)
$inscrita = true;                       // boolean (verdadero / falso)
$materias = [                           // array   (lista de valores)
    "Programación Web",
    "Bases de Datos",
    "Redes de Computadoras",
    "Sistemas Operativos",
    "Ingeniería de Software",
];
$apodo    = null;                       // null    (sin valor)

/* ---------- Ejemplo 2: operaciones con variables ---------- */
$creditos_cursados = 187;
$creditos_totales  = 260;
$creditos_faltan   = $creditos_totales - $creditos_cursados;            // resta (int)
$porcentaje_avance = ($creditos_cursados / $creditos_totales) * 100;    // división (float)
$edad_en_meses     = $edad * 12;                                        // multiplicación

$mensaje_concatenado   = "Alumna: " . $nombre . " (" . $edad . " años)"; // concatenación con el punto
$mensaje_interpolado   = "Alumna: $nombre tiene {$edad} años";          // variables dentro de comillas dobles

/* ---------- Ejemplo 3: constantes ---------- */
define('CALIFICACION_MINIMA', 70);
const MAXIMO_ALUMNOS = 35;

/* ---------- Ejemplo 4: conversión de tipos (casting) ---------- */
$conversiones = [
    ['expresion' => '"25" + 5',              'valor' => "25" + 5],
    ['expresion' => '(int) "42 alumnos"',    'valor' => (int) "42 alumnos"],
    ['expresion' => '(float) "9.5"',         'valor' => (float) "9.5"],
    ['expresion' => '(string) 3.14',         'valor' => (string) 3.14],
    ['expresion' => '(bool) 0',              'valor' => (bool) 0],
    ['expresion' => '(bool) "hola"',         'valor' => (bool) "hola"],
    ['expresion' => '(array) "PHP"',         'valor' => (array) "PHP"],
    ['expresion' => 'intval(87.9)',          'valor' => intval(87.9)],
];

include 'includes/header.php';
?>

<section class="seccion">
    <span class="etiqueta-seccion">Explicación</span>
    <h2>¿Cómo se crean las variables en PHP?</h2>
    <p>
        En PHP toda variable empieza con el signo <code>$</code>, seguido de una letra o guion bajo. No se declara el tipo:
        PHP es un lenguaje de <strong>tipado dinámico</strong>, así que el tipo lo decide el valor que se asigna con
        <code>=</code>, y puede cambiar si después se le asigna otro valor. Los nombres distinguen mayúsculas y minúsculas
        (<code>$edad</code> y <code>$Edad</code> son variables distintas).
    </p>
<pre class="sintaxis"><code>$nombre   = "Mariana";   // string
$edad     = 20;          // int
$promedio = 91.75;       // float
$inscrita = true;        // bool
$materias = ["Redes", "Bases de Datos"];  // array
echo $nombre;            // muestra el valor en la página</code></pre>

    <h3>Tipos de datos principales</h3>
    <div class="tabla-envoltura">
        <table class="tabla">
            <thead>
                <tr><th>Tipo</th><th>Qué guarda</th><th>Ejemplo</th><th>Función para comprobarlo</th></tr>
            </thead>
            <tbody>
                <tr><td><code>string</code></td><td>Texto entre comillas simples o dobles.</td><td><code>"Hola"</code></td><td><code>is_string()</code></td></tr>
                <tr><td><code>int</code></td><td>Números enteros, positivos o negativos.</td><td><code>20</code></td><td><code>is_int()</code></td></tr>
                <tr><td><code>float</code></td><td>Números con punto decimal.</td><td><code>91.75</code></td><td><code>is_float()</code></td></tr>
                <tr><td><code>boolean</code></td><td>Solo dos valores: <code>true</code> o <code>false</code>.</td><td><code>true</code></td><td><code>is_bool()</code></td></tr>
                <tr><td><code>array</code></td><td>Colección de valores con índices o claves.</td><td><code>[1, 2, 3]</code></td><td><code>is_array()</code></td></tr>
                <tr><td><code>null</code></td><td>Variable sin valor asignado.</td><td><code>null</code></td><td><code>is_null()</code></td></tr>
            </tbody>
        </table>
    </div>

    <h3>Funciones que se usan con variables</h3>
    <ul>
        <li><code>echo</code> muestra texto o el valor de una variable en la página.</li>
        <li><code>gettype()</code> devuelve el nombre del tipo y <code>var_dump()</code> muestra tipo, tamaño y valor exactos.</li>
        <li><code>isset()</code> revisa si una variable existe y no es <code>null</code>; <code>unset()</code> la elimina.</li>
        <li><code>date()</code> da formato a la fecha y hora; <code>count()</code> cuenta los elementos de un arreglo.</li>
        <li><code>strlen()</code>, <code>strtoupper()</code> y <code>number_format()</code> trabajan con textos y números.</li>
    </ul>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>1. Declaración de variables y sus tipos</h2>
    <p>Cada fila muestra con <code>echo</code> el valor de una variable declarada en <code>variables.php</code>, el tipo que detecta <code>gettype()</code> y la comprobación con la función <code>is_*()</code> correspondiente.</p>
    <div class="tabla-envoltura">
        <table class="tabla">
            <thead>
                <tr><th>Variable</th><th>Valor mostrado con echo</th><th>gettype()</th><th>Comprobación</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>$nombre</code></td>
                    <td><?php echo $nombre; ?></td>
                    <td><?php echo gettype($nombre); ?></td>
                    <td><code>is_string()</code> → <?php echo is_string($nombre) ? 'true' : 'false'; ?></td>
                </tr>
                <tr>
                    <td><code>$edad</code></td>
                    <td><?php echo $edad; ?></td>
                    <td><?php echo gettype($edad); ?></td>
                    <td><code>is_int()</code> → <?php echo is_int($edad) ? 'true' : 'false'; ?></td>
                </tr>
                <tr>
                    <td><code>$promedio</code></td>
                    <td><?php echo $promedio; ?></td>
                    <td><?php echo gettype($promedio); ?></td>
                    <td><code>is_float()</code> → <?php echo is_float($promedio) ? 'true' : 'false'; ?></td>
                </tr>
                <tr>
                    <td><code>$inscrita</code></td>
                    <td><?php echo $inscrita ? 'true (inscrita)' : 'false (no inscrita)'; ?></td>
                    <td><?php echo gettype($inscrita); ?></td>
                    <td><code>is_bool()</code> → <?php echo is_bool($inscrita) ? 'true' : 'false'; ?></td>
                </tr>
                <tr>
                    <td><code>$materias</code></td>
                    <td><?php echo implode(', ', $materias); ?></td>
                    <td><?php echo gettype($materias); ?></td>
                    <td><code>is_array()</code> → <?php echo is_array($materias) ? 'true' : 'false'; ?></td>
                </tr>
                <tr>
                    <td><code>$apodo</code></td>
                    <td><?php echo isset($apodo) ? $apodo : '(sin valor)'; ?></td>
                    <td><?php echo gettype($apodo); ?></td>
                    <td><code>is_null()</code> → <?php echo is_null($apodo) ? 'true' : 'false'; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <p>
        Nota: si se hace <code>echo true</code> PHP imprime <code>1</code> y con <code>echo false</code> no imprime nada;
        por eso los booleanos se muestran con un operador ternario. Además, <code>gettype()</code> conserva nombres históricos:
        devuelve <code>integer</code> para <code>int</code>, <code>double</code> para <code>float</code> y <code>NULL</code> para <code>null</code>.
    </p>

    <h3>var_dump(): tipo y valor exactos</h3>
    <pre class="volcado"><?php
        ob_start();
        var_dump($nombre, $edad, $promedio, $inscrita, $apodo);
        echo htmlspecialchars(ob_get_clean());
    ?></pre>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>2. Operaciones con variables</h2>
    <p>Los valores se calculan con operadores aritméticos a partir de otras variables. El resultado de dividir dos enteros es un <code>float</code>.</p>
    <div class="tabla-envoltura">
        <table class="tabla">
            <thead>
                <tr><th>Operación</th><th>Resultado</th><th>Tipo</th></tr>
            </thead>
            <tbody>
                <tr><td><code>$creditos_totales - $creditos_cursados</code></td><td><?php echo $creditos_faltan; ?> créditos por cursar</td><td><?php echo gettype($creditos_faltan); ?></td></tr>
                <tr><td><code>($creditos_cursados / $creditos_totales) * 100</code></td><td><?php echo $porcentaje_avance; ?></td><td><?php echo gettype($porcentaje_avance); ?></td></tr>
                <tr><td><code>number_format($porcentaje_avance, 1)</code></td><td><?php echo number_format($porcentaje_avance, 1); ?> % de avance</td><td>string</td></tr>
                <tr><td><code>$edad * 12</code></td><td><?php echo $edad_en_meses; ?> meses</td><td><?php echo gettype($edad_en_meses); ?></td></tr>
            </tbody>
        </table>
    </div>

    <h3>Concatenación e interpolación de texto</h3>
    <div class="resultado">
        <span class="resultado__titulo">Resultado</span>
        <p>Con punto <code>.</code>: <strong><?php echo $mensaje_concatenado; ?></strong></p>
        <p>Dentro de comillas dobles: <strong><?php echo $mensaje_interpolado; ?></strong></p>
        <p>Con comillas simples no se interpreta: <strong><?php echo 'Alumna: $nombre'; ?></strong></p>
    </div>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>3. Funciones date(), count() y de texto</h2>
    <div class="tabla-envoltura">
        <table class="tabla">
            <thead>
                <tr><th>Instrucción</th><th>Resultado en este momento</th></tr>
            </thead>
            <tbody>
                <tr><td><code>date('d/m/Y')</code></td><td><?php echo date('d/m/Y'); ?></td></tr>
                <tr><td><code>date('H:i:s')</code></td><td><?php echo date('H:i:s'); ?></td></tr>
                <tr><td><code>$dias_semana[date('N')]</code></td><td><?php echo $dias_semana[(int) date('N')]; ?></td></tr>
                <tr><td><code>date('z') + 1</code> (día del año)</td><td><?php echo date('z') + 1; ?></td></tr>
                <tr><td><code>date('t')</code> (días que tiene este mes)</td><td><?php echo date('t'); ?></td></tr>
                <tr><td><code>count($materias)</code></td><td><?php echo count($materias); ?> materias</td></tr>
                <tr><td><code>count($_SESSION['visitas'])</code></td><td><?php echo count($_SESSION['visitas']); ?> páginas distintas visitadas en esta sesión</td></tr>
                <tr><td><code>strlen($nombre)</code></td><td><?php echo strlen($nombre); ?> caracteres</td></tr>
                <tr><td><code>strtoupper($nombre)</code></td><td><?php echo strtoupper($nombre); ?></td></tr>
                <tr><td><code>str_word_count($nombre)</code></td><td><?php echo str_word_count($nombre); ?> palabras</td></tr>
                <tr><td><code>round($promedio)</code></td><td><?php echo round($promedio); ?></td></tr>
            </tbody>
        </table>
    </div>
</section>

<div class="rejilla-2">
    <section class="seccion">
        <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
        <h2>4. Conversión de tipos</h2>
        <p>PHP convierte tipos automáticamente al operar, o de forma explícita con <em>casting</em> poniendo el tipo entre paréntesis.</p>
        <div class="tabla-envoltura">
            <table class="tabla">
                <thead>
                    <tr><th>Expresión</th><th>Valor</th><th>Tipo</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($conversiones as $conversion) : ?>
                        <tr>
                            <td><code><?php echo htmlspecialchars($conversion['expresion']); ?></code></td>
                            <td><?php echo is_array($conversion['valor']) ? 'array(' . count($conversion['valor']) . ')' : mostrar_valor($conversion['valor']); ?></td>
                            <td><?php echo gettype($conversion['valor']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="seccion">
        <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
        <h2>5. Constantes, isset() y unset()</h2>
        <p>Una constante no cambia su valor; se crea con <code>define()</code> o <code>const</code> y se usa sin <code>$</code>.</p>
        <div class="resultado">
            <span class="resultado__titulo">Resultado</span>
            <p>CALIFICACION_MINIMA = <strong><?php echo CALIFICACION_MINIMA; ?></strong></p>
            <p>MAXIMO_ALUMNOS = <strong><?php echo MAXIMO_ALUMNOS; ?></strong></p>
            <p>SITIO_NOMBRE (definida en config.php) = <strong><?php echo SITIO_NOMBRE; ?></strong></p>
            <?php
                $temporal = "dato de prueba";
                $existe_antes = isset($temporal);
                unset($temporal);
                $existe_despues = isset($temporal);
            ?>
            <p>
                <code>isset($temporal)</code> antes de <code>unset()</code>: <strong><?php echo $existe_antes ? 'true' : 'false'; ?></strong>
                · después: <strong><?php echo $existe_despues ? 'true' : 'false'; ?></strong>
            </p>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>
