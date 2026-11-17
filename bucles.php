<?php
/*
 * bucles.php
 * Ejemplos de ciclos for, while, do...while y foreach recorriendo datos reales.
 */
require_once 'includes/sesion.php';

$titulo_pagina    = 'Bucles';
$subtitulo_pagina = 'Un bucle repite un bloque de código mientras se cumpla una condición o hasta recorrer todos los elementos de un arreglo.';

// Datos que se recorren en los ejemplos
$materias = ['Programación Web', 'Bases de Datos', 'Redes de Computadoras', 'Sistemas Operativos', 'Ingeniería de Software'];

$temas_repaso = [
    ['tema' => 'Variables y tipos de datos', 'minutos' => 25],
    ['tema' => 'Condicionales',              'minutos' => 30],
    ['tema' => 'Bucles',                     'minutos' => 35],
    ['tema' => 'Arreglos',                   'minutos' => 40],
    ['tema' => 'Sesiones',                   'minutos' => 30],
];
$meta_minutos = 120;

$alumnos = [
    ['matricula' => '23270101', 'nombre' => 'Mariana Castillo', 'semestre' => 5, 'promedio' => 94.2],
    ['matricula' => '23270115', 'nombre' => 'Diego Hernández',  'semestre' => 5, 'promedio' => 81.6],
    ['matricula' => '23270128', 'nombre' => 'Valeria Gómez',    'semestre' => 5, 'promedio' => 68.9],
    ['matricula' => '23270133', 'nombre' => 'Luis Martínez',    'semestre' => 5, 'promedio' => 88.0],
];

$ficha = ['Materia' => 'Programación Web', 'Unidad' => 4, 'Tema' => 'PHP del lado del servidor', 'Modalidad' => 'En equipo'];

$registro_calificaciones = [88, 'NP', 92, 75, 'NP', 61, 99];

include 'includes/header.php';
?>

<section class="seccion">
    <span class="etiqueta-seccion">Explicación</span>
    <h2>¿Cómo se usan para realizar repeticiones?</h2>
    <p>Los bucles evitan escribir el mismo código muchas veces. PHP tiene cuatro tipos:</p>
    <ul>
        <li><strong>for</strong>: cuando se sabe cuántas veces se va a repetir. Tiene inicio, condición e incremento.</li>
        <li><strong>while</strong>: repite mientras la condición sea verdadera; se revisa <em>antes</em> de cada vuelta.</li>
        <li><strong>do...while</strong>: igual que while, pero la condición se revisa <em>después</em>, así que se ejecuta al menos una vez.</li>
        <li><strong>foreach</strong>: recorre cada elemento de un arreglo sin manejar índices; puede leer la clave y el valor.</li>
    </ul>
<pre class="sintaxis"><code>for ($i = 1; $i &lt;= 10; $i++) { echo $i; }

$i = 0;
while ($i &lt; 7) { echo $i; $i++; }

foreach ($alumnos as $indice =&gt; $alumno) { echo $alumno['nombre']; }</code></pre>
    <p>Dentro de cualquier bucle, <code>break</code> lo termina antes de tiempo y <code>continue</code> salta a la siguiente vuelta.</p>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>1. for anidado: tabla de multiplicar generada dinámicamente</h2>
    <p>Un <code>for</code> genera las filas y otro <code>for</code> dentro de él genera las columnas. Con un <code>if</code> se resaltan los cuadrados (cuando fila y columna son iguales) y los productos pares.</p>
    <div class="tabla-envoltura">
        <table class="tabla-mult">
            <tr>
                <th>×</th>
                <?php for ($columna = 1; $columna <= 10; $columna++) : ?>
                    <th><?php echo $columna; ?></th>
                <?php endfor; ?>
            </tr>
            <?php for ($fila = 1; $fila <= 10; $fila++) : ?>
                <tr>
                    <th><?php echo $fila; ?></th>
                    <?php for ($columna = 1; $columna <= 10; $columna++) : ?>
                        <?php
                            $producto = $fila * $columna;
                            if ($fila === $columna) {
                                $clase_celda = 'cuadrado';
                            } elseif ($producto % 2 === 0) {
                                $clase_celda = 'par';
                            } else {
                                $clase_celda = '';
                            }
                        ?>
                        <td class="<?php echo $clase_celda; ?>"><?php echo $producto; ?></td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
    <p>Se generaron <strong><?php echo 10 * 10; ?></strong> celdas con solo dos ciclos <code>for</code>.</p>
</section>

<div class="rejilla-2">
    <section class="seccion">
        <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
        <h2>2. for con índice sobre un arreglo</h2>
        <p>El ciclo va de <code>0</code> hasta <code>count($materias) - 1</code> y usa el índice <code>$i</code> para leer cada materia.</p>
        <div class="resultado">
            <span class="resultado__titulo">Resultado</span>
            <ol>
                <?php for ($i = 0; $i < count($materias); $i++) : ?>
                    <li><?php echo $materias[$i]; ?> <small>(índice <?php echo $i; ?>)</small></li>
                <?php endfor; ?>
            </ol>
        </div>
    </section>

    <section class="seccion">
        <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
        <h2>3. do...while</h2>
        <p>Cuenta regresiva con <code>do...while</code>. En el segundo caso la condición es falsa desde el inicio y aun así el bloque se ejecuta una vez.</p>
        <div class="resultado">
            <span class="resultado__titulo">Resultado</span>
            <p>Cuenta regresiva:
                <?php
                    $contador = 5;
                    do {
                        echo '<strong>' . $contador . '</strong> ';
                        $contador--;
                    } while ($contador > 0);
                    echo '¡listo!';
                ?>
            </p>
            <p>Con <code>$x = 10</code> y condición <code>$x &lt; 5</code>:
                <?php
                    $x = 10;
                    $vueltas = 0;
                    do {
                        $vueltas++;
                    } while ($x < 5);
                    echo 'se ejecutó <strong>' . $vueltas . '</strong> vez.';
                ?>
            </p>
        </div>
    </section>
