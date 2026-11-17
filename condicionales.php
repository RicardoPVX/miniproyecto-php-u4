<?php
/*
 * condicionales.php
 * Ejemplos de if, else, elseif y switch evaluando variables y arreglos.
 */
require_once 'includes/sesion.php';

$titulo_pagina    = 'Condicionales';
$subtitulo_pagina = 'Las estructuras condicionales permiten que PHP tome decisiones: según el valor de una variable se ejecuta un bloque de código u otro.';

/* ---------- Ejemplo 1: if / elseif / else con una variable ---------- */
$calificacion = 87;

if ($calificacion >= 95) {
    $nivel = 'Excelente';
} elseif ($calificacion >= 85) {
    $nivel = 'Notable';
} elseif ($calificacion >= 75) {
    $nivel = 'Bueno';
} elseif ($calificacion >= 70) {
    $nivel = 'Suficiente';
} else {
    $nivel = 'No acreditada';
}

/* ---------- Ejemplo 2: if / elseif / else aplicado a un arreglo ---------- */
$calificaciones = [98, 87, 76, 70, 64, 45];

/* ---------- Ejemplo 3: if / else con varias condiciones sobre arreglos asociativos ---------- */
$alumnos = [
    ['nombre' => 'Mariana Castillo', 'inscrito' => true,  'adeudo' => 0,   'asistencia' => 95],
    ['nombre' => 'Diego Hernández',  'inscrito' => true,  'adeudo' => 850, 'asistencia' => 88],
    ['nombre' => 'Valeria Gómez',    'inscrito' => true,  'adeudo' => 0,   'asistencia' => 72],
    ['nombre' => 'Luis Martínez',    'inscrito' => false, 'adeudo' => 0,   'asistencia' => 90],
];
$asistencia_minima = 80;

/* ---------- Ejemplo 4: if / elseif / else con la hora actual ---------- */
$hora = (int) date('G');   // hora del servidor en formato 0 a 23

if ($hora < 12) {
    $saludo = 'Buenos días';
} elseif ($hora < 19) {
    $saludo = 'Buenas tardes';
} else {
    $saludo = 'Buenas noches';
}

/* ---------- Ejemplo 5: switch con el día de la semana ---------- */
$numero_dia = (int) date('N');  // 1 = lunes ... 7 = domingo

switch ($numero_dia) {
    case 1:
        $actividad = 'Inicio de semana: revisión de pendientes y entrega de reportes.';
        break;
    case 2:
    case 4:
        $actividad = 'Prácticas de laboratorio de programación.';
        break;
    case 3:
        $actividad = 'Asesorías y trabajo en equipo del mini proyecto.';
        break;
    case 5:
        $actividad = 'Exposiciones y evaluación de avances.';
        break;
    case 6:
        $actividad = 'Clases sabatinas y repaso de la semana.';
        break;
    default:
        $actividad = 'Día de descanso: no hay clases.';
        break;
}

/* ---------- Ejemplo 6: switch dentro de un recorrido ---------- */
$codigos_carrera = ['ISC', 'II', 'IGE', 'IE', 'XYZ'];

/* ---------- Ejemplo 7: operador ternario y operador ?? ---------- */
$promedio_grupo = 82.4;
$estado_grupo   = ($promedio_grupo >= 70) ? 'Aprobado' : 'Reprobado';
$tema_url       = $_GET['tema'] ?? 'sin tema en la URL';

include 'includes/header.php';
?>

<section class="seccion">
    <span class="etiqueta-seccion">Explicación</span>
    <h2>¿Cómo se usan para tomar decisiones?</h2>
    <p>
        Una condición es una expresión que da <code>true</code> o <code>false</code>. Con <code>if</code> se ejecuta un bloque
        solo si la condición es verdadera; <code>else</code> indica qué hacer cuando no lo es y <code>elseif</code> permite
        revisar otra condición distinta. PHP revisa las condiciones de arriba hacia abajo y ejecuta solo el primer bloque que se cumple.
    </p>
