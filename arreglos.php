<?php
/*
 * arreglos.php
 * Arreglos indexados, asociativos y multidimensionales: creación, recorrido y manipulación.
 */
require_once 'includes/sesion.php';

$titulo_pagina    = 'Arreglos';
$subtitulo_pagina = 'Un arreglo guarda varios valores en una sola variable. Cada valor tiene una clave: un número (indexado) o un texto (asociativo).';

/* =========================================================
   1. ARREGLO INDEXADO
   ========================================================= */
$lenguajes = ['PHP', 'JavaScript', 'Python', 'Java'];   // claves 0, 1, 2, 3
$lenguajes_original = $lenguajes;

$primero = $lenguajes[0];                        // acceso por índice
$ultimo  = $lenguajes[count($lenguajes) - 1];

$lenguajes[] = 'C#';                             // agregar al final
array_push($lenguajes, 'Kotlin');                // agregar con función
$despues_agregar = $lenguajes;

sort($lenguajes);                                // ordenar alfabéticamente
$ordenado = $lenguajes;

$quitado = array_pop($lenguajes);                // quitar el último
$tiene_python = in_array('Python', $lenguajes);  // buscar un valor
$posicion_php = array_search('PHP', $lenguajes); // ¿en qué índice está?

/* =========================================================
   2. ARREGLO ASOCIATIVO
   ========================================================= */
$alumno = [
    'matricula' => '23270101',
    'nombre'    => 'Mariana Castillo',
    'carrera'   => 'Ingeniería en Sistemas Computacionales',
    'semestre'  => 5,
    'promedio'  => 94.2,
];
$alumno_original = $alumno;

$alumno['semestre'] = 6;                                  // modificar un valor
$alumno['correo']   = 'mariana.castillo@ejemplo.edu.mx';  // agregar una clave nueva
unset($alumno['promedio']);                               // eliminar una clave

/* =========================================================
   3. ARREGLO MULTIDIMENSIONAL (arreglo de arreglos)
   ========================================================= */
$grupo = [
    ['matricula' => '23270101', 'nombre' => 'Mariana Castillo', 'calificaciones' => ['Programación Web' => 96, 'Bases de Datos' => 92, 'Redes' => 94, 'Sistemas Operativos' => 90]],
    ['matricula' => '23270115', 'nombre' => 'Diego Hernández',  'calificaciones' => ['Programación Web' => 84, 'Bases de Datos' => 68, 'Redes' => 88, 'Sistemas Operativos' => 80]],
    ['matricula' => '23270128', 'nombre' => 'Valeria Gómez',    'calificaciones' => ['Programación Web' => 72, 'Bases de Datos' => 65, 'Redes' => 70, 'Sistemas Operativos' => 66]],
    ['matricula' => '23270133', 'nombre' => 'Luis Martínez',    'calificaciones' => ['Programación Web' => 90, 'Bases de Datos' => 85, 'Redes' => 79, 'Sistemas Operativos' => 88]],
    ['matricula' => '23270147', 'nombre' => 'Fernanda Ruiz',    'calificaciones' => ['Programación Web' => 58, 'Bases de Datos' => 71, 'Redes' => 62, 'Sistemas Operativos' => 69]],
];
$calificacion_minima = 70;
$nombres_materias = array_keys($grupo[0]['calificaciones']);

// Se recorre el grupo para calcular el promedio de cada alumno, contar materias
// reprobadas y encontrar el mejor promedio (foreach + if dentro del recorrido)
$aprobados      = 0;
$reprobados     = 0;
$mejor_promedio = 0;
$mejor_alumno   = '';

foreach ($grupo as $i => $integrante) {
    $promedio = array_sum($integrante['calificaciones']) / count($integrante['calificaciones']);

    $materias_reprobadas = 0;
    foreach ($integrante['calificaciones'] as $materia => $nota) {
        if ($nota < $calificacion_minima) {
            $materias_reprobadas++;
        }
    }

    $grupo[$i]['promedio']   = $promedio;
    $grupo[$i]['reprobadas'] = $materias_reprobadas;

    if ($promedio >= $calificacion_minima) {
        $aprobados++;
    } else {
        $reprobados++;
    }

    if ($promedio > $mejor_promedio) {
        $mejor_promedio = $promedio;
        $mejor_alumno   = $integrante['nombre'];
    }
}