</div>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>4. while: los próximos 7 días a partir de hoy</h2>
    <p>El <code>while</code> se repite mientras <code>$dia &lt; 7</code>. En cada vuelta se calcula la fecha con <code>strtotime("+$dia day")</code> y <code>date()</code>; con <code>if</code> se marca el día de hoy y los fines de semana.</p>
    <ul class="dias">
        <?php
            $dia = 0;
            while ($dia < 7) {
                $fecha = strtotime("+$dia day");
                $numero_semana = (int) date('N', $fecha);

                $clases = [];
                if ($dia === 0) {
                    $clases[] = 'hoy';
                }
                if ($numero_semana >= 6) {
                    $clases[] = 'fin-semana';
                }

                echo '<li class="' . implode(' ', $clases) . '">';
                echo '<span>' . $dias_semana[$numero_semana] . '</span>';
                echo '<strong>' . date('d', $fecha) . '</strong>';
                echo '<span>' . $meses[(int) date('n', $fecha)] . '</span>';
                echo '</li>';

                $dia++;
            }
        ?>
    </ul>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>5. while con condición compuesta: plan de repaso</h2>
    <p>Se van sumando los minutos de cada tema del arreglo <code>$temas_repaso</code> <strong>mientras</strong> no se llegue a la meta de <?php echo $meta_minutos; ?> minutos y queden temas por revisar.</p>
    <div class="tabla-envoltura">
        <table class="tabla">
            <thead><tr><th>Vuelta</th><th>Tema</th><th class="num">Minutos</th><th class="num">Acumulado</th></tr></thead>
            <tbody>
                <?php
                    $indice    = 0;
                    $acumulado = 0;
                    while ($acumulado < $meta_minutos && $indice < count($temas_repaso)) {
                        $acumulado += $temas_repaso[$indice]['minutos'];
                        echo '<tr>';
                        echo '<td>' . ($indice + 1) . '</td>';
                        echo '<td>' . $temas_repaso[$indice]['tema'] . '</td>';
                        echo '<td class="num">' . $temas_repaso[$indice]['minutos'] . '</td>';
                        echo '<td class="num">' . $acumulado . '</td>';
                        echo '</tr>';
                        $indice++;
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="resultado">
        <span class="resultado__titulo">Resultado</span>
        <p>
            El ciclo dio <strong><?php echo $indice; ?></strong> vueltas y acumuló <strong><?php echo $acumulado; ?></strong> minutos.
            <?php if ($indice < count($temas_repaso)) : ?>
                Se detuvo al alcanzar la meta; quedó pendiente: <strong><?php echo $temas_repaso[$indice]['tema']; ?></strong>.
            <?php else : ?>
                Se revisaron todos los temas.
            <?php endif; ?>
        </p>
    </div>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>6. foreach: tabla de alumnos y ficha con clave =&gt; valor</h2>
    <p>El <code>foreach</code> recorre el arreglo <code>$alumnos</code> y genera una fila por alumno. Dentro, un <code>if</code> asigna el estatus según el promedio.</p>
    <div class="tabla-envoltura">
        <table class="tabla">
            <thead><tr><th>#</th><th>Matrícula</th><th>Nombre</th><th class="num">Semestre</th><th class="num">Promedio</th><th>Estatus</th></tr></thead>
            <tbody>
                <?php foreach ($alumnos as $posicion => $alumno) : ?>
                    <tr>
                        <td><?php echo $posicion + 1; ?></td>
                        <td><code><?php echo $alumno['matricula']; ?></code></td>
                        <td><?php echo $alumno['nombre']; ?></td>
                        <td class="num"><?php echo $alumno['semestre']; ?></td>
                        <td class="num"><?php echo number_format($alumno['promedio'], 1); ?></td>
                        <td>
                            <?php if ($alumno['promedio'] >= 70) : ?>
                                <span class="estado estado--ok">Regular</span>
                            <?php else : ?>
                                <span class="estado estado--mal">En riesgo</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h3>foreach con clave y valor</h3>
    <dl class="lista-datos">
        <?php foreach ($ficha as $clave => $valor) : ?>
            <dt><?php echo $clave; ?></dt>
            <dd><?php echo $valor; ?></dd>
        <?php endforeach; ?>
    </dl>
</section>

<section class="seccion">
    <span class="etiqueta-seccion etiqueta-seccion--vivo">En ejecución</span>
    <h2>7. continue y break</h2>
    <p>
        Se recorre <code>[<?php echo implode(', ', $registro_calificaciones); ?>]</code>. Con <code>continue</code> se saltan los
        valores <code>NP</code> (no presentó) y con <code>break</code> el ciclo se detiene en la primera calificación reprobatoria.
    </p>
    <div class="resultado">
        <span class="resultado__titulo">Resultado paso a paso</span>
        <ul class="chips">
            <?php
                foreach ($registro_calificaciones as $posicion => $valor) {
                    if (!is_int($valor)) {
                        echo '<li>Pos. ' . $posicion . ': NP → continue</li>';
                        continue;
                    }
                    if ($valor < 70) {
                        echo '<li class="detenido">Pos. ' . $posicion . ': ' . $valor . ' → break</li>';
                        break;
                    }
                    echo '<li class="nuevo">Pos. ' . $posicion . ': ' . $valor . ' ✓</li>';
                }
            ?>
        </ul>
        <p>Los valores después de la posición <?php echo $posicion; ?> ya no se revisaron.</p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