<pre class="sintaxis"><code>if ($calificacion >= 85) {
    echo "Notable";
} elseif ($calificacion >= 70) {
    echo "Suficiente";
} else {
    echo "No acreditada";
}</code></pre>
    <p>
        <code>switch</code> compara <strong>una sola variable</strong> contra varios valores posibles (<code>case</code>).
        Cada caso termina con <code>break</code> para que no se ejecuten los siguientes, y <code>default</code> se usa cuando
        ningún caso coincide. Es más ordenado que muchos <code>elseif</code> cuando se compara contra valores fijos.
    </p>
<pre class="sintaxis"><code>switch ($dia) {
    case 1:
        echo "Lunes";
        break;
    case 6:
    case 7:
        echo "Fin de semana";
        break;
    default:
        echo "Entre semana";
}</code></pre>

    <h3>Operadores que se usan en las condiciones</h3>
    <div class="tabla-envoltura">
        <table class="tabla">
            <thead><tr><th>Operador</th><th>Significado</th><th>Operador</th><th>Significado</th></tr></thead>
            <tbody>
                <tr><td><code>==</code></td><td>Igual en valor</td><td><code>&lt;</code> / <code>&gt;</code></td><td>Menor / mayor que</td></tr>
                <tr><td><code>===</code></td><td>Igual en valor y en tipo</td><td><code>&lt;=</code> / <code>&gt;=</code></td><td>Menor o igual / mayor o igual</td></tr>
                <tr><td><code>!=</code></td><td>Diferente</td><td><code>&amp;&amp;</code></td><td>Y: se deben cumplir ambas</td></tr>
                <tr><td><code>!==</code></td><td>Diferente en valor o tipo</td><td><code>||</code> / <code>!</code></td><td>O: basta una · No: niega</td></tr>
            </tbody>
        </table>
    </div>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>1. if, elseif y else con una variable</h2>
    <p>Se evalúa la variable <code>$calificacion</code> contra varios rangos; solo se ejecuta el primer bloque cuya condición se cumple.</p>
    <div class="resultado">
        <span class="resultado__titulo">Resultado</span>
        <p>
            <code>$calificacion = <?php echo $calificacion; ?></code> → nivel:
            <strong><?php echo $nivel; ?></strong>
        </p>
    </div>

    <h3>El mismo if / elseif / else aplicado a cada valor de un arreglo</h3>
    <div class="tabla-envoltura">
        <table class="tabla">
            <thead><tr><th class="num">Calificación</th><th>Nivel</th><th>Resultado</th></tr></thead>
            <tbody>
                <?php foreach ($calificaciones as $valor) : ?>
                    <?php
                        if ($valor >= 95) {
                            $texto_nivel = 'Excelente';
                            $clase = 'estado--ok';
                        } elseif ($valor >= 85) {
                            $texto_nivel = 'Notable';
                            $clase = 'estado--ok';
                        } elseif ($valor >= 75) {
                            $texto_nivel = 'Bueno';
                            $clase = 'estado--info';
                        } elseif ($valor >= 70) {
                            $texto_nivel = 'Suficiente';
                            $clase = 'estado--aviso';
                        } else {
                            $texto_nivel = 'No acreditada';
                            $clase = 'estado--mal';
                        }
                    ?>
                    <tr>
                        <td class="num"><?php echo $valor; ?></td>
                        <td><?php echo $texto_nivel; ?></td>
                        <td><span class="estado <?php echo $clase; ?>"><?php echo ($valor >= 70) ? 'Acredita' : 'No acredita'; ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>2. if y else con varias condiciones (&amp;&amp;) sobre arreglos</h2>
    <p>
        Un alumno tiene derecho a examen si está inscrito, no tiene adeudo y su asistencia es de al menos
        <?php echo $asistencia_minima; ?> %. Si no, con <code>if</code> anidados se indica la razón.
    </p>
    <div class="tabla-envoltura">
        <table class="tabla">
            <thead><tr><th>Alumno</th><th class="centro">Inscrito</th><th class="num">Adeudo</th><th class="num">Asistencia</th><th>Derecho a examen</th></tr></thead>
            <tbody>
                <?php foreach ($alumnos as $alumno) : ?>
                    <tr>
                        <td><?php echo $alumno['nombre']; ?></td>
                        <td class="centro"><?php echo $alumno['inscrito'] ? 'Sí' : 'No'; ?></td>
                        <td class="num">$<?php echo number_format($alumno['adeudo'], 2); ?></td>
                        <td class="num"><?php echo $alumno['asistencia']; ?> %</td>
                        <td>
                            <?php if ($alumno['inscrito'] && $alumno['adeudo'] == 0 && $alumno['asistencia'] >= $asistencia_minima) : ?>
                                <span class="estado estado--ok">Sí</span>
                            <?php else : ?>
                                <span class="estado estado--mal">No</span>
                                <?php
                                    if (!$alumno['inscrito']) {
                                        echo ' No está inscrito.';
                                    } elseif ($alumno['adeudo'] > 0) {
                                        echo ' Tiene adeudo pendiente.';
                                    } else {
                                        echo ' Asistencia menor al mínimo.';
                                    }
                                ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<div class="rejilla-2">
    <section class="seccion">
        <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
        <h2>3. Saludo según la hora actual</h2>
        <p>Se toma la hora del servidor con <code>date('G')</code> y se decide el saludo con <code>if / elseif / else</code>.</p>
        <div class="resultado">
            <span class="resultado__titulo">Resultado</span>
            <p>Hora actual: <strong><?php echo date('H:i'); ?></strong> (valor de <code>$hora</code>: <?php echo $hora; ?>)</p>
            <p class="saludo-grande"><strong><?php echo $saludo; ?></strong></p>
        </div>
    </section>

    <section class="seccion">
        <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
        <h2>4. switch con el día de la semana</h2>
        <p>El <code>switch</code> compara el número de día que devuelve <code>date('N')</code>. Martes y jueves comparten caso, y el domingo cae en <code>default</code>.</p>
        <div class="resultado">
            <span class="resultado__titulo">Resultado</span>
            <p>Hoy es <strong><?php echo $dias_semana[$numero_dia]; ?></strong> (<code>date('N')</code> = <?php echo $numero_dia; ?>)</p>
            <p><?php echo $actividad; ?></p>
        </div>
    </section>