// Promedio de cada materia con array_column()
$todas_calificaciones = array_column($grupo, 'calificaciones');
$promedios_materia = [];
foreach ($nombres_materias as $materia) {
    $notas = array_column($todas_calificaciones, $materia);
    $promedios_materia[$materia] = array_sum($notas) / count($notas);
}

/* =========================================================
   4. FUNCIONES DE MANIPULACIÓN
   ========================================================= */
$notas_pw = array_column($todas_calificaciones, 'Programación Web');

$solo_aprobados = array_filter($grupo, function ($a) use ($calificacion_minima) {
    return $a['promedio'] >= $calificacion_minima;
});

$nombres_mayusculas = array_map(function ($nombre) {
    // mb_strtoupper() respeta los acentos (á → Á); strtoupper() solo convierte letras sin acento
    return function_exists('mb_strtoupper') ? mb_strtoupper($nombre, 'UTF-8') : strtoupper($nombre);
}, array_column($grupo, 'nombre'));

$ranking = $grupo;
usort($ranking, function ($a, $b) {
    return $b['promedio'] <=> $a['promedio'];   // de mayor a menor
});

include 'includes/header.php';
?>

<section class="seccion">
    <span class="etiqueta-seccion">Explicación</span>
    <h2>Manipulación de datos con arreglos</h2>
    <p>
        Un arreglo permite manejar una colección de datos (una lista de materias, los datos de un alumno, un grupo completo)
        con una sola variable, y recorrerla con un ciclo. Se crean con corchetes <code>[]</code> o con <code>array()</code>.
        En este mismo sitio se usan arreglos para generar el menú, el footer, y PHP guarda los datos de la sesión en el arreglo
        <code>$_SESSION</code>.
    </p>
<pre class="sintaxis"><code>// Indexado: las claves son números que empiezan en 0
$lenguajes = ["PHP", "JavaScript", "Python"];
echo $lenguajes[0];            // PHP

// Asociativo: las claves son textos
$alumno = ["nombre" =&gt; "Mariana", "semestre" =&gt; 5];
echo $alumno["nombre"];        // Mariana