</div>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>5. switch dentro de un recorrido de arreglo</h2>
    <p>Para cada código del arreglo <code>$codigos_carrera</code> el <code>switch</code> busca el nombre de la carrera. El código <code>XYZ</code> no coincide con ningún caso y lo atrapa <code>default</code>.</p>
    <div class="tabla-envoltura">
        <table class="tabla">
            <thead><tr><th>Código</th><th>Carrera</th></tr></thead>
            <tbody>
                <?php foreach ($codigos_carrera as $codigo) : ?>
                    <?php
                        switch ($codigo) {
                            case 'ISC':
                                $carrera = 'Ingeniería en Sistemas Computacionales';
                                break;
                            case 'II':
                                $carrera = 'Ingeniería Industrial';
                                break;
                            case 'IGE':
                                $carrera = 'Ingeniería en Gestión Empresarial';
                                break;
                            case 'IE':
                                $carrera = 'Ingeniería Eléctrica';
                                break;
                            default:
                                $carrera = '<span class="estado estado--aviso">Carrera no registrada</span>';
                        }
                    ?>
                    <tr>
                        <td><code><?php echo $codigo; ?></code></td>
                        <td><?php echo $carrera; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>6. Formas cortas: operador ternario y ??</h2>
    <p>
        El ternario <code>condición ? valor_si : valor_no</code> es un if / else en una sola línea. El operador
        <code>??</code> devuelve el primer valor si existe y no es <code>null</code>; si no, el segundo.
    </p>
    <div class="resultado">
        <span class="resultado__titulo">Resultado</span>
        <p><code>($promedio_grupo &gt;= 70) ? 'Aprobado' : 'Reprobado'</code> con promedio <?php echo $promedio_grupo; ?> → <strong><?php echo $estado_grupo; ?></strong></p>
        <p><code>$_GET['tema'] ?? 'sin tema en la URL'</code> → <strong><?php echo htmlspecialchars($tema_url); ?></strong>
            · prueba con <a href="condicionales.php?tema=switch">condicionales.php?tema=switch</a></p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