// Multidimensional: arreglos dentro de arreglos
$grupo = [
    ["nombre" =&gt; "Mariana", "calificaciones" =&gt; ["Redes" =&gt; 94]],
];
echo $grupo[0]["calificaciones"]["Redes"];   // 94</code></pre>
    <h3>¿Cómo los uso?</h3>
    <ul>
        <li><strong>Agregar:</strong> <code>$arreglo[] = valor</code>, <code>array_push()</code> · <strong>Quitar:</strong> <code>unset()</code>, <code>array_pop()</code>, <code>array_shift()</code></li>
        <li><strong>Ordenar:</strong> <code>sort()</code>, <code>rsort()</code>, <code>asort()</code>, <code>ksort()</code>, <code>usort()</code></li>
        <li><strong>Buscar:</strong> <code>in_array()</code>, <code>array_search()</code>, <code>array_key_exists()</code></li>
        <li><strong>Calcular:</strong> <code>count()</code>, <code>array_sum()</code>, <code>max()</code>, <code>min()</code></li>
        <li><strong>Transformar:</strong> <code>array_map()</code>, <code>array_filter()</code>, <code>array_column()</code>, <code>implode()</code>, <code>explode()</code></li>
    </ul>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>1. Arreglo indexado</h2>
    <p>Se crea <code>$lenguajes</code>, se agregan elementos, se ordena, se quita el último y se buscan valores.</p>
    <div class="tabla-envoltura">
        <table class="tabla">
            <thead><tr><th>Paso</th><th>Contenido del arreglo</th></tr></thead>
            <tbody>
                <tr>
                    <td>Original</td>
                    <td><ul class="chips"><?php foreach ($lenguajes_original as $l) { echo '<li>' . $l . '</li>'; } ?></ul></td>
                </tr>
                <tr>
                    <td><code>$lenguajes[] = 'C#'</code> y <code>array_push()</code></td>
                    <td><ul class="chips">
                        <?php foreach ($despues_agregar as $l) : ?>
                            <?php if (in_array($l, $lenguajes_original)) : ?>
                                <li><?php echo $l; ?></li>
                            <?php else : ?>
                                <li class="nuevo"><?php echo $l; ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul></td>
                </tr>
                <tr>
                    <td><code>sort()</code></td>
                    <td><ul class="chips"><?php foreach ($ordenado as $l) { echo '<li>' . $l . '</li>'; } ?></ul></td>
                </tr>
                <tr>
                    <td><code>array_pop()</code></td>
                    <td><ul class="chips">
                        <?php foreach ($lenguajes as $l) { echo '<li>' . $l . '</li>'; } ?>
                        <li class="quitado"><?php echo $quitado; ?></li>
                    </ul></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="resultado">
        <span class="resultado__titulo">Resultado</span>
        <p>
            Primer elemento <code>$lenguajes[0]</code> del original: <strong><?php echo $primero; ?></strong> ·
            último: <strong><?php echo $ultimo; ?></strong> ·
            elementos ahora: <strong><?php echo count($lenguajes); ?></strong>
        </p>
        <p>
            <code>in_array('Python')</code> → <strong><?php echo $tiene_python ? 'true' : 'false'; ?></strong> (se quitó con array_pop) ·
            <code>array_search('PHP')</code> → índice <strong><?php echo $posicion_php; ?></strong> ·
            <code>implode()</code> → <strong><?php echo implode(' | ', $lenguajes); ?></strong>
        </p>
    </div>
    <h3>print_r() del arreglo final</h3>
    <pre class="volcado"><?php echo htmlspecialchars(print_r($lenguajes, true)); ?></pre>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>2. Arreglo asociativo</h2>
    <p>Cada dato del alumno se guarda con una clave de texto. Se recorre con <code>foreach ($alumno as $clave =&gt; $valor)</code>; luego se modifica <code>semestre</code>, se agrega <code>correo</code> y se elimina <code>promedio</code> con <code>unset()</code>.</p>
    <div class="rejilla-2">
        <div>
            <h3>Antes</h3>
            <div class="tabla-envoltura">
                <table class="tabla">
                    <thead><tr><th>Clave</th><th>Valor</th></tr></thead>
                    <tbody>
                        <?php foreach ($alumno_original as $clave => $valor) : ?>
                            <tr><td><code><?php echo $clave; ?></code></td><td><?php echo $valor; ?></td></tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <h3>Después</h3>
            <div class="tabla-envoltura">
                <table class="tabla">
                    <thead><tr><th>Clave</th><th>Valor</th><th>Cambio</th></tr></thead>
                    <tbody>
                        <?php foreach ($alumno as $clave => $valor) : ?>
                            <tr>
                                <td><code><?php echo $clave; ?></code></td>
                                <td><?php echo $valor; ?></td>
                                <td>
                                    <?php
                                        if (!array_key_exists($clave, $alumno_original)) {
                                            echo '<span class="estado estado--ok">agregado</span>';
                                        } elseif ($alumno_original[$clave] !== $valor) {
                                            echo '<span class="estado estado--info">modificado</span>';
                                        } else {
                                            echo '—';
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="resultado">
        <span class="resultado__titulo">Resultado</span>
        <p>
            <code>array_keys($alumno)</code> → <?php echo implode(', ', array_keys($alumno)); ?><br>
            <code>array_key_exists('promedio', $alumno)</code> → <strong><?php echo array_key_exists('promedio', $alumno) ? 'true' : 'false'; ?></strong> (se eliminó con unset)
        </p>
    </div>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>3. Arreglo multidimensional: calificaciones del grupo</h2>
    <p>
        <code>$grupo</code> es un arreglo indexado de alumnos; cada alumno es un arreglo asociativo y sus calificaciones son otro arreglo asociativo.
        La tabla se genera con dos <code>foreach</code> anidados y varios <code>if</code>: las calificaciones menores a <?php echo $calificacion_minima; ?>
        se marcan en rojo, se calcula el estatus por promedio y se resalta el mejor alumno.
    </p>
    <div class="tabla-envoltura">
        <table class="tabla">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <?php foreach ($nombres_materias as $materia) : ?>
                        <th class="num"><?php echo $materia; ?></th>
                    <?php endforeach; ?>
                    <th class="num">Promedio</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grupo as $integrante) : ?>
                    <tr class="<?php echo ($integrante['nombre'] === $mejor_alumno) ? 'fila-destacada' : ''; ?>">
                        <td>
                            <?php echo $integrante['nombre']; ?>
                            <?php if ($integrante['nombre'] === $mejor_alumno) : ?>
                                <span class="estado estado--aviso">Mejor promedio</span>
                            <?php endif; ?>
                        </td>
                        <?php foreach ($integrante['calificaciones'] as $nota) : ?>
                            <?php if ($nota < $calificacion_minima) : ?>
                                <td class="num nota-baja"><?php echo $nota; ?></td>
                            <?php else : ?>
                                <td class="num"><?php echo $nota; ?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <td class="num"><strong><?php echo number_format($integrante['promedio'], 2); ?></strong></td>
                        <td>
                            <?php if ($integrante['promedio'] >= $calificacion_minima && $integrante['reprobadas'] === 0) : ?>
                                <span class="estado estado--ok">Aprobado</span>
                            <?php elseif ($integrante['promedio'] >= $calificacion_minima) : ?>
                                <span class="estado estado--aviso">Aprobado, debe <?php echo $integrante['reprobadas']; ?> materia(s)</span>
                            <?php else : ?>
                                <span class="estado estado--mal">Reprobado (<?php echo $integrante['reprobadas']; ?> materias)</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>Promedio por materia</td>
                    <?php foreach ($promedios_materia as $promedio_materia) : ?>
                        <td class="num"><?php echo number_format($promedio_materia, 1); ?></td>
                    <?php endforeach; ?>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="resultado">
        <span class="resultado__titulo">Resultado</span>
        <p>
            Alumnos: <strong><?php echo count($grupo); ?></strong> ·
            aprobados por promedio: <strong><?php echo $aprobados; ?></strong> ·
            reprobados: <strong><?php echo $reprobados; ?></strong> ·
            mejor promedio: <strong><?php echo $mejor_alumno; ?> (<?php echo number_format($mejor_promedio, 2); ?>)</strong>
        </p>
        <p>Acceso directo a un dato: <code>$grupo[1]['calificaciones']['Redes']</code> → <strong><?php echo $grupo[1]['calificaciones']['Redes']; ?></strong></p>
    </div>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>4. Funciones para manipular arreglos</h2>
    <p>Se aplican sobre las calificaciones de Programación Web obtenidas con <code>array_column()</code>: <code>[<?php echo implode(', ', $notas_pw); ?>]</code>.</p>
    <div class="tabla-envoltura">
        <table class="tabla">
            <thead><tr><th>Función</th><th>Para qué sirve</th><th>Resultado</th></tr></thead>
            <tbody>
                <tr><td><code>count()</code></td><td>Cuenta los elementos</td><td><?php echo count($notas_pw); ?></td></tr>
                <tr><td><code>array_sum()</code></td><td>Suma todos los valores</td><td><?php echo array_sum($notas_pw); ?></td></tr>
                <tr><td><code>max()</code> / <code>min()</code></td><td>Valor más alto / más bajo</td><td><?php echo max($notas_pw) . ' / ' . min($notas_pw); ?></td></tr>
                <tr><td><code>array_sum() / count()</code></td><td>Promedio</td><td><?php echo number_format(array_sum($notas_pw) / count($notas_pw), 2); ?></td></tr>
                <tr><td><code>rsort()</code></td><td>Ordena de mayor a menor</td><td><?php $copia = $notas_pw; rsort($copia); echo implode(', ', $copia); ?></td></tr>
                <tr><td><code>array_filter()</code></td><td>Deja solo los que cumplen una condición</td><td><?php echo count($solo_aprobados); ?> alumnos con promedio ≥ <?php echo $calificacion_minima; ?></td></tr>
                <tr><td><code>array_map()</code></td><td>Aplica una función a cada elemento</td><td><?php echo implode(', ', $nombres_mayusculas); ?></td></tr>
                <tr><td><code>explode()</code></td><td>Convierte un texto en arreglo</td><td><?php $partes = explode('-', 'ISC-5-S5A'); echo 'explode("-", "ISC-5-S5A") → ' . count($partes) . ' elementos: ' . implode(' · ', $partes); ?></td></tr>
                <tr><td><code>array_merge()</code></td><td>Une dos arreglos</td><td><?php echo implode(', ', array_merge(['HTML', 'CSS'], ['PHP'])); ?></td></tr>
            </tbody>
        </table>
    </div>

    <h3>Ranking del grupo con usort()</h3>
    <ol>
        <?php foreach ($ranking as $lugar => $integrante) : ?>
            <li>
                <?php echo $integrante['nombre']; ?> — <?php echo number_format($integrante['promedio'], 2); ?>
                <?php if ($lugar === 0) : ?>
                    <span class="estado estado--aviso">1.er lugar</span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</section>

<?php include 'includes/footer.php'; ?>
